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

  var supportOrg = "";
  $(".supportOrgs").each(function(){
    if($(this).prop("checked"))
      supportOrg = supportOrg + $(this).val() + ';';
  });

  $.ajax({
    type:'post',
    url: axaxNew,
    data:{
      _token: $('meta[name="csrf-token"]').attr('content'),
      fields: JSON.parse(JSON.stringify($("#frmAxaxNew").serializeArray())),
      orgs: supportOrg
    },
    success:function(response){
        alertify.alert( response);
        $("#modalAxaxNew").modal("hide");
        // $("#axaxDB").row.add([])
        AxaxTableRefresh();
        // emptyForm();
        // dataRow = "";
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

function AxaxTableRefresh()
{

}
