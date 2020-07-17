$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalStatusNew").modal("show");
    });

  $("#btnStatusAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isInsert = true;

  if($("#statusName").val()==""){
    alertify.error("Та заавал ТӨЛӨВИЙН НЭР оруулана уу!!!");
    isInsert = false;
  }
  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:statusNew,
    data:$("#frmStatusNew").serialize(),
    success:function(response){
        alertify.alert( response);
        statusTableRefresh();
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
  $("#statusName").val("");
}

function statusTableRefresh()
{
  $('#statusDB').DataTable().destroy();
  table = $('#statusDB').DataTable({
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
                "url": getStatus,
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
         { data: "statusName", name: "statusName"}
         ]
     }).ajax.reload();
}
