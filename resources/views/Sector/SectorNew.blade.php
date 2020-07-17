

<div id="modalSectorNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Бүс нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSectorNew" action="" method="post">
                @csrf
                  <div class="col-md-12">
                    <label>Бүсийн нэр:</label>
                    <input class="form-control" type="text" name="sectorName" id="sectorName" value="">
                  </div>
                  <div class="col-md-12">
                    <label>Бүсийн код:</label>
                    <input class="form-control" type="number" name="sectorCode" id="sectorCode" value="">
                  </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSectoreAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
              </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
