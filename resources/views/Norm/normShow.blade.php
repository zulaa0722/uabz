@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div  class="card-body">
          <div class="card-header">
            <h4 Class="text-center">Аймаг сумдын хүнсний норм</h4>
          </div>
          <div class="form-groud">
            <div class="row">
              <div class="col-md-3">
                <span>davaa</span>
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
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
            <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
            <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
            <button class="btn btn-danger" type="button" name="button" id="btnFoodProductsDelete">Устгах</button>
          </div>
        </div>
    </div>
  </div>
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
@endsection
