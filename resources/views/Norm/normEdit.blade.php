<div id="modalNormEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хүнсний цэс засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSectorNew" action="" method="post">
                  <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-center"><strong><label id="lblEditNormName"></label></strong></h4>
                    </div>
                  </div>
                  <div class="row">
                    @foreach ($foods as $food)
                      <div class="col-md-3">
                          <label>{{$food->productName}} /кг/</label>
                          <input type="number" id="editProductID{{$food->id}}" foodQntt="{{$food->foodQntt}}" kcal="{{$food->foodCkal}}" foodID="{{$food->id}}" class="form-control txtEditProductQtt" name="" value="" placeholder="Тоо хэмжээ">
                          <input type="hidden" class="form-control" id="editProduct_kcal{{$food->id}}" name="" value="" placeholder="0">
                          <label for="">Ккал: </label><label id="lblEditKcal{{$food->id}}" for="">0</label>
                      </div>
                    @endforeach
                  </div>
                  <div class="row">
                      <h5 class="text-center"><label for="">Нийт ккал: </label><label id="lblEditAllKcal" for="">0</label></h5>
                      <input type="hidden" class="form-control" id="hideEditSumKcal" name="" value="0">
                  </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnNormEdit" post-url="{{url("/norm/update")}}" class="btn btn-primary">Засах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
