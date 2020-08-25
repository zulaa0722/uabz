

<div id="modalSubProductsEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүнсний бүтээгдэхүүн нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSubProductsEdit" action="" method="post">
                @csrf
                <input type="hidden" name="rowID" id="rowID">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Хүнсний бүтээгдэхүүн</label>
                    <select class="form-control" name="fProductID" id="efProductID" >
                      <option value="-1">Сонгоно уу</option>
                      @foreach ($getFoodProducts as $getFoodProduct)
                        <option value="{{$getFoodProduct->id}}">{{$getFoodProduct->productName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Орлох хүнс</label>
                    <input class="form-control" type="text" id="esubName" name="subName">
                  </div>
                  <div class="col-md-4">
                    <label>Итгэлцүүр</label>
                    <input class="form-control" type="number" id="emultiplier" name="multiplier">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Үнэ /кг, төгрөгөөр/</label>
                    <input class="form-control" type="number" id="eprice" name="price">
                  </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubProductsUpdate" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
