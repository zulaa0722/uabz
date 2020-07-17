$(document).ready(function(){
  $("#btnProvinceDelete").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
        return;
    }

    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        $.ajax({
            type: 'post',
            url: provinceDeleteUrl,
            data: {_token: csrf, rowID : dataRow['id']},
            success:function(response){
                alertify.alert(response);
                provinceTableRefresh();
                dataRow = "";
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
            }
        })
      } else {
          alertify.error('Устгах үйлдэл цуцлагдлаа.');
      }
    });

  });

});
