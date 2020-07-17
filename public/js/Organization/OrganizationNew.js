$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalOrgNew").modal("show");
    });

    $("#btnOrgAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });
});

function mainCode()
{
  var isInsert = true;

  if($("#abbrName").val()==""){
    alertify.error("Та заавал ТОВЧИЛСОН НЭР оруулана уу!!!");
    isInsert = false;
  }
  if($("#fullName").val()==""){
    alertify.error("Та заавал ТАЙЛБАР НЭР бичнэ үү!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:orgNew,
    data:$("#frmOrgNew").serialize(),
    success:function(response){
        alertify.alert( response);
        orgTableRefresh();
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
  $("#abbrName").val("");
  $("#fullName").val("");
}
function orgTableRefresh()
{
  $('#organizationDB').DataTable().destroy();
  var table = $('#organizationDB').DataTable({
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
                 "url": getOrg,
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

          { data: "abbrName", name: "abbrName"},
          { data: "fullName", name: "fullName"}
          ]
      }).ajax.reload();
}
