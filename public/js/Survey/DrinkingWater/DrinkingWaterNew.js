$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalDrinkingWaterNew").modal("show");
    });


    $("#btnDrinkingWaterAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isInsert = true;

  if($("#provName").val()=="-1"){
    alertify.error("Та заавал АЙМГИЙН НЭР сонгоно уу!!!");
    isInsert = false;
  }
  if($("#symName").val()=="-1"){
    alertify.error("Та заавал СУМЫН НЭР сонгоно уу!!!");
    isInsert = false;
  }

  if($("#location").val()==""){
    alertify.error("Та заавал БАЙРШИЛ оруулана уу!!!");
    isInsert = false;
  }
  if($("#wellName").val()==""){
    alertify.error("Та заавал ХУДГИЙН НЭР оруулана уу!!!");
    isInsert = false;
  }
  if($("#capacity").val()==""){
    alertify.error("Та заавал ХҮЧИН ЧАДАЛ оруулана уу!!!");
    isInsert = false;
  }
  if($("#state").val()==""){
    alertify.error("Та заавал ТӨЛӨВ оруулана уу!!!");
    isInsert = false;
  }
  if($("#resName").val()==""){
    alertify.error("Та заавал ХАРИУЦАХ ХҮНИЙ НЭР оруулана уу!!!");
    isInsert = false;
  }
  if($("#contact").val()==""){
    alertify.error("Та заавал ХОЛБОО БАРИХ УТАС оруулана уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:drinkingWaterNew,
    data:$("#frmDrinkingWaterNew").serialize(),
    success:function(response){
        alertify.alert( response);
        populationTableRefresh();
        emptyForm();
        dataRow = "";
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
  $("#provName").val("-1");
  $("#cmbSymNew").val("-1");
  $("#location").val("");
  $("#wellName").val("");
  $("#capacity").val("");
  $("#state").val("");
  $("#resName").val("");
  $("#contact").val("");

}
function populationTableRefresh()
{
  $('#drinkingWaterSource').DataTable().destroy();
  var table = $('#drinkingWaterSource').DataTable({
    "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Хайлт илэрцгүй байна",
            "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
            "infoEmpty": "Хайлт илэрцгүй",
            "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
            "sSearch": "Хайх: ",
            "paginate": {
              "previous": "Өмнөх",
              "next": "Дараахи"
            },
            "select": {
                rows: ""
            }
        },
        select: {
          style: 'single'
      },
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "ajax":{
                 "url": getDrinkingWater,
                 "dataType": "json",
                 "type": "post",
                 "data":{
                      _token: csrf
                    }
               },
        "columns": [
          { data: "id", name: "id",  render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }  },
          { data: "provName", name: "provName"},
          { data: "symName", name: "symName"},
          { data: "location", name: "location"},
          { data: "wellName", name: "wellName"},
          { data: "capacity", name: "capacity"},
          { data: "state", name: "state"},
          { data: "resName", name: "resName"},
          { data: "contact", name: "contact"},
          { data: "provID", name: "provID", visible:false},
          { data: "symID", name: "symID", visible:false}
          ]
      }).ajax.reload();
}
