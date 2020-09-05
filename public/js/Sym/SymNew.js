$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalSymNew").modal("show");
    });

    $("#btnSymAdd").click(function(e){
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
  if($("#symName").val()==""){
    alertify.error("Та заавал СУМЫН НЭР бичнэ үү!!!");
    isInsert = false;
  }
  if($("#symCode").val()==""){
    alertify.error("Та заавал СУМЫН КОД бичнэ үү!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:symNew,
    data:$("#frmSymNew").serialize(),
    success:function(response){
        alertify.alert( response);
        symTableRefresh();
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
  $("#symName").val("");
  $("#symCode").val("0");
}
function symTableRefresh()
{
  $('#symDB').DataTable().destroy();
  var table = $('#symDB').DataTable({
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
                 "url": getSym,
                 "dataType": "json",
                 "type": "post",
                 "data":{
                      _token: csrf
                    }
               },
        "columns": [
          {
            data: "id", name: "id",  render: function (data, type, row, meta)
            {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },

          { data: "provName", name: "provName"},
          { data: "symName", name: "symName"},
          { data: "symCode", name: "symCode"},
          { data: "provID", name: "provID", visible:false},
          { data: "normID", name: "normID", visible:false},
          { data: "isCustomizeID", name: "isCustomizeID", visible:false},
          { data: "isStart", name: "isStart", visible:false}
          ]
      }).ajax.reload();
}
