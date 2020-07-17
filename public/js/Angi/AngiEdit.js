
$(document).ready(function(){
  $("#btnEditAngi").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
            alertify.error('Та засах мөрөө дарж сонгоно уу!!!');
            return;
        }
        emptyNewModal();
        $("#ekomandlal").val(dataRow["komandlal"]);
        $("#eangi").val(dataRow["id"]);
        $("#eimgUrl").attr('src', imageUrlZam + '/' + dataRow["imageUrl"]);
        $('#eimage').attr('src', imageUrlZam+'/'+dataRow["imageUrl"]);
        $("#eaddress").val(dataRow["angiAddress"]);

      $('#productEdit').modal('show');
  })

  $("#ebtnNewProductAdd").click(function(e){
    e.preventDefault();
    alert($("#ebarCode").val());
    var isInsert = true;

    if($("#barCode").val()==""||$("#barCode").val()==null){
        alertify.error("Та заавал <b>BAR CODE</b> оруулна уу!!!");
        isInsert = false;
    }
    if(isInsert == false){return;}
    $.ajax({
      type: 'post',
      url: storeProduct,
      data: $("#frmNewProduct").serialize(),
      // data: {
      //     _token: csrf,
      //     barCode: $("#barCode").val()
      // },
      success:function(response){
          alertify.alert(response);
          emptyNewModal();
          // hunhuchRefresh();
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
});
});

function emptyNewModal(){
  $("#ekomandlal").val("");
  $("#eangi").val("");
  $("#eimgUrl").attr('src', "");
  $("#eimage").attr('src', "");
  $("#eaddress").val("");

}
