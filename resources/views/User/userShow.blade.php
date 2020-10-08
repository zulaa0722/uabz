@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center"><strong>Бүртгэлтэй хэрэглэгчид</strong></h4>
          <table id="tableUsers" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>№</th>
                <th>Хэрэглэгчийн нэр</th>
                <th>Нэвтрэх цахим хаяг</th>
                <th>Хэрэглэгчийн эрхийн код</th>
                <th>Хэрэглэгчийн эрх</th>
                <th>Аймгийн код</th>
                <th>Аймгийн нэр</th>
                <th>Байгууллагын код</th>
                <th>Байгууллагын нэр</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <button class="btn btn-primary" type="button" name="button" id="btnEditModalOpen">Хэрэглэгч засах</button>
          <button class="btn btn-primary" type="button" name="button" id="btnChangePasswordModalOpen">Нууц үг солих</button>
          <button class="btn btn-danger" post-url="{{url("/delete/users")}}" type="button" name="button" id="btnDeleteUser">Хэрэглэгч устгах</button>
        </div>
      </div>
    </div>
  </div>
  @include('User.userEdit')
  @include('User.userChangePassword')
@endsection




@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
  #foodProductsDB tbody tr.selected {
    color: white;
    background-color: #8893f2;
  }
  #foodProductsDB tbody tr{
  cursor: pointer;
  }
</style>
@endsection




@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
  var dataRow = "";
  var table = "";
  var getUsersUrl = "{{url('/get/users')}}";

  $(document).ready(function(){
     table = $('#tableUsers').DataTable({
      "language": {
              "lengthMenu": "_MENU_ мөрөөр харах",
              "zeroRecords": "Хайлт илэрцгүй байна",
              "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
              "infoEmpty": "Хайлт илэрцгүй",
              "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
              "sSearch": "Хайх: ",
              "paginate": {
                "previous": "Өмнөх",
                "next": "Дараахи"
              },
              "select": {
                  rows: ""
              }
          },
          select: {
            style: 'single'
        },
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (aData['permission'] == "1") {
              $(nRow).find('td:eq(3)').css('background-color', '#4ac3b3');
              // $('td', nRow).css('background-color', '#4ac3b3');
            } else if (aData['permission'] == "2") {
              $(nRow).find('td:eq(3)').css('background-color', '#27c333');
              // $('td', nRow).css('background-color', 'Orange');
            } else if (aData['permission'] == "3") {
              $(nRow).find('td:eq(3)').css('background-color', '#d4de3e');
              // $('td', nRow).css('background-color', 'Orange');
            }
          },
          "ajax":{
                   "url": "{{url('/get/users')}}",
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: $('meta[name="csrf-token"]').attr('content')
                      }
                 },

          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "name", name: "name"},
            { data: "email", name: "email"},
            { data: "permission", name: "permission", "visible":false},
            { data: "permissionName", name: "permissionName"},
            { data: "aimagCode", name: "aimagCode", "visible":false},
            { data: "provName", name: "provName"},
            { data: "organizationID", name: "organizationID", "visible":false},
            { data: "abbrOrgName", name: "abbrOrgName"}
            ]
        });

        $('#tableUsers tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#tableUsers').DataTable().row(currow).data();
          }
          });
  });
  </script>

  <script src="{{url("public/js/users/userEdit.js")}}"></script>
  <script src="{{url("public/js/users/userChangePassword.js")}}"></script>
  <script src="{{url("public/js/users/userDelete.js")}}"></script>
@endsection
