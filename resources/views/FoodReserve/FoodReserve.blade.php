@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Хүнсний нөөц</h4>
                  <table id="foodProductsDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Аймаг</th>
                          <th>Сум</th>
                          <th>Хүнсний бүтээгдэхүүн</th>
                          <th>Хэмжих нэгж</th>
                          <th>Тоо хэмжээ</th>
                          <th>Огноо</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td></td>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnFoodProductsDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('FoodReserve.FoodReserveNew')
@include('FoodReserve.FoodReserveEdit')
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
  var csrf = "{{ csrf_token() }}";
  var getFoodProducts = "{{url("/getFoodProducts")}}";
  var foodProductsNew = "{{url("/foodProducts/insert")}}";
  var foodProductsEditUrl = "{{url("/foodProducts/edit")}}";
  var foodProductsDeleteUrl = "{{url("/foodProducts/delete")}}";

  $(document).ready(function(){
     table = $('#foodProductsDB').DataTable({
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
                   "url": getFoodProducts,
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {return meta.row + meta.settings._iDisplayStart + 1;}},
            { data: "provinceName", name: "provinceName"},
            { data: "symName", name: "symName"},
            { data: "productName", name: "productName"},
            { data: "measurement", name: "measurement"},
            { data: "mainQntt", name: "mainQntt"},
            { data: "fReserveDate", name: "fReserveDate"},

            ]
        });

        $('#foodProductsDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#foodProductsDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/FoodProducts/FoodProductsNew.js")}}"></script>
<script src="{{url("public/js/FoodProducts/FoodProductsEdit.js")}}"></script>
<script src="{{url("public/js/FoodProducts/FoodProductsDelete.js")}}"></script>
@endsection
