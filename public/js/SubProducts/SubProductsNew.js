$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalSubProductsNew").modal("show");
    });

  $("#btnSubProductsAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isInsert = true;

  if($("#fProductID").val()=="-1"){
    alertify.error("Та заавал ХҮНСНИЙ БҮТЭЭГДЭХҮҮН сонгоно уу!!!");
    isInsert = false;
  }
  if($("#subName").val()==""){
    alertify.error("Та заавал ОРЛОХ БҮТЭЭГДЭХҮҮН оруулана уу!!!");
    isInsert = false;
  }
  if($("#multiplier").val()==""){
    alertify.error("Та заавал ИТГЭЛЦҮҮР оруулана уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:subProductsNew,
    data:$("#frmSubProductsNew").serialize(),
    success:function(response){
        alertify.alert( response);
        subProductsTableRefresh();
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
  $("#fProductID").val("-1");
  $("#subName").val("");
  $("#multiplier").val("");
  $("#price").val("");
}

function subProductsTableRefresh()
{
  $('#subProductsDB').DataTable().destroy();
  table = $('#subProductsDB').DataTable({
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
                "url": getSubProducts,
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
         { data: "productName", name: "productName"},
         { data: "subName", name: "subName"},
         { data: "multiplier", name: "multiplier"},
         { data: "fProductID", name: "fProductID", visible:false},
         { data: "price", name: "price"}
         ]
     }).ajax.reload();
}
