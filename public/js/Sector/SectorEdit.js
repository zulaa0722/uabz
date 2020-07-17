$(document).ready(function(){
  $("#btnSectorEdit").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }
    $("#esectorName").val(dataRow['sectorName']);
    $("#esectorCode").val(dataRow['sectorCode']);
    $("#modalSectorEdit").modal("show");
  });

  $("#btnSectoreUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  if($("#esectorName").val() == "")
  {
    alertify.error('Бүсийн НЭР хоосон байна.!!!');
    return;
  }
  if($("#esectorCode").val() == "")
  {
    alertify.error('Бүсийн КОД хоосон байна.!!!');
    return;
  }
  $.ajax({
      type: 'post',
      url: sectorEditUrl,
      data: {
        _token: csrf, rowID : dataRow['id'],
         sectorName: $("#esectorName").val(),
         sectorCode: $("#esectorCode").val()
        },
      success:function(response){
          alertify.alert(response);
          sectorTableRefresh();
          dataRow = "";
          $("#modalSectorEdit").modal("hide");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
