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

    $("#edpstName").val(dataRow['dpstName']);
    $("#edpstReserve").val(dataRow['dpstReserve']);
    $("#edpstState").val(dataRow['dpstState']);
    $("#edistance").val(dataRow['distance']);
    $("#eresName").val(dataRow['resName']);
    $("#econtact").val(dataRow['contact']);


    $("#modalSaltDepositEdit").modal("show");
  });

  $("#btnSaltDepositUpdate").click(function(e){
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

  if($("#edpstName").val()==""){
    alertify.error("Та заавал ОРДЫН НЭРЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#edpstReserve").val()==""){
    alertify.error("Та заавал ОРДЫН НӨӨЦӨӨ оруулна уу!!!");
    isInsert = false;
  }
  if($("#edpstState").val()==""){
    alertify.error("Та заавал ОРДЫН ТӨЛӨВӨӨ оруулна уу!!!");
    isInsert = false;
  }
  if($("#edistance").val()==""){
    alertify.error("Та заавал АЙМГИЙН ТӨВ ХҮРТЭЛХ КМ-ЭЭ оруулна уу!!!");
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
      url: $("#btnSaltDepositUpdate").attr('post-url'),
      data:$("#frmSaltDepositEdit").serialize(),
      success:function(response){
        if(response.status == 'success'){
          alertify.alert(response.msg);
          populationTableRefresh();
          emptyForm();
          dataRow = "";
          $("#modalFoodFactoryEdit").modal("hide");
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
