$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#estatusName").val(dataRow['statusName']);

    $("#modalStatusEdit").modal("show");

  });

  $("#btnStatusUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  var isInsert = true;
  if($("#estatusName").val()=="-1"){
    alertify.error("Та заавал ТӨЛӨВИЙН НЭР оруулана уу!!!");
    isInsert = false;
  }
  if(isInsert == false){return;}

  $.ajax({
      type: 'post',
      url: statusEditUrl,
      data:$("#frmStatusEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          statusTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalStatusEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
