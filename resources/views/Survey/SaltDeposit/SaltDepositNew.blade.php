

<div id="modalSaltDepositNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Орон нутаг дахь давсны ордын судалгаа нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSaltDepositNew" action="" method="post">
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
                      <label>Ордын нэр</label>
                      <input class="form-control" type="text" name="dpstName" id="dpstName">
                    </div>
                    <div class="col-md-6">
                      <label>Ордын нөөц /тн/</label>
                      <input class="form-control" type="text" name="dpstReserve" id="dpstReserve">
                    </div>
                    <div class="col-md-6">
                      <label>Ордын төлөв*</label>
                      <input class="form-control" type="text" name="dpstState" id="dpstState">
                    </div>
                    <div class="col-md-6">
                      <label>Аймгийн төв хүртэлх зай /км/</label>
                      <input class="form-control" type="number" name="distance" id="distance">
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
                  {{-- <p class="text-right">**Механикжсан агуулах бол (М), уламжлалт ажиллагаатай бол (У), хөргүүртэй агуулах бол (X), <br>
                  хөргүүртэй агуулах бол (Xгүй) гэж тус тус тэмдэглэнэ. Төлөв давхардаж болно.</p> --}}

                  </div>
                  <div class="modal-footer">
                      <button type="submit" post-url="{{url('/survey/salt/deposit/new')}}" id="btnSaltDepositAdd" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
