var provID;
var symID;
$(document).on("click", ".showSubProducts", function(){

  var prodID = $(this).attr("productID");
  var provName = $(this).attr("provName");
  var symName = $(this).attr("symName");
  var product = $(this).attr("product");
  provID = $(this).attr("provID");
  symID = $(this).attr("symID");


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
          div = div + '<div class="col-md-4 border">';
          div = div + '<div class="text-left">'
          div = div + '<input type="checkbox" class="subChecks" id="'+ val.id +'" >';
          div = div + '<label style="font-style:bold; font-size:15x" for="'+val.id+'">&nbsp&nbsp'+ val.subName +'</label>';
          div = div + '</div>';

          div = div + '<label style="font-size: 13px;" class="font-weight-light">Шилжүүлэх итгэлцүүр: &nbsp</label>';
          div = div + '<label style="color:red; font-style:bold; font-size:15x" id="multi'+ val.id +'">'+ val.multiplier +'</label>';

          div = div + '<div class="text-left d-none" id="div'+ val.id +'"';
          div = div + '<label>Хэмжээ /кг/: &nbsp</label>';
          div = div + '<input type="number" subPrice="' +val.price+ '" style="margin-bottom:5px; margin-top:-5px;"';
          div = div + ' class="form-control-sm subInput col-md-6" subInputID="' + val.id + '" id="qntt'+ val.id +'"">';
          div = div + '</div>';

          div = div + '<div class="text-left d-none" id="price'+ val.id +'"';
          div = div + '<label>Нэгжийн үнэ/төг/: &nbsp</label>';
          div = div + '<label style="color:red; font-style:bold; font-size:15x" id="priceText'+ val.id +'" subPrice="'+val.price+'">'+ val.price +'</label>';
          div = div + '</div>';

          div = div + '<div class="text-left d-none" id="totalPrice'+ val.id +'"';
          div = div + '<label>Нийт өртөг/төг/: &nbsp</label>';
          div = div + '<label style="color:red; font-style:bold; font-size:15x" id="totalPriceText'+val.id+'">0</label>';
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
  var totalPrice = 0;
  var v = $(this).attr("subPrice");


  totalPrice = $(this).val() * v;
  if(v !== "null" && $(this).val() !== "")
    $("#totalPriceText"+$(this).attr("subInputID")).text(totalPrice);
  else {
    $("#totalPriceText"+$(this).attr("subInputID")).text("0");
  }
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

    if($("#companyName").val() == ""){
      alertify.error("Та заавал БАЙГУУЛЛАГЫН НЭРИЙГ оруулна уу!!!");
      return;
    }

    jsonSubs = [];
    $(".subChecks").each(function(index){
      if($(this).prop('checked'))
      {
        item = {};
        item["id"] = $(this).attr("id");
        item["multiplier"] = $("#multi"+$(this).attr("id")).text();
        item["qntt"] = $("#qntt"+$(this).attr("id")).val();
        item["totalPrice"] = $("#totalPriceText"+$(this).attr("id")).text();
        jsonSubs.push(item);
      }
    });

    $.ajax({
      type: "post",
      url: saveSubs,
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: provID,
        symID: symID,
        companyName: $("#companyName").val(),
        companyCode: $("#companyCode").val(),
        subs: jsonSubs
      },

      success: function(response){
        // alert("asdf");
        console.log(response);
        // alertify.alert(response, function(){
        //   // alertify.message('OK');
        // });
        $("#modalShowSub").modal("hide");
      }
    });


  });
});

$(document).on("click", ".editNorm", function(){
  // var symID = $(this).attr("symID");
  // var prodID = $(this).attr("productID");
  // alertify.confirm('Та энэхүү нэрийн хүнсний бүтээгдэхүүнийг нормоос хасахад итгэлтэй байна уу?',
  // function(e){
  //   if(e){
  //     $.ajax({
  //       type: "post",
  //       url: editNorm,
  //       data: {
  //         _token: $('meta[name="csrf-token"]').attr('content'),
  //         symID: symID,
  //         prodID: prodID
  //       },
  //       success: function(response){
  //         table.rows('.selected').remove().draw(false);
  //         alertify.success(response);
  //       }
  //     });
  //   }
  // });

});
