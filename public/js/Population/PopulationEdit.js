$(document).ready(function(){
  $("#btnEditModalOpen").click(function(e){
    e.preventDefault();

    if(dataRow == ""){
        alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
        return;
    }

    $("#esymName option[value!='-1']").each(function(){
      $(this).remove();
    })
    $.ajax({
      type: "post",
      url: $("#eprovName").attr("getSymUrl"),
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: dataRow['provID']
      },
      success:function(response){
        $.each(response, function (value, index ) {
           var o = new Option(index['symName'], index['id']);  // Option(name, val)
           $("#esymName").append(o);
        });
        $("#esymName").val(dataRow['symID']);
      }
    });

    $("#rowID").val(dataRow['id']);
    $("#eprovName").val(dataRow['provID']);

    $("#etotalPop").val(dataRow['totalPop']);
    $("#estandardPop").val(dataRow['standardPop']);

    $("#modalPopulationEdit").modal("show");
  });

  $("#eprovName").change(function(){
    // alert($("#provName").attr("getSymUrl"));
    $("#esymName option[value!='-1']").each(function(){
      $(this).remove();
    })
    $.ajax({
      type: "post",
      url: $("#eprovName").attr("getSymUrl"),
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: $("#eprovName").val()
      },
      success:function(response){

        $.each(response, function (value, index ) {
           var o = new Option(index['symName'], index['id']);  // Option(name, val)
           $("#ecmbSymNew").append(o);
        });
      }
    });
  });

  $("#btnPopulationUpdate").click(function(){
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
  if($("#esymName").val() == "-1")
  {
    alertify.error('СУМЫН НЭР сонгоно уу!!!');
    return;
  }

  if($("#estandardPop").val() == "")
  {
    alertify.error('Жишсэн хүн амын тоог оруулана уу!!!');
    return;
  }

  $.ajax({
      type: 'post',
      url: populationEditUrl,
      data:$("#frmPopulationEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          populationTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalPopulationEdit").modal("hide");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
