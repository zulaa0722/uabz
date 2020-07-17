@extends('dadaa_file_manager.dadaa_master')

@section('content')
    <div class="row">
        <div class="col-md-12 dadaa-title">
            <h4 class="text-center"><strong>Дадаа файл менежер</strong></h4>
        </div>
    </div>
    <input type="hidden" id="hideType" name="" value="{{$type}}" />
    <div class="row">
        <div class="col-md-2">
            <div class="card">
              <div class="card-body" glfu="{{url("/dada/file/manager/get/left/folder")}}" id="fl-left">
              </div>
            </div>
        </div>
        <div class="col-md-10">
            <br>
            <div class="container">
                <button type="button" class="btn btn-primary pull-right" id="btnNewFolderShow" name="button">Хавтас үүсгэх</button>
                <button type="button" class="btn btn-primary pull-right" id="btnNewFileShow" name="button">Файл хадгалах</button>
            </div>
            <div class="card">
              <div class="card-body" grfu="{{url("/dada/file/manager/get/right/folder")}}" id="fl-right">

            </div>
        </div>
    </div>
    @include('dadaa_file_manager.dadaa_modal_create_folder')
    @include('dadaa_file_manager.dadaa_modal_rename_folder')
    @include('dadaa_file_manager.dadaa_modal_upload')
    @include('dadaa_file_manager.dadaa_modal_image_show')
@endsection
@section('js')
<script src="{{ url('public/dada-file-manager/js/dadaa-file-manager.js') }}"></script>
<script src="{{ url('public/dada-file-manager/js/iut.js') }}"></script>
@endsection
