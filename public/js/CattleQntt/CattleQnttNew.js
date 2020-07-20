$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
      if(dataRow == "")
      {
        alertify.error('Та НЭМЭХ мөрөө сонгоно уу!!!');
        return;
      }

      $("#modalCattleQnttNew").modal("show");
      $("#provName").text(dataRow[1]);
      $("#symName").text(dataRow[2]);

      var i=3;
      $(".cattleQnttFields").each(function(){
        $(this).val(dataRow[i]);
        i++;
      });

    });

    $("#btnCattleQnttAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isEmpty = 0;
  $(".cattleQnttFields").each(function(){
    if($(this).val() != "")
    {
      isEmpty++;
    }
  });
  if(isEmpty == 0){ alertify.error("Та малын тоо толгойг оруулна уу!"); return; }

  jsonObj = [];
  $(".foodProductFields").each(function(){
      if($(this).val() != "" ){
          item = {}
          item ["productID"] = $(this).attr('id');
          item ["foodQntt"] = $(this).val();
          jsonObj.push(item);
      }
  });

  $.ajax({
    type:'post',
    url:foodReserveNewUrl,
    data:{
      _token: $('meta[name="csrf-token"]').attr('content'),
      provID: dataRow[1],
      symID: dataRow[2],
      reserveDate: $("#foodReserveDate").val(),
      qntt: jsonObj
    },
    success:function(response){
        if(response.status == 'success'){

          var table = $("#FoodReserveTable").DataTable();

          var rowData = [];
          var index = 0;
          $(".foodProductFields").each(function(){
            rowData[index] = $(this).val();
            index++;
          });

          //songogdson moriin nudnii utgiig oorchilj bn
          table.rows({ selected: true })
          .every(function (rowIdx, tableLoop, rowLoop){
            for(var i=0; i<index; i++)
              table.cell(rowIdx, i+5).data(rowData[i]);
          }).draw();

          $("#modalFoodReserveNew").modal("hide");
          alertify.alert(response.msg);
        }
        else{
          alertify.error(response.msg);
        }
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
function cattleQnttTableRefresh1()
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
