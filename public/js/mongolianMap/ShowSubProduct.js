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

      var div = '';
      $.each(response, function(key, val){
        // div = div + '<div class="form-check">';
        div = div + '<label class="form-check-label col-md-4">'
        div = div + '<input type="checkbox" style="font-size: 16px;" class="subChecks" value="'+ val.id +'">&nbsp '+ val.subName;
        div = div + '<label style="font-size: 13px;">Шилжүүлэх итгэлцүүр: &nbsp</label>';
        div = div + '<label style="color:red; font-style:bold; font-size:15x">'+ val.multiplier +'</label>';
        div = div + '<input type="number" class="form-control subText d-none" id="' + val.id + '">'
        div = div +'  </label> &nbsp &nbsp &nbsp';
      });

      $("#showSubCheckboxes").html('');
      $("#showSubCheckboxes").html(div);
    }
  });
});
$(document).on("click", ".subChecks", function(){
  if ($(this).prop('checked'))
  {
    $("#"+$(this).val()).removeClass("d-none");
  }
  else {
    $("#"+$(this).val()).addClass("d-none");
  }
});
$(document).ready(function(){
  $("#insertSub").click(function(){

  });
});
