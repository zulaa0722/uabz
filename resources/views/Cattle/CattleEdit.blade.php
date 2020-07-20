

<div id="modalCattleEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Малын махны төрөл засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frCattleEdit" action="" method="post">
                @csrf
                  <div class="col-md-12">
                    <label>Малын махны төрөл:</label>
                    <input class="form-control" type="text" name="ecattleName" id="ecattleName" value="">
                  </div>
                  <div class="col-md-12">
                    <label>Хонин толгойд шилжүүлэх коффициент:</label>
                    <input class="form-control" type="text" name="ecattleName" id="eratioToSheep" value="">
                  </div>

                  </div>
                  <div class="modal-footer">
                      <button type="submit" id="btnCattleUpdate" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
