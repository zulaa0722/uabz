$(document).ready(function(){
  $("#btnSectorEdit").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }
    $("#ecattleName").val(dataRow['cattleName']);
    $("#modalCattleEdit").modal("show");
  });

  $("#btnCattleUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  if($("#ecattleName").val() == "")
  {
    alertify.error('МАЛЫН МАХНЫ ТӨРӨЛ хоосон байна.!!!');
    return;
  }
  $.ajax({
      type: 'post',
      url: cattleEditUrl,
      data: {_token: csrf, rowID : dataRow['id'],  cattleName: $("#ecattleName").val() },
      success:function(response){
          alertify.alert(response);
          cattleTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalCattleEdit").modal("hide");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
