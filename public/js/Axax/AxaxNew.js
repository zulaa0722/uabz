$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalAxaxNew").modal("show");
    });


  $("#btnAxaxAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{

  var isInsert = true;

  if($("#axaxName").val()==""){
    alertify.error("Та заавал АВЧ ХЭРЭГЖҮҮЛЭХ АРГА ХЭМЖЭЭНИЙ УТГА оруулана уу!!!");
    isInsert = false;
  }
  if($("#axaxTypeID").val()=="-1"){
    alertify.error("Та заавал хэрэгжүүлэх арга хэмжээний чиглэл сонгоно уу!!!");
    isInsert = false;
  }
  if($("#levelID").val()=="-1"){
    alertify.error("Та заавал ЗЭРЭГ сонгоно уу!!!");
    isInsert = false;
  }

  if($("#mainOrgID").val()=="-1"){
    alertify.error("Та заавал УДИРДАН ЗОХИОН БАЙГУУЛАХ БАЙГУУЛЛАГА сонгоно уу!!!");
    isInsert = false;
  }

  if($("#supportOrgID").val()=="-1"){
    alertify.error("Та заавал ДЭМЖЛЭГ ҮЗҮҮЛЭХ БАЙГУУЛЛАГА сонгоно уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  var supportOrgIDS = "";
  var supportOrgNames = "";
  $(".supportOrgs").each(function(){
    if($(this).prop("checked"))
    {
      supportOrgIDS = supportOrgIDS + $(this).val() + ';';
      supportOrgNames = supportOrgNames + $(this).attr('name') + ', ';
    }
  });

  $.ajax({
    type:'post',
    url: axaxNew,
    data:{
      _token: $('meta[name="csrf-token"]').attr('content'),
      fields: JSON.parse(JSON.stringify($("#frmAxaxNew").serializeArray())),
      supportOrgIDS: supportOrgIDS,
      orgNames: supportOrgNames
    },
    success:function(response){
        if(response.status == "error"){
            alertify.error(response.msg);
        }
        else{
            AxaxTableRefresh(response.id, supportOrgNames, supportOrgIDS);
            alertify.alert(response.msg);
        }
        $("#modalAxaxNew").modal("hide");

    },
    error: function(jqXhr, json, errorThrown){// this are default for ajax errors
      var errors = jqXhr.responseJSON;
      var errorsHtml = '';
      $.each(errors['errors'], function (index, value) {
          errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
      });
      alert(errorsHtml);
    }
  });
}
function emptyForm()
{
  $("#axaxName").val("");
  $("#levelID").val("-1");
  $("#inTime").val("");
  $("#statusID").val("-1");
  $("#mainOrgID").val("-1");
  $("#supportOrgID").val("-1");
}

function AxaxTableRefresh(id, supportOrgNames, supportOrgIDS)
{

  var elementText = $("#axaxTypeID option:selected").text();


  var element = $("#axaxTypeID").find('option:selected');
  var myTag = element.attr("axaxcount");
  myTag++;
  element.attr("axaxcount", myTag);
  // alert(myTag);

  table.row.add( {
      "levelID": $("#levelID").val(),
      "statusID": $("#statusID").val(),
      "mainOrgID": $("#mainOrgID").val(),
      "axaxTypeID": $("#axaxTypeID").val(),
      "supportOrg": supportOrgIDS,
      "id": id,
      "number": elementText.substr(0,4)+'' + myTag,
      "axaxName": $("#axaxName").val(),
      "levelName": $("#levelID option:selected").text(),
      "inTime": $("#inTime").val(),
      "statusName": $("#statusID option:selected").text(),
      "mainName": $("#mainOrgID option:selected").text(),
      "supportName": supportOrgNames
  } ).draw();

}
