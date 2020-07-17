$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalAxaxNew").modal("show");
    });

  $("#btnAxaxAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isInsert = true;

  if($("#axaxName").val()==""){
    alertify.error("Та заавал АВЧ ХЭРЭГЖҮҮЛЭХ АРГА ХЭМЖЭЭНИЙ УТГА оруулана уу!!!");
    isInsert = false;
  }
  if($("#levelID").val()=="-1"){
    alertify.error("Та заавал ЗЭРЭГ сонгоно уу!!!");
    isInsert = false;
  }
  if($("#inTime").val()==""){
    alertify.error("Та заавал Ц (Шийдвэр гарсан хугацаа) оруулана уу!!!");
    isInsert = false;
  }

  if($("#mainOrgID").val()=="-1"){
    alertify.error("Та заавал УДИРДАН ЗОХИОН БАЙГУУЛАХ БАЙГУУЛЛАГА сонгоно уу!!!");
    isInsert = false;
  }

  if($("#supportOrgID").val()=="-1"){
    alertify.error("Та заавал ДЭМЖЛЭГ ҮЗҮҮЛЭХ БАЙГУУЛЛАГА сонгоно уу!!!");
    isInsert = false;
  }

  if(isInsert == false){return;}

  $.ajax({
    type:'post',
    url:axaxNew,
    data:$("#frmAxaxNew").serialize(),
    success:function(response){
        alertify.alert( response);
        AxaxTableRefresh();
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
  $("#axaxName").val("");
  $("#levelID").val("-1");
  $("#inTime").val("");
  $("#mainOrgID").val("-1");
  $("#supportOrgID").val("-1");
}

function AxaxTableRefresh()
{
  $('#axaxDB').DataTable().destroy();
   table = $('#axaxDB').DataTable({
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
                 "url": getAxax,
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
          { data: "axaxName", name: "axaxName"},
          { data: "levelName", name: "levelName"},
          { data: "inTime", name: "inTime"},
          { data: "mainName", name: "mainName"},
          { data: "supportName", name: "supportName"},
          { data: "levelID", name: "levelID", visible:false},
          { data: "mainOrgID", name: "mainOrgID", visible:false},
          { data: "supportOrgID", name: "supportOrgID", visible:false}
          ]
      }).ajax.reload();
}
