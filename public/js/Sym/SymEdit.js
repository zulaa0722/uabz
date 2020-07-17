$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#eprovName").val(dataRow['provID']);
    $("#esymName").val(dataRow['symName']);
    $("#esymCode").val(dataRow['symCode']);

    $("#modalSymEdit").modal("show");
  });

  $("#btnSymUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  if($("#eprovName").val() == "-1")
  {
    alertify.error('АЙМГИЙН НЭР сонгоно уу!!!');
    return;
  }
  if($("#esymName").val() == "")
  {
    alertify.error('СУМЫН НЭР хоосон байна.!!!');
    return;
  }
  if($("#esymCode").val() == "")
  {
    alertify.error('СУМЫН КОД хоосон байна.!!!');
    return;
  }
  $.ajax({
      type: 'post',
      url: symEditUrl,
      data:$("#frmSymEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          symTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalSymEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
