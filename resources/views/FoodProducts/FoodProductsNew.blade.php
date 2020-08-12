<div id="modalFoodProductsNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүнсний бүтээгдэхүүн нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmFoodProductsNew" action="" method="post">
                @csrf
                <div class="form-group row">
                  <div class="col-md-9">
                    <label>Хүнсний бүтээгдэхүүн</label>
                    <input class="form-control" type="text" id="productName" name="productName">
                  </div>
                  <div class="col-md-3">
                    <label>Хэмжээ /kг/</label>
                    <input class="form-control" type="number" id="foodQntt" name="foodQntt">
                  </div>

                  <div class="col-md-12">
                    <label>ккал</label>
                    <input class="form-control" type="number" id="foodCkal" name="foodCkal">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Уураг /гр/</label>
                    <input class="form-control" type="number" id="foodProtein" name="foodProtein">
                  </div>
                  <div class="col-md-6">
                    <label>Тос /гр/</label>
                    <input class="form-control" type="number" id="foodFat" name="foodFat">
                  </div>

                  <div class="col-md-6">
                    <label>Нүүрс ус /гр/</label>
                    <input class="form-control" type="number" id="foodCarbon" name="foodCarbon">
                  </div>

                  <div class="col-md-9">
                    <label>ккал /Томъёогоор бодогдсон/</label>
                    <input class="form-control" type="number" id="foodTomCkal" name="foodTomCkal">
                  </div>
                  <div class="col-md-9">
                    <label>Үнэ: /кг, төгрөгөөр/</label>
                    <input class="form-control" type="number" id="foodPrice" name="foodPrice">
                  </div>
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnFoodProductsAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
