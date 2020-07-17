$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#eprovID").val(dataRow['provID']);
    $("#esymID").val(dataRow['symID']);
    $("#ecattleID").val(dataRow['cattleID']);
    $("#ecattleQntt").val(dataRow['cattQntt']);


    $("#modalCattleQnttEdit").modal("show");
  });

  $("#btnCattleQnttUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  if($("#eprovID").val() == "-1")
  {
    alertify.error('АЙМГИЙН НЭР сонгоно уу!!!');
    return;
  }
  if($("#esymID").val() == "-1")
  {
    alertify.error('СУМЫН НЭР сонгоно уу!!!');
    return;
  }

  if($("#ecattleID").val() == "-1")
  {
    alertify.error('МАЛЫН МАХНЫ ТӨРӨЛ сонгоно уу!!!');
    return;
  }

  $.ajax({
      type: 'post',
      url: cattleQnttEditUrl,
      data:$("#frmCattleQnttEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          cattleQnttTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalCattleQnttEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
