@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center">Малын хэрэглээ</h4>
          <div class="form-group row">
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
    #cattleDB tbody tr.selected {
      color: white;
      background-color: #8893f2;
    }
    #cattleDB tbody tr{
      cursor: pointer;
    }
  </style>
@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>


  <script src="{{url("public/js/logCattle/logCattleShow.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleNew.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleEdit.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleShow.js")}}"></script>
@endsection
