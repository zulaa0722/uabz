<div id="modalShowSub" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Гол нэрийн бүтээгдэхүүний орлуулах бүтээгдэхүүн нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              {{-- <form id="frmFoodReserveNew" action="" method="post"> --}}
                @csrf
                <div class="form-group row justify-content-center">
                  <label id="provName" style="color:blue; font-size:16px;"> </label>
                  <label style="font-size:16px;">&nbsp аймгийн &nbsp</label>
                  <label style="color:blue; font-size:16px;" id="symName"></label>
                  <label style="font-size:16px;">&nbsp сум </label>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label style="margin-bottom:-20px; font-size:16px">Байгууллага нэр</label><br>
                    <input class="form-control" type="text" id="companyName"><br>
                  </div>
                  <div class="col-md-6">
                    <label style="margin-bottom:-20px; font-size:16px">Байгууллага код</label><br>
                    <input class="form-control" type="number" id="companyCode"><br>
                    {{-- <label style="margin-bottom: 20px; font-size:12px;color:#400513">Нийт дүн: &nbsp</label><label id="totalPrice">&nbsp</label>
                    <label style="color:red;font-style:bold;">&nbsp /төг/</label> --}}
                  </div>
                </div>
                <div class="clear-fix"></div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label class="form-group">Орлуулах хүнсний гол нэрийн бүтээгдэхүүний нэр:</label> &nbsp&nbsp
                    <label id="changeProduct" style="color:blue; font-style:bold; font-size:16px"></label>
                  </div>


                  <div class="clearfix"></div>
                  <div class="col-md-12" id="showSubCheckboxes">

                    <div class="row">

                      <div class="form-check col-md-4">
                        <div class="text-left">

                          <input type="checkbox" style="font-size: 16px;" id="3" class="subChecks" value="">
                          <label class="form-check-label" for="3">adsfadsf</label>
                        </div>
                        <label style="font-size: 13px;" class="font-weight-light">Шилжүүлэх итгэлцүүр: &nbsp</label>
                      </div>
                      <div class="form-check col-md-4">

                        <input type="checkbox" style="font-size: 16px;" id="2" class="subChecks" value="">
                        <label class="form-check-label" for="2">adsfadsf</label>
                      </div>

                    </div>
                        {{-- <label class="form-check-label col-md-4">
                          <div class="text-left">
                            <input type="checkbox" style="font-size: 16px;" class="subChecks" value="">ass
                          </div>
                          <label style="font-size: 13px;">Шилжүүлэх итгэлцүүр: &nbsp</label>
                          <label style="color:red; font-style:bold; font-size:15x">8.6</label>
                          <input type="number" class="form-control-sm subText d-none" id="' + val.id + '">
                          <div class="text-left" id="price'+ val.id +'">
                          <label>Нийт өртөг/төг/: &nbsp</label>
                          <label style="color:red; font-style:bold; font-size:15x">asdfasdf</label>
                          </div>
                        </label>

                          <label class="form-check-label col-md-4">
                            <div class="text-left">
                              <input type="checkbox" style="font-size: 16px;" class="subChecks" value="">asdfagfasdf
                            </div>
                            <label style="font-size: 13px;">Шилжүүлэх итгэлцүүр: &nbsp</label>
                            <label style="color:red; font-style:bold; font-size:15x">8.6</label>
                            <input type="number" class="form-control-sm subText d-none" id="' + val.id + '">
                          </label> --}}


                    </div>
                  {{-- <div class="form-group row"> --}}
                    {{-- @php
                      $subProducts = App\Http\Controllers\SubProductsController::getSubsByProductID(4);
                    @endphp --}}
                    {{-- @foreach ($subProducts as $subProduct)
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" name="" value="{{$subProduct->id}}">&nbsp {{$subProduct->subName}}

                        </label>
                      </div>
                    @endforeach --}}
                  {{-- </div> --}}
                </div>
                </div>

            <div class="modal-footer">
                <button type="submit" id="insertSub" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            {{-- </form> --}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
