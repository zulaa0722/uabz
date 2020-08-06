<div id="modalFoodReserveNew" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүнсний нөөцийн судалгаа нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmFoodReserveNew" action="" method="post">
                @csrf
                <div class="form-group row justify-content-center">
                    <label id="provName" style="color:blue; font-size:16px;"> </label>
                    <label style="font-size:16px;">&nbsp аймгийн &nbsp</label>
                    <label style="color:blue; font-size:16px;" id="symName"></label>
                    <label style="font-size:16px;">&nbsp сум </label>
                </div>
                  <div class="form-group row">
                  <div class="col-md-3">
                    <label>Огноо:</label>
                    <input type="date" name="foodReserveDate" id="foodReserveDate" value="" class="form-control">
                  </div>
                </div>

                <div class="form-group row">

                  @foreach ($products as $product)
                    <div class="col-md-3">
                      <label style="margin-bottom:-20px;">{{$product->productName}}</label><label style="color:red;font-style:bold;">&nbsp /кг/</label>
                      <input class="form-control foodProductFields" type="number" id="{{$product->id}}" name="{{$product->productName}}"
                        foodQntt="{{$product->foodQntt}}" foodKcal="{{$product->foodCkal}}">
                      <label style="margin-bottom: 20px; font-size:12px;color:#400513">Нийт Ккал: &nbsp</label><label id="foodTotalKcal{{$product->id}}">&nbsp</label>
                    </div>
                  @endforeach
                </div>

                <div class="clearfix"></div>


            <div class="modal-footer">
                <button type="submit" id="btnFoodReserveAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
