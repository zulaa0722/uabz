<div id="modalLogSpent" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Гол нэрийн бүтээгдэхүүний зарцуулалтыг оруулах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="form-group row justify-content-center">
                    <label id="provName" style="color:blue; font-size:16px;"> </label>
                    <label style="font-size:16px;">&nbsp аймгийн &nbsp</label>
                    <label style="color:blue; font-size:16px;" id="symName"></label>
                    <label style="font-size:16px;">&nbsp сум </label>
                </div>
                  <div class="form-group row">
                  <div class="col-md-3">
                    <label>Огноо:</label>
                    <input type="date" name="spentDate" id="spentDate" value="" class="form-control">
                  </div>
                </div>

                <div class="form-group row">

                  @foreach ($products as $product)
                    <div class="col-md-3">

                      <button class="accordion col-md-12" style="cursor:default;"><div class="col-md-12"><label id="productName">{{$product->productName}}</label></div>
                      <button>
                      <div class="panel col-md-12" style="padding: 0px;" lol="aaa">
                        <table style="text-align:center" class="col-md-12">
                          <tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт үлдсэн /кг/:</td><td>'+val.remaining+'</td></tr>
                          <tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт уураг /гр/:</td><td>'+val.foodProtein+'</td></tr>
                          <tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт өөх тос /гр/:</td><td>'+val.foodFat+'</td>></tr>
                          <tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт нүүрс ус /гр/:</td><td>'+val.foodCarbon+'</td></tr>
                          <tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт Ккал /мян.ккал/:</td><td>'+val.Kcal/1000+'</td></tr>
                        </table>
                      </div>

                      {{-- <label style="margin-bottom:-20px;">{{$product->productName}} /кг/</label><br>
                      <label>Нөөцөд байгаа хэмжээ: </label>
                      <label id="nowQntt"></label>
                      <input class="form-control foodProductFields" type="number" id="{{$product->id}}" name="{{$product->productName}}"
                        foodQntt="{{$product->foodQntt}}" foodKcal="{{$product->foodCkal}}">
                      <label style="margin-bottom: 20px; font-size:12px;color:#400513">Нөөцөд үлдэх хэмжээ: &nbsp</label><label id="remaining{{$product->id}}">&nbsp</label> --}}
                    </div>
                  @endforeach
                </div>

                <div class="clearfix"></div>


            <div class="modal-footer">
                <button type="submit" id="btnFoodReserveAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style media="screen">
  .accordion {
    background-color: #eee;
    color: #444;
    padding: 1px;
    padding-top: 12px;
    border: none;
    border-radius: 5px;
    text-align: left;
    outline: none;
    font-size: 14px;
    transition: 0.4s;
    line-height: 13px;
  }
  .active, .accordion:hover {
    background-color: #ccc;
  }
  .accordion:after {
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
  }
  .panel {
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    border: none;
  }
</style>
