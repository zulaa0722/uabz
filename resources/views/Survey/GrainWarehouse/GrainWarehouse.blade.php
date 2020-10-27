@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">ТАРИАЛАНГИЙН АГУУЛАХ, ЭЛЕВАТОР, ЗООРИЙН СУДАЛГАА</h4>
                  <table id="GrainWarehouse" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr class="text-center">
                          <th>№</th>
                          <th>Аймаг, нийслэл</th>
                          <th>Сум, дүүрэг</th>
                          <th>Аж ахуйн <br> нэгжийн нэр </th>
                          <th>Ашиглалтад орсон <br> огноо</th>
                          <th>Агуулахын <br> хүчин чадал</th>
                          <th>Төлөв*</th>
                          <th>Хариуцах хүний нэр </th>
                          <th>Холбоо барих утас</th>
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
                    <button class="btn btn-danger" type="button" name="button" id="GrainWarehouseDelete">Устгах</button>
                    <p class="text-right">
                    *механикжсан агуулах бол (М), уламжлалт ажиллагаатай бол (У) гэж тэмдэглэнэ.</p>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Survey.GrainWarehouse.GrainWarehouseNew')
@include('Survey.GrainWarehouse.GrainWarehouseEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#GrainWarehouse tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#GrainWarehouse tbody tr{
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
  var grainWarehouse = "{{url("/grainWarehouse")}}";
  var grainWarehouseNew = "{{url("/grainWarehouse/insert")}}";
  var grainWarehouseEdit = "{{url("/grainWarehouse/edit")}}";
  var grainWarehouseDelete = "{{url("/grainWarehouse/delete")}}";

  $(document).ready(function(){
    var table = $('#GrainWarehouse').DataTable({
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
                   "url": grainWarehouse,
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
            { data: "firmName", name: "firmName"},
            { data: "startDate", name: "startDate"},
            { data: "capacity", name: "capacity"},
            { data: "state", name: "state"},
            { data: "resName", name: "resName"},
            { data: "contact", name: "contact"},
            { data: "provID", name: "provID", visible:false},
            { data: "symID", name: "symID", visible:false}
            ]
        });

        $('#GrainWarehouse tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                dataRow = "";
            }else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                var currow = $(this).closest('tr');
                dataRow = $('#GrainWarehouse').DataTable().row(currow).data();
            }
          });
  });
  </script>

<script src="{{url("public/js/Survey/SurveyAll.js")}}"></script>
<script src="{{url("public/js/Survey/GrainWarehouse/GrainWarehouseNew.js")}}"></script>
<script src="{{url("public/js/Survey/GrainWarehouse/GrainWarehouseEdit.js")}}"></script>
<script src="{{url("public/js/Survey/GrainWarehouse/GrainWarehouseDelete.js")}}"></script>

@endsection
