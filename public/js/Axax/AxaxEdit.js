$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#rowID").val(dataRow['id']);
    $("#eaxaxName").val(dataRow['axaxName']);
    $("#einTime").val(dataRow['inTime']);
    $("#elevelID").val(dataRow['levelID']);
    $("#emainOrgID").val(dataRow['mainOrgID']);
    $("#esupportOrgID").val(dataRow['supportOrgID']);


    $("#modalAxaxEdit").modal("show");
  });

  $("#btnAxaxUpdate").click(function(e){
    e.preventDefault();
    editCode();
  });

});

function editCode()
{
  if($("#eaxaxName").val()==""){
    alertify.error("Та заавал АВЧ ХЭРЭГЖҮҮЛЭХ АРГА ХЭМЖЭЭНИЙ УТГА оруулана уу!!!");
    return;
  }
  if($("#elevelID").val()=="-1"){
    alertify.error("Та заавал ЗЭРЭГ сонгоно уу!!!");
    return;
  }
  if($("#einTime").val()==""){
    alertify.error("Та заавал Ц (Шийдвэр гарсан хугацаа) оруулана уу!!!");
    return;
  }

  if($("#emainOrgID").val()=="-1"){
    alertify.error("Та заавал УДИРДАН ЗОХИОН БАЙГУУЛАХ БАЙГУУЛЛАГА сонгоно уу!!!");
    return;
  }

  if($("#esupportOrgID").val()=="-1"){
    alertify.error("Та заавал ДЭМЖЛЭГ ҮЗҮҮЛЭХ БАЙГУУЛЛАГА сонгоно уу!!!");
    return;
  }

  $.ajax({
      type: 'post',
      url: axaxEditUrl,
      data:$("#frmAxaxEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          AxaxTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalAxaxEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
