

<div id="modalPopulationNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүн ам нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmPopulationNew" action="" method="post">
                @csrf
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Аймгийн нэр:</label>
                      <select class="form-control" name="provID" id="provName" getSymUrl="{{url("/sym/get/by/provID")}}">
                          <option value="-1">Сонгоно уу</option>
                        @foreach ($provinces as $province)
                          <option value="{{$province->id}}">{{$province->provName}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Сумын нэр:</label>
                      <select class="form-control" name="symID" id="cmbSymNew">
                          <option value="-1">Сонгоно уу</option>

                      </select>
                    </div>
                  </div>
                  <div class="clearfix"></div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Суурин хүн амын тоо:</label>
                      <input class="form-control" type="number" name="totalPop" id="totalPop">
                    </div>
                    <div class="col-md-6">
                      <label>Жишсэн хүн амын тоо:</label>
                      <input class="form-control" type="number" name="standardPop" id="standardPop">
                    </div>
                  </div>

                  </div>
                  <div class="modal-footer">
                      <button type="submit" id="btnPopulationAdd" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
