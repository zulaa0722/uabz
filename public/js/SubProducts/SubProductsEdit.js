$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#efProductID").val(dataRow['fProductID']);
    $("#esubName").val(dataRow['subName']);
    $("#emultiplier").val(dataRow['multiplier']);
    $("#eprice").val(dataRow['price']);

    $("#modalSubProductsEdit").modal("show");
  });

  $("#btnSubProductsUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  var isInsert = true;
  if($("#efProductID").val()=="-1"){
    alertify.error("Та заавал ХҮНСНИЙ БҮТЭЭГДЭХҮҮН сонгоно уу!!!");
    isInsert = false;
  }
  if($("#esubName").val()==""){
    alertify.error("Та заавал ОРЛОХ БҮТЭЭГДЭХҮҮН оруулана уу!!!");
    isInsert = false;
  }
  if($("#emultiplier").val()==""){
    alertify.error("Та заавал ИТГЭЛЦҮҮР оруулана уу!!!");
    isInsert = false;
  }
  if(isInsert == false){return;}

  $.ajax({
      type: 'post',
      url: subProductsEditUrl,
      data:$("#frmSubProductsEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          subProductsTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalSubProductsEdit").modal("hide");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
