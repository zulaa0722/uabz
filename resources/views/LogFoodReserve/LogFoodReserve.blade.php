@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div  class="card-body">
            <div class="row">
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
                <h4 class="text-center col-md-12">Гол нэрийн хүнсний бүтээгдэхүүний нөөцийг тодотгох</h4>
                <div class="row col-md-12">
                  <table>
                    <thead>
                      <th>sda</th>
                      <th>sda</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>lol</td>
                        <td>lol</td>
                      </tr>
                      <tr>
                        <td>lol</td>
                        <td>lol</td>
                      </tr>
                      <tr>
                        <td>lol</td>
                        <td>lol</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="row col-md-12">

                  <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                  <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                  <button class="btn btn-danger text-right" type="button" name="button" id="btnAxaxDelete">Устгах</button>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
  </div>

@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
  .list-group {
    margin: 0;
    width: 100%;
  }
  </style>
@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
    var getAxax = "{{url("/getAxax")}}";
  </script>

<script src="{{url("public/js/LogFoodReserve/log_ReserveShow.js")}}"></script>
<script src="{{url("public/js/LogFoodReserve/log_ReserveEdit.js")}}"></script>
<script src="{{url("public/js/LogFoodReserve/log_ReserveAdd.js")}}"></script>
@endsection
