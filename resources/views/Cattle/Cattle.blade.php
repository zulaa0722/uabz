@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-8">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Малын махны төрөл</h4>
                  <table id="cattleDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Махны төрөл</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td></td>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnSectorAdd">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnSectorEdit">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnCattleDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Cattle.CattleNew')
@include('Cattle.CattleEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#cattleDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#cattleDB tbody tr{
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
  var csrf = "{{ csrf_token() }}";
  var getCattle = "{{url("/getCattle")}}";
  var cattleNew = "{{url("/cattle/insert")}}";
  var cattleEditUrl = "{{url("/cattle/edit")}}";
  var cattleDeleteUrl = "{{url("/cattle/delete")}}";

  $(document).ready(function(){
    var table = $('#cattleDB').DataTable({
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
          "ajax":{
                   "url": getCattle,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "cattleName", name: "cattleName"}
            ]
        });

        $('#cattleDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#cattleDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/Cattle/CattleNew.js")}}"></script>
<script src="{{url("public/js/Cattle/CattleEdit.js")}}"></script>
<script src="{{url("public/js/Cattle/CattleDelete.js")}}"></script>



@endsection
