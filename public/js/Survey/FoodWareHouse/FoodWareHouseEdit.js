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

    $("#efirmName").val(dataRow['firmName']);
    $("#estartDate").val(dataRow['startDate']);
    $("#ecapacity").val(dataRow['capacity']);
    $("#estate").val(dataRow['state']);
    $("#eresName").val(dataRow['resName']);
    $("#econtact").val(dataRow['contact']);


    $("#modalFoodWareHouseEdit").modal("show");
  });

  $("#btnFoodWareHouseUpdate").click(function(e){
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

  if($("#efirmName").val()==""){
    alertify.error("Та заавал АЖ АХУЙН НЭГЖИЙН НЭРЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#estartDate").val()==""){
    alertify.error("Та заавал АШИГЛАЛТАНД ОРСОН ӨДРӨӨ оруулна уу!!!");
    isInsert = false;
  }
  if($("#ecapacity").val()==""){
    alertify.error("Та заавал ХҮЧИН ЧАДАЛ оруулна уу!!!");
    isInsert = false;
  }
  if($("#estate").val()==""){
    alertify.error("Та заавал ТӨЛӨВ оруулна уу!!!");
    isInsert = false;
  }
  if($("#eresName").val()==""){
    alertify.error("Та заавал ХАРИУЦАХ ХҮНИЙ НЭР оруулна уу!!!");
    isInsert = false;
  }
  if($("#econtact").val()==""){
    alertify.error("Та заавал ХОЛБОО БАРИХ УТАС оруулна уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
      type: 'post',
      url: $("#btnFoodWareHouseUpdate").attr('post-url'),
      data:$("#frmFoodWareHouseEdit").serialize(),
      success:function(response){
        if(response.status == 'success'){
          alertify.alert(response.msg);
          populationTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalDrinkingWaterEdit").modal("hide");
        }
        else{
          alertify.error( response.msg);
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
          alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
      }
  })
}
