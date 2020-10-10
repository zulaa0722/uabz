<div id="modalLogCattleQnttNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    {{-- modal-lg --}}
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title justify-content-center" style="text-align:center;">Өдөр тутмын малын тоо толгойн мэдээлэл нэмэх</h5>
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
                <label style="font-size:16px;">&nbsp тоо толгой </label>
              </div>

              <div class="form-group row">
                @foreach ($cattles as $cattle)
                  <div class="col-md-4">
                    <label style="margin-bottom:-20px;">{{$cattle->cattleName}}</label>
                    <input style="margin-bottom:10px;" class="form-control cattleQnttFields" type="number" id="{{$cattle->id}}" ratio="{{$cattle->ratio}}">
                    <input type="hidden" name="" id="cattle{{$cattle->id}}" value="{{$cattle->id}}">
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Хонин толгойд шилжүүлэхэд:</label>&nbsp
                    <label id="sheep{{$cattle->id}}"></label>
                    <label style="margin-bottom:-20px; font-size:12px;color:#400513">Нийт махны кг:</label>&nbsp
                    <label id="sheepKg{{$cattle->id}}"></label>
                  </div>
                @endforeach
                <div class="col-md-4">
                  <label for="name" class="">Огноо:</label>
                  <input style="margin-bottom:10px;" type="date" id="dateOgnoo" class="form-control" name="" value="">
                </div>
              </div>
              <div class="clearfix"></div>

              <div class="clearfix"></div>
              <div class="modal-footer">
                  <button type="submit" post-url="{{url("/log/cattle/new")}}" id="btnLogCattleQnttAdd" class="btn btn-primary">Хадгалах</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
              </div>
          </form>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
