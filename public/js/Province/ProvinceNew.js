$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalProvinceNew").modal("show");
    });

    $("#btnProvinceAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });
});

function mainCode()
{
  var isInsert = true;

  if($("#sectorName").val()=="-1"){
    alertify.error("Та заавал БҮСИЙН НЭР сонгоно уу!!!");
    isInsert = false;
  }
  if($("#provName").val()==""){
    alertify.error("Та заавал АЙМГИЙН НЭР бичнэ үү!!!");
    isInsert = false;
  }
  if($("#provCode").val()==""){
    alertify.error("Та заавал АЙМГИЙН КОД бичнэ үү!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:provinceNew,
    data:$("#frmProvinceNew").serialize(),
    success:function(response){
        alertify.alert( response);
        provinceTableRefresh();
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
  $("#sectorName").val("-1");
  $("#provName").val("");
  $("#provCode").val("0");
}
function provinceTableRefresh()
{
  $('#provinceDB').DataTable().destroy();
  var table = $('#provinceDB').DataTable({
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
                 "url": getProvince,
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
          { data: "sectorName", name: "sectorName"},
          { data: "provName", name: "provName"},
          { data: "provCode", name: "provCode"},
          { data: "isStart", name: "isStart", visible:false},
          { data: "sectorID", name: "sectorID", visible:false}
          ]
      }).ajax.reload();
}
