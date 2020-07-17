@php
    $directories = \App\Http\Controllers\dadaaFileManagerController::showFolders1($path);
    $files = \App\Http\Controllers\dadaaFileManagerController::getFiles($path);
    $clear = 1;
@endphp
@php
    $strArr="";
  if($path == "dadaa123"){
    $path1="";
  }
  else{
    $path1 = dirname($path);
  }
  if($path1 == "public"){
    $path="dadaa123";
  }
@endphp
@if($path != "dadaa123")
<button class="btn btn-primary" type="button" data-real-id="{{$path}}" data-id="{{$path1}}" id="btnBackFolder" name="button"><==Буцах</button>
@else
  <button class="btn btn-primary" type="button" data-real-id="{{$path}}" data-id="{{$path1}}" id="btnBackFolder" name="button"><==Буцах</button>
@endif
<h5> үүсгэсэн хавтаснууд </h5>
<div class="row">
  @foreach ($directories as $directory)
      <div class="col-md-2 right-item">
              <a class="clickable folder-item" data-id="{{$directory}}">
                <img class="w-90" width='100%' height="140" src="{{url("public/dada-file-manager/files/folder-icon.png")}}" />
              </a>
          <div class="row">
            {{basename($directory)}}
              <select class="form-control" fname="{{basename($directory)}}" durl="{{url("/dada/file/manager/delete/folder")}}" data-id="{{$directory}}" id="cmbActionFolder" name="">
                <option value="name">Сонгоно уу</option>
                <option value="edit">Засах</option>
                <option value="delete">Устгах</option>
              </select>
          </div>
      </div>
      @if($clear%6 == 0)
        <div class="clearfix"></div>
        <br/>
        <br/>
      @endif
      @php
        $clear++;
      @endphp
  @endforeach
  @foreach ($files as $file)
      <div class="col-md-2 right-item-image">
              <a class="clickableImage folder-item" img-url="{{url('storage/app/' . $file)}}" data-id="{{$file}}">
                <img width="100%" height="140" src="{{url('storage/app/' . $file)}}" />
              </a>
          <div class="row">
            {{basename($file)}}
              <select class="form-control" ip="{{$file}}" durl="{{action("dadaaFileManagerController@deleteFile")}}" img-url="{{url('storage/app/' . $file)}}" id="cmbImgFolder" name="">
                <option value="name">Сонгоно уу</option>
                <option value="delete">Устгах</option>
                <option value="show">Харах</option>
              </select>
          </div>
      </div>
      @if($clear%6 == 0)
        <div class="clearfix"></div>
        <br/>
        <br/>
      @endif
      @php
        $clear++;
      @endphp
  @endforeach
</div>
