$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalFoodFactoryNew").modal("show");
    });


    $("#btnFoodFactoryAdd").click(function(e){
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

  if($("#name").val()==""){
    alertify.error("Та заавал ХҮНСНИЙ ҮЙЛДВЭРИЙН НЭРЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#activity").val()==""){
    alertify.error("Та заавал ҮЙЛ АЖИЛЛАГААНЫ ЧИГЛЭЛЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#capacity").val()==""){
    alertify.error("Та заавал ҮЙЛДВЭРИЙН СУУРИЛАГДСАН ХҮЧИН ЧАДАЛ оруулана уу!!!");
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
    url:$("#btnFoodFactoryAdd").attr('post-url'),
    data:$("#frmFoodFactoryNew").serialize(),
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
  $("#name").val("");
  $("#activity").val("");
  $("#capacity").val("");
  $("#resName").val("");
  $("#contact").val("");

}

function populationTableRefresh()
{
  $('#tableFoodFactory').DataTable().destroy();
  var table = $('#tableFoodFactory').DataTable({
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
                 "url": $("#tableFoodFactory").attr('post-url'),
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
          { data: "name", name: "name"},
          { data: "activity", name: "activity"},
          { data: "factoryCapacity", name: "factoryCapacity"},
          { data: "resName", name: "resName"},
          { data: "contact", name: "contact"},
          { data: "provID", name: "provID", visible:false},
          { data: "symID", name: "symID", visible:false}
          ]
      }).ajax.reload();
}
