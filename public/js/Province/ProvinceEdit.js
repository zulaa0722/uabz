$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#esectorName").val(dataRow['sectorID']);
    $("#eprovName").val(dataRow['provName']);
    $("#eprovCode").val(dataRow['provCode']);

    $("#modalProvinceEdit").modal("show");
  });

  $("#btnProvinceUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  var isInsert = true;
  if($("#esectorName").val() == "-1")
  {
    alertify.error('БҮСИЙН НЭР сонгоно уу!!!');
    return;
  }
  if($("#eprovName").val() == "")
  {
    alertify.error('АЙМГИЙН НЭР хоосон байна.!!!');
    return;
  }
  if($("#eprovCode").val() == "")
  {
    alertify.error('АЙМГИЙН КОД хоосон байна.!!!');
    return;
  }
  if(isInsert == false){return;}
  $.ajax({
      type: 'post',
      url: provinceEditUrl,
      data:$("#frmProvinceEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          provinceTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalProvinceEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
