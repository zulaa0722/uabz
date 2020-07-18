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
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Аймаг сонгоно уу</label>
                    <select class="form-control" name="provID" id="provName" getSymUrl="{{url("/sym/get/by/provID")}}">
                      <option value="-1">Сонгоно уу</option>
                      @foreach ($provinces as $province)
                      <option value="{{$province->id}}">{{$province->provName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Сум сонгоно уу</label>
                    <select class="form-control" name="symID" id="symName">
                      <option value="-1">Сонгоно уу</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  @foreach ($products as $product)
                    <div class="col-md-3">
                      <label style="margin-bottom:-20px;">{{$product->productName}}</label>
                      <input class="form-control foodProductFields" type="number" id="{{$product->id}}" name="foodProducsts" style="margin-bottom:10px;">
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
