$(document).ready(function(){
    $("#btnSectorAdd").click(function(){
        $("#modalCattleNew").modal("show");
    });

    $("#btnCattleAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isInsert = true;
  var isInsert = true;
  
  if($("#cattleName").val()==""){
    alertify.error("Та заавал МАЛЫН МАХНЫ ТӨРӨЛ бичнэ үү!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:cattleNew,
    data:$("#frmCattleNew").serialize(),
    success:function(response){
        alertify.alert( response);
        cattleTableRefresh();
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
  $("#cattleName").val("");
  $("#ratioToSheep").val("");
}
function cattleTableRefresh()
{
  $('#cattleDB').DataTable().destroy();
  var table = $('#cattleDB').DataTable({
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
                 "url": getCattle,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf
                    }
               },
        "columns": [
          { data: "id", name: "id",  render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }  },
          { data: "cattleName", name: "cattleName"},
          { data: "ratio", name: "ratio"}
          ]
      }).ajax.reload();
}
