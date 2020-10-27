@extends('layouts.layout_master')
@section('css')
<link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
<link href="{{url('public/uaBCssJs/dropzone/dropzone.min.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row col-md-12">
              <div class="col-md-3">
                <label>Аймаг аа сонгоно уу.</label>
                <select class="form-control" id="cmbProv" name="" post-url="{{url("/get/dangered/syms/by/provID")}}">
                  <option value="-1"> Сонгоно уу</option>
                  @foreach ($provs as $prov)
                      <option value="{{$prov->provID}}">{{$prov->provName}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 d-none" id="showSymDiv">
                <label>Сум аа сонгоно уу.</label>
                <select class="form-control" id="cmbSym" name="">
                </select>
              </div>
            </div>

            <h4 class="text-center col-md-12" style="margin-top:20px;">
              <label style="font-size: 22px; font-weight: bold;" id="lblProv"></label>&nbsp
              <label style="font-size: 22px; font-weight: bold;" id="lblSym"></label></h4>
            <h4 class="text-center col-md-12">Гол нэрийн хүнсний бүтээгдэхүүний зарцуулалт</h4>
            <table post-url="{{url("/log/foodReserve/refresh")}}" id="remainingProducts" class="table table-striped wrap table-bordered" style="width: 100%;">
              <thead>
                <th>id</th>
                <th>№</th>
                <th>Огноо</th>
                @foreach ($products as $product)
                  <th class="text-center">{{$product->productName}} /кг/</th>
                @endforeach
              </thead>
              <tbody>

              </tbody>
            </table>
            <div class="row col-md-12">

              <button class="btn btn-primary" type="button" id="btnShowSpentModal" urlProducts="{{url("/log/foodReserve/showRemainingProducts")}}">Зарцуулалт оруулах</button>
              <button class="btn btn-danger" type="button" id="btnDeleteSpent" deleteSpentUrl="{{url("/log/foodReserve/deleteRemainingProducts")}}">Устгах</button>

            </div>
          </div>
        </div>
    </div>
  </div>

@include('LogFoodReserve.LogFoodReserveNew')
@endsection


@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>
  <script type="text/javascript">
    var cols1 = <?php echo json_encode($products); ?>;
    var dataRow = "";

  </script>

  <script src="{{url("public/js/LogFoodReserve/log_ReserveShow.js")}}"></script>
  <script src="{{url("public/js/LogFoodReserve/log_ReserveEdit.js")}}"></script>
@endsection
