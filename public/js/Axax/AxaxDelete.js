$(document).ready(function(){
  $("#btnAxaxDelete").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
        return;
    }

    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        $.ajax({
            type: 'post',
            url: axaxDeleteUrl,
            data: {_token: csrf, rowID : dataRow['id']},
            success:function(response){
                alertify.alert(response);
                table.rows('.selected').remove().draw(false);
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
