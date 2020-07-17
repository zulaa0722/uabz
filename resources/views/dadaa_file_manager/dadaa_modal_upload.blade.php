<div id="modalUploadFile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><strong>Зураг хуулах</strong></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            {{-- START FORM --}}
                <div class="row">
                    <div class="col-md-4 text-right">
                        <label class="" for="">Зургаа сонгоно уу==></label>
                    </div>
                    <div class="col-md-5">
                        <input type="file" class="form-control" id="fileUpload" multiple="multiple" />
                    </div>
                    <div class="col-md-3">
                        <input type="button" class="btn btn-success" data-url="{{action("dadaaFileManagerController@resizeImagePost")}}" id="btnFileUpload" name="" value="Файл хуулах" />
                    </div>
                </div>
                <div id="images" class="row">
                    
                </div>
            {{-- END FORM --}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

  </div>
</div>
