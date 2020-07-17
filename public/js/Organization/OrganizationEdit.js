$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#eabbrName").val(dataRow['abbrName']);
    $("#efullName").val(dataRow['fullName']);

    $("#modalOrgEdit").modal("show");
  });

  $("#btnOrgUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });


});

function editCode()
{
  if($("#eabbrName").val() == "")
  {
    alertify.error('ТОВЧИЛСОН НЭР оруулана уу!!!');
    return;
  }
  if($("#efullName").val() == "")
  {
    alertify.error('ТАЙЛБАР НЭР хоосон байна.!!!');
    return;
  }
  $.ajax({
      type: 'post',
      url: orgEditUrl,
      data:$("#frmOrgEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          orgTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalOrgEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
