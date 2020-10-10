@extends('layouts.layout_master')
@section('css')
<link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
<link href="{{url('public/uaBCssJs/dropzone/dropzone.min.css')}}" rel="stylesheet">
@endsection
@section('content')
  {{-- <div class="row"> --}}
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">

            {{-- <div class="row col-md-12"> --}}
              <div class="row col-md-4">
                <div class="list-group col-md-6">
                  <label>Аймаг аа сонгоно уу.</label>
                  @foreach ($provs as $prov)
                    <a href="#" onclick="aimag({{$prov->provID}}, '{{url("/get/dangered/syms/by/provID")}}')" class="list-group-item list-group-item-action" data-toggle="list">{{$prov->provName}}</a>
                  @endforeach
                </div>

                <div class="list-group col-md-6" id="listSyms">
                </div>

              </div>
              <div class="row col-md-8">
                <h4 class="text-center col-md-12">Гол нэрийн хүнсний бүтээгдэхүүний зарцуулалт</h4>
                <div class="row col-md-12">
                  <table post-url="{{url("/log/foodReserve/refresh")}}" id="remainingProducts" class="table table-striped wrap table-bordered" style="width: 100%;">
                    <thead>

                      <th>№</th>
                      @foreach ($products as $product)
                        <th>{{$product->productName}} /кг/</th>
                      @endforeach
                      <th>Огноо</th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
                <div class="row col-md-12">

                  <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                  <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>

                </div>
              {{-- </div> --}}

            </div>
          </div>
        </div>
    </div>
    @include('LogFoodReserve.LogFoodReserveNew')
  {{-- </div> --}}

@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
    var cols1 = <?php echo json_encode($products); ?>;
  </script>

<script src="{{url("public/js/LogFoodReserve/log_ReserveShow.js")}}"></script>
<script src="{{url("public/js/LogFoodReserve/log_ReserveEdit.js")}}"></script>
<script src="{{url("public/js/LogFoodReserve/log_ReserveAdd.js")}}"></script>
@endsection
