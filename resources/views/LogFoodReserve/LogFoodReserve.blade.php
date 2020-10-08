@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div  class="card-body">
            <h4 Class="text-center">Гол нэрийн хүнсний бүтээгдэхүүний нөөцийг тодотгох</h4>
            <div class="row col-md-4">
              <div class="list-group col-md-6">
                <a class="list-group-item list-group-item-action active" data-toggle="list">Home</a>
                <a class="list-group-item list-group-item-action" data-toggle="list">Profile</a>
                <a class="list-group-item list-group-item-action" data-toggle="list">Messages</a>
                <a class="list-group-item list-group-item-action" data-toggle="list">Settings</a>
              </div>
              <div class="list-group col-md-6">
                <a class="list-group-item list-group-item-action active" data-toggle="list">Home</a>
                <a class="list-group-item list-group-item-action" data-toggle="list">Profile</a>
                <a class="list-group-item list-group-item-action" data-toggle="list">Messages</a>
                <a class="list-group-item list-group-item-action" data-toggle="list">Settings</a>
              </div>
            </div>
            <div class="row col-md-8">
              <div class="row col-md-12">
                <table>
                  <thead>
                    <th>sda</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>lol</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row col-md-12">

                <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                <button class="btn btn-danger" type="button" name="button" id="btnAxaxDelete">Устгах</button>
              </div>
            </div>
            </div>
        </div>
    </div>
  </div>

{{-- @include('Axax.AxaxNew')
@include('Axax.AxaxEdit') --}}
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

<script src="{{url("public/js/Axax/AxaxNew.js")}}"></script>
<script src="{{url("public/js/Axax/AxaxEdit.js")}}"></script>
<script src="{{url("public/js/Axax/AxaxDelete.js")}}"></script>
@endsection
