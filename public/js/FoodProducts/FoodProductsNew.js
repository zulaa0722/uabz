$(document).ready(function(){
  $("#btnAddModalOpen").click(function(){
      $("#modalFoodProductsNew").modal("show");
  });

  $("#btnFoodProductsAdd").click(function(e){
        e.preventDefault();
        mainCode();
  });

  var uurag = 0;
  var nuursus = 0;
  var tos = 0;
  $("#foodProtein").keyup(function(){
    if($("#foodProtein").val() != "")
      uurag = $("#foodProtein").val() * 4;
    else
      uurag = 0;
    $("#foodTomCkal").val(uurag + nuursus + tos);
  });
  $("#foodFat").keyup(function(){
    if($("#foodFat").val() != "")
      tos = $("#foodFat").val() * 9;
    else
      tos = 0;
    $("#foodTomCkal").val(uurag + nuursus + tos);
  });
  $("#foodCarbon").keyup(function(){
    if($("#foodCarbon").val() != "")
      nuursus = $("#foodCarbon").val() * 4;
    else
      nuursus = 0;
    $("#foodTomCkal").val(uurag + nuursus + tos);
  });

});

function mainCode()
{
  var isInsert = true;

  if($("#productName").val()==""){
    alertify.error("Та заавал ХҮНСНИЙ БҮТЭЭГДЭХҮҮН оруулана уу!!!");
    isInsert = false;
  }
  if($("#foodQntt").val()==""){
    alertify.error("Та заавал ХЭМЖЭЭ оруулана уу!!!");
    isInsert = false;
  }
  if($("#foodCkal").val()==""){
    alertify.error("Та заавал ККАЛ оруулана уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:foodProductsNew,
    data:$("#frmFoodProductsNew").serialize(),
    success:function(response){
        alertify.alert( response);
        FoodProductsTableRefresh();
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
  $("#productName").val("");
  $("#foodQntt").val("");
  $("#foodProtein").val("");
  $("#foodFat").val("");
  $("#foodCarbon").val("");
  $("#foodCkal").val("");
  $("#foodTomCkal").val("");
  $("#foodPrice").val("");
}

function FoodProductsTableRefresh()
{
  $('#foodProductsDB').DataTable().destroy();
  table = $('#foodProductsDB').DataTable({
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
                "url": getFoodProducts,
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
         { data: "foodQntt", name: "foodQntt"},
         { data: "foodProtein", name: "foodProtein"},
         { data: "foodFat", name: "foodFat"},
         { data: "foodCarbon", name: "foodCarbon"},
         { data: "foodCkal", name: "foodCkal"},
         { data: "foodTomCkal", name: "foodTomCkal"},
         { data: "price", name: "price"}
         ]
     }).ajax.reload();
}
