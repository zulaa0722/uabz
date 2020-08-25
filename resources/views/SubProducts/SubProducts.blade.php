@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Орлуулах хүнсний бүтээгдэхүүн</h4>
                  <table id="subProductsDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Хүнсний бүтээгдэхүүний <br> нэр</th>
                          <th>Орлох хүнс</th>
                          <th>Итгэлцүүр</th>
                          <th></th>
                          <th>Үнэ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td></td>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnSubProductsDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('SubProducts.SubProductsNew')
@include('SubProducts.SubProductsEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#subProductsDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#subProductsDB tbody tr{
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
  var getSubProducts = "{{url("/getSubProducts")}}";
  var subProductsNew = "{{url("/subProducts/insert")}}";
  var subProductsEditUrl = "{{url("/subProducts/edit")}}";
  var subProductsDeleteUrl = "{{url("/subProducts/delete")}}";

  $(document).ready(function(){
     table = $('#subProductsDB').DataTable({
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
                   "url": getSubProducts,
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: "productName", name: "productName"},
            { data: "subName", name: "subName"},
            { data: "multiplier", name: "multiplier"},
            { data: "fProductID", name: "fProductID", visible:false},
            { data: "price", name: "price"}
            ]
        });

        $('#subProductsDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#subProductsDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/SubProducts/SubProductsNew.js")}}"></script>
<script src="{{url("public/js/SubProducts/SubProductsEdit.js")}}"></script>
<script src="{{url("public/js/SubProducts/SubProductsDelete.js")}}"></script>
@endsection
