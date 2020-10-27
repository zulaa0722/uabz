$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();
    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $.ajax({
      type: "post",
      url: $("#eprovName").attr("getSymUrl"),
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: dataRow['provID']
      },
      success:function(response){
        $("#ecmbSymNew").html("");
        $.each(response, function (value, index ) {
           var o = new Option(index['symName'], index['id']);  // Option(name, val)
           $("#ecmbSymNew").append(o);
        });
        $("#ecmbSymNew").val(dataRow['symID']);
      }
    });

    $("#rowID").val(dataRow['id']);
    $("#eprovName").val(dataRow['provID']);
    $("#ecmbSymNew").val(dataRow['symID']);
    $("#efirmName").val(dataRow['firmName']);
    $("#estartDate").val(dataRow['startDate']);
    $("#ecapacity").val(dataRow['capacity']);
    $("#estate").val(dataRow['state']);
    $("#eresName").val(dataRow['resName']);
    $("#econtact").val(dataRow['contact']);


    $("#modalGrainWarehouseEdit").modal("show");
  });

  $("#btnGrainWarehouseUpdate").click(function(e){
      e.preventDefault();
      editCode();
  });

});

function editCode()
{
  var isInsert = true;

  if($("#eprovName").val()=="-1"){
    alertify.error("Та заавал АЙМГИЙН НЭР сонгоно уу!!!");
    isInsert = false;
  }
  if($("#esymName").val()=="-1"){
    alertify.error("Та заавал СУМЫН НЭР сонгоно уу!!!");
    isInsert = false;
  }

  if($("#ecapacity").val()==""){
    alertify.error("Та заавал ХҮЧИН ЧАДАЛ оруулана уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
      type: 'post',
      url: grainWarehouseEdit,
      data:$("#frmGrainWarehouseEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          grainWarehouseTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalGrainWarehouseEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
