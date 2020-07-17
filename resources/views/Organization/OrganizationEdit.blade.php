

<div id="modalOrgEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Товчилсон нэрийн тайлбар засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmOrgEdit" action="" method="post">
                @csrf
                <input type="hidden" name="rowID" id="rowID">
                <div class="col-md-12">
                  <label>Товчилсон нэр:</label>
                  <input class="form-control" type="text" name="abbrName" id="eabbrName" value="">
                  <label>Сумын нэр:</label>
                  <input class="form-control" type="text" name="fullName" id="efullName" value="">
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnOrgUpdate" class="btn btn-primary">Хадгалах</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
