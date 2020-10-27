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

    $("#ename").val(dataRow['name']);
    $("#eactivity").val(dataRow['activity']);
    $("#ecapacity").val(dataRow['factoryCapacity']);
    $("#eresName").val(dataRow['resName']);
    $("#econtact").val(dataRow['contact']);


    $("#modalFoodFactoryEdit").modal("show");
  });

  $("#btnFoodFactoryUpdate").click(function(e){
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

  if($("#ename").val()==""){
    alertify.error("Та заавал ХҮНСНИЙ ҮЙЛДВЭРИЙН НЭРЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#eactivity").val()==""){
    alertify.error("Та заавал ҮЙЛ АЖИЛЛАГААНЫ ЧИГЛЭЛЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#ecapacity").val()==""){
    alertify.error("Та заавал ҮЙЛДВЭРИЙН СУУРИЛАГДСАН ХҮЧИН ЧАДАЛ оруулна уу!!!");
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
      url: $("#btnFoodFactoryUpdate").attr('post-url'),
      data:$("#frmFoodFactoryEdit").serialize(),
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
