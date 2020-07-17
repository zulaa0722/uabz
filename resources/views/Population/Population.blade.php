@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Хүн амын тоо</h4>
                  <table id="populationDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Аймаг нэр</th>
                          <th>Сумын нэр</th>
                          <th>Нийт хүн ам</th>
                          <th>Жишсэн хүн ам</th>
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
                    <button class="btn btn-danger" type="button" name="button" id="btnPopulationDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Population.PopulationNew')
@include('Population.PopulationEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#populationDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#populationDB tbody tr{
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
  var getPopulation = "{{url("/getPop")}}";
  var populationNew = "{{url("/pop/insert")}}";
  var populationEditUrl = "{{url("/pop/edit")}}";
  var populationDeleteUrl = "{{url("/pop/delete")}}";

  $(document).ready(function(){
    var table = $('#populationDB').DataTable({
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
                   "url": getPopulation,
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

            { data: "provName", name: "provName"},
            { data: "symName", name: "symName"},
            { data: "totalPop", name: "totalPop"},
            { data: "standardPop", name: "standardPop"},
            { data: "provID", name: "provID", visible:false},
            { data: "symID", name: "symID", visible:false}
            ]
        });

        $('#populationDB tbody').on( 'click', 'tr', function () {

            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                dataRow = "";
            }else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                var currow = $(this).closest('tr');
                dataRow = $('#populationDB').DataTable().row(currow).data();
            }
          });
  });
  </script>

<script src="{{url("public/js/Population/PopulationNew.js")}}"></script>
<script src="{{url("public/js/Population/PopulationEdit.js")}}"></script>
<script src="{{url("public/js/Population/PopulationDelete.js")}}"></script>



@endsection
