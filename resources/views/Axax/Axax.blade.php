@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Авч хэрэгжүүлэх арга хэмжээ</h4>
                  <table id="axaxDB" class="table table-striped table-bordered dt-responsive wrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr class="text-center">
                          <th>№</th>
                          <th>Авч хэрэгжүүлэх <br> арга хэмжээ</th>
                          <th>Зэрэг</th>
                          <th>Ц (Шийдвэр гарсан <br> хугацаа)</th>
                          <th>Удирдан зохицуулах <br> байгууллага</th>
                          <th>Дэмжлэг үзүүлэх <br> байгууллага</th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <td></td>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnAxaxDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Axax.AxaxNew')
@include('Axax.AxaxEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#axaxDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#axaxDB tbody tr{
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
  var csrf = "{{ csrf_token() }}";
  var getAxax = "{{url("/getAxax")}}";
  var axaxNew = "{{url("/axax/insert")}}";
  var axaxEditUrl = "{{url("/axax/edit")}}";
  var axaxDeleteUrl = "{{url("/axax/delete")}}";

  $(document).ready(function(){
     table = $('#axaxDB').DataTable({
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
                   "url": getAxax,
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "axaxName", name: "axaxName"},
            { data: "levelName", name: "levelName"},
            { data: "inTime", name: "inTime"},
            { data: "mainName", name: "mainName"},
            { data: "supportName", name: "supportName"},
            { data: "levelID", name: "levelID", visible:false},
            { data: "mainOrgID", name: "mainOrgID", visible:false},
            { data: "supportOrgID", name: "supportOrgID", visible:false}
            ]
        });

        $('#axaxDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#axaxDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/Axax/AxaxNew.js")}}"></script>
<script src="{{url("public/js/Axax/AxaxEdit.js")}}"></script>
<script src="{{url("public/js/Axax/AxaxDelete.js")}}"></script>
@endsection
