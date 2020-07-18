$(document).ready(function(){
  $("#btnAddModalOpen").click(function(){
      $("#modalFoodReserveNew").modal("show");
  });

  $("#provName").change(function(){
    // alert($("#provName").attr("getSymUrl"));
    $("#symName option[value!='-1']").each(function(){
      $(this).remove();
    })
    $.ajax({
      type: "post",
      url: $("#provName").attr("getSymUrl"),
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: $("#provName").val()
      },
      success:function(response){
        $.each(response, function (value, index ) {
           var o = new Option(index['symName'], index['id']);  // Option(name, val)
           $("#symName").append(o);
        });
      }
    });
  });

  $("#btnFoodReserveAdd").click(function(e){
        e.preventDefault();
        mainCode();
  });

  function mainCode()
  {
    var isEmpty = true;

    $(".foodProductFields").each(function(){
      if($(".foodProductFields").val() == "")
        isEmpty = true;
      else
        isEmpty = false;
    });

    if(isEmpty == true){ alertify.error("Та нөөцийн тоо хэмжээг оруулна уу!!!"); return; }

    $.ajax({
      type:'post',
      url:foodProductsNew,
      data:$("#frmFoodReserveNew").serialize(),
      success:function(response){
          alertify.alert( response);
          FoodProductsTableRefresh();
          emptyForm();
          dataRow = "";
      },
      error: function(jqXhr, json, errorThrown){// this are default for ajax errors
        var errors = jqXhr.responseJSON;
        var errorsHtml = '';
        $.each(errors['errors'], function (index, value) {
            errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
        });
        alert(errorsHtml);
      }
    });
  }



});
