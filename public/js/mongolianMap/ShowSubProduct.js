$(document).on("click", ".showSubProducts", function(){

  var prodID = $(this).attr("productID");
  var provName = $(this).attr("provName");
  var symName = $(this).attr("symName");
  var product = $(this).attr("product");

  $.ajax({
    type: "post",
    url: showCompanySubs,
    data: {
      productID: prodID,
      _token: $('meta[name="csrf-token"]').attr('content')
    },

    success: function(response){
      $("#modalShowSub").modal("show");
      $("#provName").text(provName);
      $("#symName").text(symName);
      $("#changeProduct").text(product);

      if(response.length != 0)
      {
        var div = '';
        div = div + '<div class="row">';
        $.each(response, function(key, val){
          // div = div + '<div class="form-group row col-md-4">';
          div = div + '<div class="col-md-4 border">';
          div = div + '<div class="text-left">'
          div = div + '<input type="checkbox" class="subChecks" id="'+ val.id +'" >';
          div = div + '<label style="font-style:bold; font-size:15x" for="'+val.id+'">&nbsp&nbsp'+ val.subName +'</label>';
          div = div + '</div>';

          div = div + '<label style="font-size: 13px;" class="font-weight-light">Шилжүүлэх итгэлцүүр: &nbsp</label>';
          div = div + '<label style="color:red; font-style:bold; font-size:15x">'+ val.multiplier +'</label>';

          div = div + '<div class="text-left d-none" id="div'+ val.id +'"';
          div = div + '<label>Хэмжээ /кг/: &nbsp</label>';
          div = div + '<input type="number" style="margin-bottom:5px; margin-top:-5px;" class="form-control-sm subInput col-md-6" id="' + val.id + '">'
          div = div + '</div>';

          div = div + '<div class="text-left d-none" id="price'+ val.id +'"';
          div = div + '<label>Нэгжийн үнэ/төг/: &nbsp</label>';
          div = div + '<label style="color:red; font-style:bold; font-size:15x" id="priceText'+ val.id +'">'+ val.price +'</label>';
          div = div + '</div>';

          div = div + '<div class="text-left d-none" id="totalPrice'+ val.id +'"';
          div = div + '<label>Нийт өртөг/төг/: &nbsp</label>';
          div = div + '<label style="color:red; font-style:bold; font-size:15x" id="totalPriceText'+val.id+'">'+ val.price +'</label>';
          div = div + '</div>';
          div = div + '</div>';
        });
        div = div + '</div>';

        $("#showSubCheckboxes").html('');
        $("#showSubCheckboxes").html(div);
      }
      else {
        var div = '<label style="color:red; font-style:bold; font-size:15x">';
        div = div + 'Тухайн хүнсний гол нэрийн бүтээгдэхүүнийг орлох хүнсний бүтээгдэхүүн бүртгэгдээгүй байна!</label>';
        $("#showSubCheckboxes").html('');
        $("#showSubCheckboxes").html(div);
      }
    }
  });
});
$(document).on("keyup", ".subInput", function(){
  
  $("#totalPriceText"+$(this).attr("id")).text("3333");
});
$(document).on("click", ".subChecks", function(){
  if ($(this).prop('checked'))
  {
    $("#div"+$(this).attr("id")).removeClass("d-none");
    $("#price"+$(this).attr("id")).removeClass("d-none");
    $("#totalPrice"+$(this).attr("id")).removeClass("d-none");
  }
  else {
    $("#div"+$(this).attr("id")).addClass("d-none");
    $("#price"+$(this).attr("id")).addClass("d-none");
    $("#totalPrice"+$(this).attr("id")).addClass("d-none");
  }
});
$(document).ready(function(){
  $("#insertSub").click(function(){
    alert("asd22f");
  });
});
