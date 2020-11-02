$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalSaltDepositNew").modal("show");
    });


    $("#btnSaltDepositAdd").click(function(e){
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

  if($("#dpstName").val()==""){
    alertify.error("Та заавал ОРДЫН НЭРЭЭ оруулна уу!!!");
    isInsert = false;
  }
  if($("#dpstReserve").val()==""){
    alertify.error("Та заавал ОРДЫН НӨӨЦӨӨ оруулна уу!!!");
    isInsert = false;
  }
  if($("#dpstState").val()==""){
    alertify.error("Та заавал ОРДЫН ТӨЛӨВӨӨ оруулана уу!!!");
    isInsert = false;
  }
  if($("#distance").val()==""){
    alertify.error("Та заавал АЙМГИЙН ТӨВ ХҮРТЭЛХ КМ-ЭЭ оруулана уу!!!");
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
    url:$("#btnSaltDepositAdd").attr('post-url'),
    data:$("#frmSaltDepositNew").serialize(),
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
  $("#dpstName").val("");
  $("#dpstReserve").val("");
  $("#dpstState").val("");
  $("#distance").val("");
  $("#resName").val("");
  $("#contact").val("");

}

function populationTableRefresh()
{
  $('#tableSaltDeposit').DataTable().destroy();
  var table = $('#tableSaltDeposit').DataTable({
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
                 "url": $("#tableSaltDeposit").attr('post-url'),
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
        { data: "dpstName", name: "dpstName"},
        { data: "dpstReserve", name: "dpstReserve"},
        { data: "dpstState", name: "dpstState"},
        { data: "distance", name: "distance"},
        { data: "resName", name: "resName"},
        { data: "contact", name: "contact"},
        { data: "provID", name: "provID", visible:false},
        { data: "symID", name: "symID", visible:false}
          ]
      }).ajax.reload();
}
