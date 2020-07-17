

<div id="modalOrgNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Товчилсон нэрийн тайлбар нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmOrgNew" action="" method="post">
                @csrf
                  <div class="col-md-12">
                    <label>Товчилсон нэр:</label>
                    <input class="form-control" type="text" name="abbrName" id="abbrName" value="">
                    <label>Сумын нэр:</label>
                    <input class="form-control" type="text" name="fullName" id="fullName" value="">
                  </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" id="btnOrgAdd" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
