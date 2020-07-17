<div id="modalNewFolder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><strong>Хавтас үүсгэх</strong></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            {{-- START FORM --}}
            <form id="frmNewFolder" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 text-right">
                        <label class="" for="">Хавтасны нэр:</label>
                    </div>
                    <div class="col-md-6">
                        <input name="fn" type="text" class="form-control" id="txtNewFolderName" name="" value="" autocomplete="off" />
                    </div>
                </div>
            </form>
            {{-- END FORM --}}
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-success" post-url="{{url("/dada/file/manager/new/folder")}}" id="btnNewFolder" name="" value="Хавтас үүсгэх" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

  </div>
</div>
