

<div id="modalSubProductsNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg  " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүнсний бүтээгдэхүүн нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSubProductsNew" action="" method="post">
                @csrf
                <div class="form-group row">
                  <div class="col-md-5">
                    <label>Хүнсний бүтээгдэхүүн</label>
                    <select class="form-control"  name="fProductID" id="fProductID" >
                      <option value="-1">Сонгоно уу</option>
                      @foreach ($getFoodProducts as $getFoodProduct)
                        <option value="{{$getFoodProduct->id}}">{{$getFoodProduct->productName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-5">
                    <label>Орлох хүнс</label>
                    <input class="form-control" type="text" id="subName" name="subName">
                  </div>
                  <div class="col-md-2">
                    <label>Итгэлцүүр</label>
                    <input class="form-control" type="number" id="multiplier" name="multiplier">
                  </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubProductsAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
