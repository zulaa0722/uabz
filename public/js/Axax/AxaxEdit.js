$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    // alert(dataRow['id']);
    $("#rowID").val(dataRow['id']);
    $("#eaxaxTypeID").val(dataRow['axaxTypeID']);
    $("#eaxaxName").val(dataRow['axaxName']);
    $("#einTime").val(dataRow['inTime']);
    $("#elevelID").val(dataRow['levelID']);
    $("#estatusID").val(dataRow['statusID']);
    $("#emainOrgID").val(dataRow['mainOrgID']);

    var supportOrgs = dataRow['supportName'].split(';');

    $(".esupportOrgs").prop("checked", false);
    $(".esupportOrgs").each(function(){
      for(var i=0; i<supportOrgs.length; i++){
        if(supportOrgs[i] !== "")
        {
          if($(this).val() === supportOrgs[i])
            $(this).prop("checked", true);
        }
      }
    });

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

  var supportOrg = "";
  $(".esupportOrgs").each(function(){
    if($(this).prop("checked"))
      supportOrg = supportOrg + $(this).val() + ';';
  });

  console.log(supportOrg);

  $.ajax({
      type: 'post',
      url: axaxEditUrl,
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        fields: JSON.parse(JSON.stringify($("#frmAxaxEdit").serializeArray())),
        supportOrgs: supportOrg
      },
      success:function(response){
        console.log(response);
          // alertify.alert(response);
          // AxaxTableRefresh();
          // emptyForm();
          dataRow = "";
          $("#modalAxaxEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
