$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalFoodWareHouseNew").modal("show");
    });


    $("#btnFoodWareHouseAdd").click(function(e){
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

  if($("#firmName").val()==""){
    alertify.error("Та заавал АЖ АХУЙН НЭГЖИЙН НЭРЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#startDate").val()==""){
    alertify.error("Та заавал АШИГЛАЛТАНД ОРСОН ӨДРӨӨ оруулна уу!!!");
    isInsert = false;
  }
  if($("#capacity").val()==""){
    alertify.error("Та заавал БАГТААМЖ ХҮЧИН ЧАДАЛ оруулана уу!!!");
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
    url:$("#btnFoodWareHouseAdd").attr('post-url'),
    data:$("#frmFoodWareHouseNew").serialize(),
    success:function(response){
        if(response.status == 'success'){
          alertify.alert( response.msg);
          populationTableRefresh();
          emptyForm();
          dataRow = "";
        }
        else{
          alertify.error( response.msg);
        }
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
  $("#firmName").val("");
  $("#startDate").val("");
  $("#capacity").val("");
  $("#state").val("");
  $("#resName").val("");
  $("#contact").val("");

}

function populationTableRefresh()
{
  $('#tableFoodWareHouse').DataTable().destroy();
  var table = $('#tableFoodWareHouse').DataTable({
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
                 "url": $("#tableFoodWareHouse").attr('post-url'),
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
          { data: "firmName", name: "firmName"},
          { data: "startDate", name: "startDate"},
          { data: "capacity", name: "capacity"},
          { data: "state", name: "state"},
          { data: "resName", name: "resName"},
          { data: "contact", name: "contact"},
          { data: "provID", name: "provID", visible:false},
          { data: "symID", name: "symID", visible:false}
          ]
      }).ajax.reload();
}
