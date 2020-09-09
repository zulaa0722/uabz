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
        div = div + '<label class="form-check-label col-md-3">'
        div = div + '<input type="checkbox" name="" value="ddd">&nbsp '+ val.subName;
        div = div + '<input type="number" class="form-control">'
        div = div +'  </label> &nbsp &nbsp &nbsp';
      });

      $("#showSubCheckboxes").html('');
      $("#showSubCheckboxes").html(div);
    }
  });





});
