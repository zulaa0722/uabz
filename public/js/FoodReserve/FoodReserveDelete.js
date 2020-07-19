$(document).ready(function(){
  $("#btnFoodReserveDelete").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
        return;
    }

    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        //console.log(dataRow);
        // $.ajax({
        //     type: 'post',
        //     url: foodReserveDeleteUrl,
        //     data: {
        //       _token: csrf,
        //       symID : dataRow[2],
        //       provID: dataRow[1]
        //     }
        //     success:function(response){
        //         alertify.alert(response);
        //
        //
        //         // FoodReserveTableRefresh();
        //         dataRow = "";
        //     },
        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
        //         alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
        //     }
        // });
      } else {
          alertify.error('Устгах үйлдэл цуцлагдлаа.');
      }
    });

  });

});
function FoodReserveTableRefresh()
{

}
