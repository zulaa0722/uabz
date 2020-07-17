

<div id="modalDrinkingWaterNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Ундны усны эх үүсвэр нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmDrinkingWaterNew" action="" method="post">
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
                      <label>Байршил:</label>
                      <input class="form-control" type="text" name="location" id="location">
                    </div>
                    <div class="col-md-6">
                      <label>*Ундны усны худгийн нэр, дугаар:</label>
                      <input class="form-control" type="text" name="wellName" id="wellName">
                    </div>
                    <div class="col-md-6">
                      <label>Хүчин чадал, багтаамж (m3/сек):</label>
                      <input class="form-control" type="text" name="capacity" id="capacity">
                    </div>
                    <div class="col-md-6">
                      <label>**Төлөв:</label>
                      <input class="form-control" type="text" name="state" id="state">
                    </div>
                    <div class="col-md-6">
                      <label>Хариуцах хүний нэр:</label>
                      <input class="form-control" type="text" name="resName" id="resName">
                    </div>
                    <div class="col-md-6">
                      <label>Холбоо барих утас:</label>
                      <input class="form-control" type="text" name="contact" id="contact">
                    </div>
                  </div>
                  <p class="text-right">*Аймаг, нийслэл, сум, дүүргийн төвийн бүсийн худгийг оруулж тооцно. <br>
                  **Худан механикжсан бол (М), гар ажиллагаатай бол (Г) гэж тэмдэглэнэ.</p>

                  </div>
                  <div class="modal-footer">
                      <button type="submit" id="btnDrinkingWaterAdd" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
