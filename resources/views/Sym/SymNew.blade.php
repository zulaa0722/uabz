

<div id="modalSymNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Сум нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSymNew" action="" method="post">
                @csrf
                  <div class="col-md-12">
                    <label>Аймгийн нэр:</label>
                    <select class="form-control" name="provID" id="provName">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($Provinces as $Province)
                        <option value="{{$Province->id}}">{{$Province->provName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label>Сумын нэр:</label>
                    <input class="form-control" type="text" name="symName" id="symName" value="">
                  </div>
                  <div class="col-md-12">
                    <label>Сумын код:</label>
                    <input class="form-control" type="number" name="symCode" id="symCode" value="">
                  </div>

                  </div>
                  <div class="modal-footer">
                      <button type="submit" id="btnSymAdd" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
              </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
