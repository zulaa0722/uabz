@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div  class="card-body">
            <div class="card-body">
              <h4 class="text-center">Аймаг сумдын хүнсний норм</h4>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                    <h6 class="text-right"><strong>Нормоо сонгоно уу=></strong></h6>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="">
                      <option value="-1">Сонгоно уу</option>
                      @foreach ($normNames as $normName)
                          <option value="{{$normName->id}}">{{$normName->NormName}} /{{$normName->sumKcal}}ккал/</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <table id="foodProductsDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>№</th>
                    <th>Норм нэр</th>
                    <th>Хүнсний нэр</th>
                    <th>Тоо хэмжээ</th>
                    <th>Ккал</th>
                    <th>id</th>
                    <th>normID</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
              <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
              <button class="btn btn-danger" type="button" name="button" id="btnNormDelete">Устгах</button>
            </div>
          </div>
        </div>
    </div>
  </div>
@include('Norm.normNew')
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


  <script src="{{url("public/js/Norm/norm.js")}}"></script>
  <script src="{{url("public/js/Norm/normNew.js")}}"></script>
@endsection
