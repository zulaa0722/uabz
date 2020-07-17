@php
    $directories = \App\Http\Controllers\dadaaFileManagerController::showFolders();
@endphp
<h5>Үүсгэсэн хавтаснууд</h5>
<ul class="list-group">
    @foreach ($directories as $directory)
        <li class="list-group-item"><a class="clickable folder-item" data-id="{{$directory}}">{{basename($directory)}}</a></li>
    @endforeach
</ul>
