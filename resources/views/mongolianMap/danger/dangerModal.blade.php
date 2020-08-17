<div id="modalDeclareDanger" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Онц байдал зарлах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


              <form id="frmDeclareDangerByBus" action="" method="post" autocomplete="off">
                @csrf
                <div class="row">
                @foreach ($sectors as $sector)
                    <div class="col-md-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input sectors" name="sectors[]" value="{{$sector->id}}">{{$sector->sectorName}}
                        </label>
                      </div>
                    </div>
                @endforeach
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Тушаалын дугаар:</label>
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
                      <input type="password" class="form-control" id="txtPassword" name="password1" value="" autocomplete="off" />
                    </div>
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" id="btnDeclareDangerBus" post-url="{{url("/declare/danger/by/sector")}}" class="btn btn-primary">Хадгалах</button>
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
                      <strong>Онц байдал зарлаж байна. Түр хүлээнэ үү...</strong>
                    </div>
                  </div>
                </div>
              </form>


              <form id="frmDeclareDangerByProvince" action="" method="post">
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right">Бүс:</label>

                    <div class="col-md-7">
                      <select class="form-control" name="bus" id="cmbBus" post-url="{{url("/get/prov/by/bus")}}">
                        <option value="-1">Сонгоно уу!!!</option>
                        @foreach ($sectors as $sector)
                          <option value="{{$sector->id}}">{{$sector->sectorName}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-group row" id="divProvs">
                  {{-- <div class="col-md-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="{{$sector->id}}">{{$sector->sectorName}}
                      </label>
                    </div>
                  </div> --}}
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Тушаалын дугаар:</label>
                    <div class="col-md-7">
                      <input type="text" class="form-control" id="txtCommandNumber" name="commandNumber" value="" maxlength="250" />
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
                    <label for="password" name="password" class="col-md-3 col-form-label text-md-right">Нууц үг:</label>

                    <div class="col-md-7">
                      <input type="password" class="form-control" id="txtPassword" name="password" value="">
                    </div>
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" id="btnDeclareDangerProvince" post-url="{{url("/declare/danger/by/province")}}" class="btn btn-primary">Хадгалах</button>
                  </div>
                </div>
              </form>


              <form id="frmDeclareDangerBySum" action="" method="post">
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
                    <label class="col-md-3 col-form-label text-md-right">Тушаалын дугаар:</label>
                    <div class="col-md-7">
                      <input type="text" class="form-control" id="txtCommandNumber" name="commandNumber" value="" maxlength="250" />
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
                      <input type="password" class="form-control" id="txtPassword" name="password" value="">
                    </div>
                </div>
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" id="btnDeclareDangerSum" post-url="{{url("/declare/danger/by/sum")}}" class="btn btn-primary">Хадгалах</button>
                  </div>
                </div>
              </form>


                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
