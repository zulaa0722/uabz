

<div id="modalProvinceNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Аймаг нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmProvinceNew" action="" method="post">
                @csrf
                  <div class="col-md-12">
                    <label>Бүсийн нэр:</label>
                    <select class="form-control" name="sectorID" id="sectorName">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($Secters as $Secter)
                        <option value="{{$Secter->id}}">{{$Secter->sectorName}}</option>
                      @endforeach
                    </select>

                  </div>
                  <div class="col-md-12">
                    <label>Аймгийн нэр:</label>
                    <input class="form-control" type="text" name="provName" id="provName" value="">
                  </div>
                  <div class="col-md-12">
                    <label>Аймгийн код:</label>
                    <input class="form-control" type="number" name="provCode" id="provCode" value="">
                  </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnProvinceAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
