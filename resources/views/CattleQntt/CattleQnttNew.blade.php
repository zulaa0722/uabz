  <div id="modalCattleQnttNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title justify-content-center" style="text-align:center;">Малын тоо толгой нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmCattleQnttNew" action="" method="post">
                @csrf
                <div class="form-group row justify-content-center">
                  <label id="provName" style="color:blue; font-size:16px;"> </label>
                  <label style="font-size:16px;">&nbsp аймгийн &nbsp</label>
                  <label style="color:blue; font-size:16px;" id="symName"></label>
                  <label style="font-size:16px;">&nbsp сум </label>
                </div>
                <div class="clearfix"></div>

                <div class="form-group row">
                    @foreach ($cattles as $cattle)
                      <div class="col-md-4">
                        <label style="margin-bottom:-20px;">{{$cattle->cattleName}}</label>
                        <input style="margin-bottom:10px;" class="form-control cattleQnttFields"
                          type="number" id="{{$cattle->id}}" ratio="{{$cattle->ratio}}">
                        <input type="hidden" name="" id="cattle{{$cattle->id}}" value="{{$cattle->ratio}}">
                        <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                        <label id="sheep{{$cattle->id}}"></label>
                        <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                        <label id="sheepKg{{$cattle->id}}"></label>

                      </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnCattleQnttAdd" class="btn btn-primary">Хадгалах</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
