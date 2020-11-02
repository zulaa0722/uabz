

<div id="modalFoodFactoryEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүнсний үйлдвэрийн судалгаа засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmFoodFactoryEdit" action="" method="post">
                @csrf
                <input type="hidden" name="rowID" id="rowID" value="">
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Аймгийн нэр:</label>
                      <select class="form-control" name="provID" id="eprovName" getSymUrl="{{url("/sym/get/by/provID")}}">
                          <option value="-1">Сонгоно уу</option>
                        @foreach ($provinces as $province)
                          <option value="{{$province->id}}">{{$province->provName}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Сумын нэр:</label>
                      <select class="form-control" name="symID" id="ecmbSymNew">
                          <option value="-1">Сонгоно уу</option>

                      </select>
                    </div>
                  </div>
                  <div class="clearfix"></div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Хүнсний үйлдвэрийн нэр</label>
                      <input class="form-control" type="text" name="name" id="ename">
                    </div>
                    <div class="col-md-6">
                      <label>Үйл ажиллагааны чиглэл</label>
                      <input class="form-control" type="text" name="activity" id="eactivity">
                    </div>
                    <div class="col-md-6">
                      <label>Үйлдвэрийн суурилагдсан хүчин чадал</label>
                      <input class="form-control" type="text" name="capacity" id="ecapacity">
                    </div>
                    <div class="col-md-6">
                      <label>Хариуцах хүний нэр:</label>
                      <input class="form-control" type="text" name="resName" id="eresName">
                    </div>
                    <div class="col-md-6">
                      <label>Холбоо барих утас:</label>
                      <input class="form-control" type="text" name="contact" id="econtact">
                    </div>
                  </div>
                  {{-- <p class="text-right">**Механикжсан агуулах бол (М), уламжлалт ажиллагаатай бол (У), хөргүүртэй агуулах бол (X), <br>
                  хөргүүртэй агуулах бол (Xгүй) гэж тус тус тэмдэглэнэ. Төлөв давхардаж болно.</p> --}}

                  </div>
                  <div class="modal-footer">
                      <button type="submit" post-url="{{url("/survey/food/factory/edit")}}" id="btnFoodFactoryUpdate" class="btn btn-primary">Засах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
