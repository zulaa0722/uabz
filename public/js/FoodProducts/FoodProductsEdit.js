$(document).ready(function(){

  $("#btnEditModalOpen").click(function(e){

    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }


    $("#rowID").val(dataRow['id']);
    $("#eproductName").val(dataRow['productName']);
    $("#efoodQntt").val(dataRow['foodQntt']);
    $("#efoodProtein").val(dataRow['foodProtein']);
    $("#efoodFat").val(dataRow['foodFat']);
    $("#efoodCarbon").val(dataRow['foodCarbon']);
    $("#efoodCkal").val(dataRow['foodCkal']);
    $("#efoodTomCkal").val(dataRow['foodTomCkal']);

    $("#modalFoodProductsEdit").modal("show");

  });

  var uurag = 0;
  var nuursus = 0;
  var tos = 0;

  $("#efoodFat").keyup(function(){
    if($("#efoodFat").val() != "")
    tos = $("#efoodFat").val() * 9;
    else
    tos = 0;
    $("#efoodTomCkal").val(uurag + nuursus + tos);
  });
  $("#efoodCarbon").keyup(function(){
    if($("#efoodCarbon").val() != "")
    nuursus = $("#efoodCarbon").val() * 4;
    else
    nuursus = 0;
    $("#efoodTomCkal").val(uurag + nuursus + tos);
  });
  $("#efoodProtein").keyup(function(){
    if($("#efoodProtein").val() != "")
      uurag = $("#efoodProtein").val() * 4;
    else
      uurag = 0;
    $("#efoodTomCkal").val(uurag + nuursus + tos);
  });

  $("#btnFoodProductsUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  var isInsert = true;
  if($("#eproductName").val()==""){
    alertify.error("Та заавал ХҮНСНИЙ БҮТЭЭГДЭХҮҮН оруулана уу!!!");
    isInsert = false;
  }
  if($("#efoodQntt").val()==""){
    alertify.error("Та заавал ХЭМЖЭЭ оруулана уу!!!");
    isInsert = false;
  }
  // if($("#efoodProtein").val()==""){
  //   alertify.error("Та заавал УУРАГ оруулана уу!!!");
  //   isInsert = false;
  // }
  //
  // if($("#efoodFat").val()==""){
  //   alertify.error("Та заавал ТОС оруулана уу!!!");
  //   isInsert = false;
  // }
  //
  // if($("#efoodCarbon").val()==""){
  //   alertify.error("Та заавал НҮҮРС УС оруулана уу!!!");
  //   isInsert = false;
  // }

  if($("#efoodCkal").val()==""){
    alertify.error("Та заавал ККАЛ оруулана уу!!!");
    isInsert = false;
  }
  if(isInsert == false){return;}

  $.ajax({
      type: 'post',
      url: foodProductsEditUrl,
      data:$("#frmFoodProductsEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          FoodProductsTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalFoodProductsEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
