$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalPopulationNew").modal("show");
    });

    $("#provName").change(function(){
      // alert($("#provName").attr("getSymUrl"));
      $("#cmbSymNew option[value!='-1']").each(function(){
        $(this).remove();
      })
      $.ajax({
        type: "post",
        url: $("#provName").attr("getSymUrl"),
        data: {
          _token: $('meta[name="csrf-token"]').attr('content'),
          provID: $("#provName").val()
        },
        success:function(response){
          var obj = JSON.parse(response);
          $.each(obj, function (value, index ) {
             var o = new Option(index['symName'], index['id']);  // Option(name, val)
             $("#cmbSymNew").append(o);
          });
        }
      });
    });

    $("#btnPopulationAdd").click(function(e){
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
  if($("#cmbSymNew").val()=="-1"){
    alertify.error("Та заавал СУМЫН НЭР сонгоно уу!!!");
    isInsert = false;
  }
  if($("#standardPop").val()==""){
    alertify.error("Та заавал Жшшсэн хүн амын тоо оруулана уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:populationNew,
    data:$("#frmPopulationNew").serialize(),
    success:function(response){
        alertify.alert( response);
        populationTableRefresh();
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
  $("#cmbSymNew").val("-1");
  $("#totalPop").val("");
  $("#standardPop").val("");

}
function populationTableRefresh()
{
  $('#populationDB').DataTable().destroy();
  var table = $('#populationDB').DataTable({
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
                 "url": getPopulation,
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
          { data: "totalPop", name: "totalPop"},
          { data: "standardPop", name: "standardPop"},
          { data: "provID", name: "provID", visible:false},
          { data: "symID", name: "symID", visible:false}

          ]
      }).ajax.reload();
}
