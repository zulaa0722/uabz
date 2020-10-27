<div id="modalShowChangeNorm" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Hорм сонгох</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="normFrom" action="" method="post">
                @csrf
                  <div class="col-md-12">
                    <label>Нормын нэр:</label>
                    <select class="form-control" name="normID" id="normID">
                        <option value="-1">Сонгоно уу</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <div class="col-md-12">

                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="newNormSave" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
