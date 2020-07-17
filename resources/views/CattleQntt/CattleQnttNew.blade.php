

<div id="modalCattleQnttNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Малын махны төрөл нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmCattleQnttNew" action="" method="post">
                @csrf
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Аймгийн нэр:</label>
                    <select class="form-control" name="provID" id="provID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($provinces as $province)
                        <option value="{{$province->id}}">{{$province->provName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Сумын нэр:</label>
                    <select class="form-control" name="symID" id="symID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($syms as $sym)
                        <option value="{{$sym->id}}">{{$sym->symName}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="clearfix"></div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Малын махны төрөл:</label>
                    <select class="form-control" name="cattleID" id="cattleID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($cattles as $cattle)
                        <option value="{{$cattle->id}}">{{$cattle->cattleName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Жин /кг/:</label>
                    <input class="form-control" type="number" name="cattleQntt" id="cattleQntt">
                  </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnCattleQnttAdd" class="btn btn-primary">Хадгалах</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
