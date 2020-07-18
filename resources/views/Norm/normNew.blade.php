<div id="modalNormNew" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Норм нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmSectorNew" action="" method="post">
                  <div class="row">
                    <div class="col-md-3">
                        <label>Нормын нэр:</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="normName" id="txtNormName" value="">
                    </div>
                  </div>
                  <div class="row">
                    @foreach ($foods as $food)
                      <div class="col-md-3">
                          <label>{{$food->productName}} /кг/</label>
                          <input type="number" foodQntt="{{$food->foodQntt}}" kcal="{{$food->foodCkal}}" foodID="{{$food->id}}" class="form-control txtProductQtt" name="" value="" placeholder="Тоо хэмжээ">
                          <input type="hidden" class="form-control" id="product_kcal{{$food->id}}" name="" value="" placeholder="0">
                          <label for="">Ккал: </label><label id="lblKcal{{$food->id}}" for="">0</label>
                      </div>
                    @endforeach
                  </div>
                  <div class="row">
                      <h5 class="text-center"><label for="">Нийт ккал: </label><label id="lblAllKcal" for="">0</label></h5>
                      <input type="hidden" class="form-control" id="hideSumKcal" name="" value="0">
                  </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnNormAdd" post-url="{{url("/norm/new")}}" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
