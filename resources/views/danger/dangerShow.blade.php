@extends('layouts.layout_master')
@section('content')
  <div class="col-md-12">
    <div class="form-group row">
      <label class="col-md-12 col-form-label text-md-center headerD">Бүртгэгдсэн онц байдлууд</label>
    </div>

    <div class="">

      {{-- Буцаад газрын зураг руу буцна --}}
      <div class="form-group">
        <a class="btn btn-danger" href="{{url("/")}}"><=Буцах</a>
      </div>
      {{-- Буцаад газрын зураг руу буцна --}}

      <table id="tableDangers" dangersShow="{{url("/get/dangers")}}" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
          <tr>
            <th>№</th>
            <th>Тушаалын дугаар</th>
            <th>Зарласан өдөр</th>
            <th>Тайлбар</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="text-left">
        <input type="button" id="btnOpenEditDangerModal" get-sums-url="{{url("/get/alerted/sums/d_id")}}" class="btn btn-warning text-center" name="" value="Онц байдлыг засах">
      </div>
      <div class="text-right">
        <input type="button" class="btn btn-danger text-right" name="" value="Онц байдлыг устгах">
      </div>
    </div>
  </div>
@include('danger.dangerEdit')
@endsection

@section('css')
    <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
    <style media="screen">
        .headerD{
            font-size: 20px;
        }
        #tableDangers tbody tr.selected {
            color: white;
            background-color: #8893f2;
        }
        #tableDangers tbody tr{
            cursor: pointer;
        }
    </style>
@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>
  <script src="{{url("public/js/danger/dangerShow.js")}}"></script>
  <script src="{{url("public/js/danger/dangerEdit.js")}}"></script>
@endsection
