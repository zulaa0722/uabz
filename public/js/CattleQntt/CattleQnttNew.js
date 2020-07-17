$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalCattleQnttNew").modal("show");
    });

    $("#btnCattleQnttAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isInsert = true;

  if($("#provID").val()=="-1"){
    alertify.error("Та заавал АЙМГИЙН НЭР сонгоно уу!!!");
    isInsert = false;
  }
  if($("#symID").val()=="-1"){
    alertify.error("Та заавал СУМЫН НЭР сонгоно уу!!!");
    isInsert = false;
  }
  if($("#cattleID").val()=="-1"){
    alertify.error("Та заавал МАХНЫ ТӨРӨЛ сонгоно уу!!!");
    isInsert = false;
  }

  if($("#cattleQntt").val()=="-1"){
    alertify.error("Та заавал МАХНЫ ТӨРӨЛ сонгоно уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:cattleQnttNew,
    data:$("#frmCattleQnttNew").serialize(),
    success:function(response){
        alertify.alert( response);
        cattleQnttTableRefresh();
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
  $("#provID").val("-1");
  $("#symID").val("-1");
  $("#cattleID").val("-1");
  $("#cattleQntt").val("");

}
function cattleQnttTableRefresh()
{
  $('#cattleQnttDB').DataTable().destroy();
  var table = $('#cattleQnttDB').DataTable({
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
                 "url": getCattleQntt,
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
          { data: "provName", name: "provName"},
          { data: "symName", name: "symName"},
          { data: "cattleName", name: "cattleName"},
          { data: "cattQntt", name: "cattQntt"},
          { data: "provID", name: "provID", visible:false},
          { data: "symID", name: "symID", visible:false},
          { data: "cattleID", name: "cattleID", visible:false}
          ]
      }).ajax.reload();
}
