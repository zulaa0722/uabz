

<div id="modalFoodProductsEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Авч хэрэгжүүлэх арга хэмжээ нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmFoodProductsEdit" action="" method="post">
                @csrf
                <input type="hidden" name="rowID" id="rowID">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label>Хүнсний бүтээгдэхүүн</label>
                    <input class="form-control" type="text" id="eproductName" name="productName">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-8">
                    <label>Хэмжээ</label>
                    <input class="form-control" type="number" id="efoodQntt" name="foodQntt">
                  </div>
                  <div class="col-md-4">
                    <label>Уураг</label>
                    <input class="form-control" type="number" id="efoodProtein" name="foodProtein">
                  </div>
                  <div class="col-md-4">
                    <label>Тос</label>
                    <input class="form-control" type="number" id="efoodFat" name="foodFat">
                  </div>

                  <div class="col-md-4">
                    <label>Нүүрс ус</label>
                    <input class="form-control" type="number" id="efoodCarbon" name="foodCarbon">
                  </div>

                  <div class="col-md-4">
                    <label>ккал</label>
                    <input class="form-control" type="number" id="efoodCkal" name="foodCkal">
                  </div>
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnFoodProductsUpdate" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
