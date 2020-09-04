<div id="modalDangerEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Онц байдлыг засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              {{--START Ots baidal sum sumdaar zarlah form --}}
              <form id="frmDangerEdit" action="" method="post" autocomplete="off">
                @csrf
                <div id="hide">
                  <div class="form-group row">
                      <label for="password" class="col-md-3 col-form-label text-md-right">Бүс:</label>

                      <div class="col-md-7">
                        <select class="form-control" name="sector" id="cmbBus" post-url="{{url("/get/prov/by/bus")}}">
                          <option value="-1">Сонгоно уу!!!</option>
                          @foreach ($sectors as $sector)
                            <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="password" class="col-md-3 col-form-label text-md-right">Аймаг:</label>

                      <div class="col-md-7">
                        <select class="form-control" name="province" id="cmbProvs" post-url="{{url("/sym/get/by/provID")}}">
                        </select>
                      </div>
                  </div>
                  <div class="form-group row" id="divSums">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 col-form-label text-md-left">Сонгосон сумдууд:</label>
                  <div class="col-md-7" id="divChoosedSumduud">
                    {{-- <a href="#" class="badge badge-info">Өмнөдэлгэр<i class="fas fa-times mx-1"></i></a> --}}
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-left">Тушаалын дугаар:</label>
                    <div class="col-md-7">
                      <input type="text" class="form-control" id="txtCommandNumber" name="commandNumber" value="" maxlength="250" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Огноо:</label>
                    <div class="col-md-7">
                      <input type="date" class="form-control" id="dateDeclareDate" name="declareDate" value="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Тайлбар:</label>
                    <div class="col-md-7">
                      <textarea class="form-control" id="areaComment" name="comment" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row" id="divPassword">
                    <label for="password" class="col-md-3 col-form-label text-md-right">Нууц үг:</label>

                    <div class="col-md-7">
                      <input type="password" class="form-control" id="txtPassword" name="password" value="" placeholder="password" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" id="btnEditDanger" post-url="{{url("/danger/edit")}}" class="btn btn-primary">Онц байдал засах</button>
                  </div>
                </div>
                <div class="d-none" id="divLoading">
                  <div class="d-flex flex-column align-items-center justify-content-right">
                    <div class="row">
                      <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>
                    <div class="row">
                      <strong>Онц байдлыг засаж байна. Түр хүлээнэ үү...</strong>
                    </div>
                  </div>
                </div>
              </form>
              {{--END Ots baidal sum sumdaar zarlah form --}}


                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
