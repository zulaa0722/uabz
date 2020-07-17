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

        $.each(response, function (value, index ) {
           var o = new Option(index['symName'], index['id']);  // Option(name, val)
           $("#ecmbSymNew").append(o);
        });
        $("#ecmbSymNew").val(dataRow['symID']);
      }
    });

    $("#rowID").val(dataRow['id']);
    $("#eprovName").val(dataRow['provID']);

    $("#elocation").val(dataRow['location']);
    $("#ewellName").val(dataRow['wellName']);
    $("#ecapacity").val(dataRow['capacity']);
    $("#estate").val(dataRow['state']);
    $("#eresName").val(dataRow['resName']);
    $("#econtact").val(dataRow['contact']);


    $("#modalDrinkingWaterEdit").modal("show");
  });

  $("#btnDrinkingWaterdate").click(function(){
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

  if($("#elocation").val()==""){
    alertify.error("Та заавал БАЙРШИЛ оруулана уу!!!");
    isInsert = false;
  }
  if($("#ewellName").val()==""){
    alertify.error("Та заавал ХУДГИЙН НЭР оруулана уу!!!");
    isInsert = false;
  }
  if($("#ecapacity").val()==""){
    alertify.error("Та заавал ХҮЧИН ЧАДАЛ оруулана уу!!!");
    isInsert = false;
  }
  if($("#estate").val()==""){
    alertify.error("Та заавал ТӨЛӨВ оруулана уу!!!");
    isInsert = false;
  }
  if($("#eresName").val()==""){
    alertify.error("Та заавал ХАРИУЦАХ ХҮНИЙ НЭР оруулана уу!!!");
    isInsert = false;
  }
  if($("#econtact").val()==""){
    alertify.error("Та заавал ХОЛБОО БАРИХ УТАС оруулана уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
      type: 'post',
      url: drinkingWaterEditUrl,
      data:$("#frmDrinkingWaterEdit").serialize(),
      success:function(response){
          alertify.alert(response);
          populationTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalDrinkingWaterEdit").modal("hide");

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
