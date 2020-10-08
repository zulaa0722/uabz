<div id="modalLogCattleQnttNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    {{-- modal-lg --}}
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title justify-content-center" style="text-align:center;">Малын тоо толгойн мэдээлэл нэмэх</h5>
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
                <label style="font-size:16px;">&nbsp сумын &nbsp</label>
                <label style="color:blue; font-size:16px;" id="lblYear"></label>
                <label style="font-size:16px;">&nbsp оны тоо толгой </label>
              </div>
              <div class="clearfix"></div>

              <div class="form-group row">
                  <div class="col-md-4">
                    <label style="margin-bottom:-20px;">Хонь</label>
                    <input style="margin-bottom:10px;" class="form-control cattleQnttFields" type="number" id="1" ratio="1">
                    <input type="hidden" name="" id="cattle1" value="1">
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                    <label id="sheep1"></label>
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                    <label id="sheepKg1"></label>
                  </div>
                  <div class="col-md-4">
                    <label style="margin-bottom:-20px;">Ямаа</label>
                    <input style="margin-bottom:10px;" class="form-control cattleQnttFields" type="number" id="2" ratio="0.9">
                    <input type="hidden" name="" id="cattle2" value="0.9">
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                    <label id="sheep2"></label>
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                    <label id="sheepKg2"></label>
                  </div>
                  <div class="col-md-4">
                    <label style="margin-bottom:-20px;">Үхэр</label>
                    <input style="margin-bottom:10px;" class="form-control cattleQnttFields" type="number" id="3" ratio="6">
                    <input type="hidden" name="" id="cattle3" value="6">
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                    <label id="sheep3"></label>
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                    <label id="sheepKg3"></label>
                  </div>
                  <div class="col-md-4">
                    <label style="margin-bottom:-20px;">Адуу</label>
                    <input style="margin-bottom:10px;" class="form-control cattleQnttFields" type="number" id="4" ratio="7">
                    <input type="hidden" name="" id="cattle4" value="7">
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                    <label id="sheep4"></label>
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                    <label id="sheepKg4"></label>
                  </div>
                  <div class="col-md-4">
                    <label style="margin-bottom:-20px;">Тэмээ</label>
                    <input style="margin-bottom:10px;" class="form-control cattleQnttFields" type="number" id="5" ratio="5">
                    <input type="hidden" name="" id="cattle5" value="5">
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                    <label id="sheep5"></label>
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                    <label id="sheepKg5"></label>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" id="btnCattleQnttAdd" class="btn btn-primary">Хадгалах</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
              </div>
          </form>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
