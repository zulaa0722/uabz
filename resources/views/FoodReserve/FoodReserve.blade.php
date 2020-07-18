@extends('layouts.layout_master')
@section('css')
<link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
<link href="{{url('public/uaBCssJs/dropzone/dropzone.min.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div id="changeBlade" class="card-body">
            <h4 class="text-center">Хүнсний нөөцийн судалгаа</h4>
            <table id="FoodReserveTable" class="table table-bordered dt-responsive wrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>№</th>
                    <th></th>
                    <th></th>

                    <th>Аймаг, нийслэл</th>
                    <th>Сум, Дүүрэг</th>
                    @foreach ($products as $product)
                      <th>{{$product->productName}}</th>
                    @endforeach
                  </tr>
                </thead>

                <tbody>
                  @php
                    $i=1;
                  @endphp
                  @foreach ($syms as $sym)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$sym->provID}}</td>
                    <td>{{$sym->id}}</td>

                    <td>{{$sym->provName}}</td>
                    <td>{{$sym->symName}}</td>
                    @foreach ($products as $product)
                      <td>{{120}}</td>
                    @endforeach
                  </tr>
                  @php
                    $i++;
                  @endphp
                  @endforeach

                </tbody>
            </table>
            <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
            <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
            <button class="btn btn-danger" type="button" name="button" id="btnFoodReserveDelete">Устгах</button>
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
#FoodReserveTable tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#FoodReserveTable tbody tr{
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
  </script>



<script type="text/javascript">
$(document).ready(function(){
  var table = $('#FoodReserveTable').DataTable( {
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
      "stateSave": true
      });
      table.column( 1 ).visible( false );
      table.column( 2 ).visible( false );

      $('#FoodReserveTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            dataRow = "";
        }else {
            $('#FoodReserveTable tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var currow = $(this).closest('tr');
            dataRow = $('#FoodReserveTable').DataTable().row(currow).data();
        }
        console.log(dataRow );
        });

});
</script>
<script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
<script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
<script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
<script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

<script src="{{url('public/uaBCssJs/dropzone/dropzone.min.js')}}"></script>
<script src="{{url("public/js/FoodReserve/FoodReserveNew.js")}}"></script>
<script src="{{url("public/js/FoodReserve/FoodReserveEdit.js")}}"></script>
<script src="{{url("public/js/FoodReserve/FoodReserveDelete.js")}}"></script>
@endsection
