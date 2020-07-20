$(document).ready(function(){
  $("#btnFoodReserveDelete").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
        return;
    }

    alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
      if (e) {
        $.ajax({
          type:'post',
          url:foodReserveDeleteUrl,
          data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            provID: dataRow[1],
            symID: dataRow[2]
          },
          success:function(response){
              if(response.status == 'success'){

                var table = $("#FoodReserveTable").DataTable();

                //songogdson moriin nudnii utgiig oorchilj bn
                table.rows({ selected: true })
                .every(function (rowIdx, tableLoop, rowLoop){
                  for(var i=0; i<table.columns().count(); i++)
                    table.cell(rowIdx, i+5).data(" ");
                    // console.log(i);
                }).draw();

                $("#modalFoodReserveNew").modal("hide");
                alertify.alert(response.msg);
              }
              else{
                alertify.error(response.msg);
              }

          },
        });
      } else {
          alertify.error('Устгах үйлдэл цуцлагдлаа.');
      }
    });
  });
});
