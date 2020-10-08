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

    var supportOrgs = dataRow['supportOrg'].split(';');

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

    editCode();//
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
  var supportOrgNames = "";
  $(".esupportOrgs").each(function(){
    if($(this).prop("checked"))
    {
      supportOrg = supportOrg + $(this).val() + ';';
      supportOrgNames = supportOrgNames + $(this).attr('name') + ', ';
    }
  });

  $.ajax({
      type: 'post',
      url: axaxEditUrl,
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        fields: JSON.parse(JSON.stringify($("#frmAxaxEdit").serializeArray())),
        supportOrgs: supportOrg,
        supportOrgNames: supportOrgNames
      },
      success:function(response){
        //console.log(response);
        alertify.alert(response);
        $("#modalAxaxEdit").modal("hide");
        AxaxTableRefreshEdit(supportOrg, supportOrgNames);
        dataRow = "";

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
function AxaxTableRefreshEdit(supportOrg, supportOrgNames)
{
  var elementText = $("#eaxaxTypeID option:selected").text();
  var element = $("#eaxaxTypeID").find('option:selected');
  var myTag = element.attr("eaxaxCount");
  if(dataRow["number"].substr(0,4) !== elementText.substr(0,4))
    myTag++;
  element.attr("axaxcount", myTag);

  table.rows({ selected: true })
  .every(function (rowIdx, tableLoop, rowLoop){
      table.cell(rowIdx, 0).data($("#elevelID").val());
      table.cell(rowIdx, 1).data($("#estatusID").val());
      table.cell(rowIdx, 2).data($("#emainOrgID").val());
      table.cell(rowIdx, 3).data($("#eaxaxTypeID").val());
      table.cell(rowIdx, 4).data(supportOrg);
      // table.cell(rowIdx, 5).data("");
      if(myTag <10)
        myTag = '0'+myTag;
      table.cell(rowIdx, 6).data(elementText.substr(0,4)+''+myTag);
      table.cell(rowIdx, 7).data($("#eaxaxName").val());
      table.cell(rowIdx, 8).data($("#elevelID option:selected").text());
      table.cell(rowIdx, 9).data($("#einTime").val());
      table.cell(rowIdx, 10).data($("#estatusID option:selected").text());
      table.cell(rowIdx, 11).data($("#emainOrgID option:selected").text());
      table.cell(rowIdx, 12).data(supportOrgNames);
  }).draw();
}
