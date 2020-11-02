$(document).ready(function(){
  $("#btnDeleteFoodWareHouse").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
        return;
    }

    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        $.ajax({
            type: 'post',
            url: $("#btnDeleteFoodWareHouse").attr('post-url'),
            data: {_token: csrf, rowID : dataRow['id']},
            success:function(response){
              if(response.status == 'success'){
                alertify.alert(response.msg);
                populationTableRefresh();
                dataRow = "";
              }
              else{
                alertify.error( response.msg);
              }

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
