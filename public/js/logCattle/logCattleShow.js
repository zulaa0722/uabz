$(document).ready(function(){
    $("#cmbProv").change(function(){
      if($(this).val() == "0"){
          $("#divSums").addClass('d-none');
          return;
      }
      $("#divSums").removeClass('d-none');
      $.ajax({
        type:"post",
        url:$("#cmbProv").attr('post-url'),
        data:{
            _token:$('meta[name="csrf-token"]').attr('content'),
            provID:$("#cmbProv").val()
        },
        success:function(res){
            $('#cmbSum').empty();
            $("#cmbSum").append(new Option("Сонгоно уу", "0"));
            $.each(res, function(key, val){
                $("#cmbSum").append(new Option(val.symName, val.symID));
                $('#cmbSum').attr('danger-id', val.id);
                // var atag = '<a href="#" onclick="getSymData(' + val.symID + ', ' + val.id + ')" class="list-group-item list-group-item-action" data-toggle="list">' + val.symName + '</a>';
                // $("#listSyms").append(atag);
            });
        }
      });
    });
});

$(document).ready(function(){
    $("#cmbSum").change(function(){
        if($(this).val() == "0"){
          $("#lblProv").text("");
          $("#lblSum").text("");
        }
        else{
          $("#lblProv").text($("#cmbProv option:selected").text() + " аймгийн ");
          $("#lblSum").text($("#cmbSum option:selected").text() + " сумын ");
        }
        refresh($(this).val(), $(this).attr('danger-id'));
    });
});

// refresh Table
function refresh(symID, dangerID){

  $('#cattleDB').dataTable().fnDestroy();
  cols = [
    { data: "number", name: "number"},
    { data: "date", name: "date"}
  ];
  $.each(cattlesCols, function(key, val){
    item = {};
    item["data"] = 'qtt' + val.id + '';
    item["name"] = 'qtt' + val.id + '';
    cols.push(item);
    item = {};
    item["data"] = 'toSheep' + val.id + '';
    item["name"] = 'toSheep' + val.id + '';
    cols.push(item);
    item = {};
    item["data"] = 'toKG' + val.id + '';
    item["name"] = 'toKG' + val.id + '';
    cols.push(item);
  });
// console.log(cols);
// return;
  table = $('#cattleDB').DataTable({
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
    "stateSave": true,
    "orderCellsTop": true,
    "fixedHeader": true,
    "scrollX":true,
    "processing": true,
    "scrollX": true,
    "ajax":{
        "url": $("#cattleDB").attr("post-url"),
        "dataType": "json",
        "type": "post",
        "data":{
            _token: $('meta[name="csrf-token"]').attr('content'),
            sumCode:symID,
            dangerID:dangerID
          }
     },
     // "initComplete":function( settings, json){
     //      $(".btnYear").prop('disabled', false);
     //      $("#loadImage").addClass('d-none');
     //  },
     "columns": cols
  });
}
// refresh Table


// START Modal show hiij haruulah button click event
$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#cmbProv").removeClass("is-invalid");
        $("#cmbSum").removeClass("is-invalid");
        $("#provName").text($("#cmbProv option:selected").text());
        $("#symName").text($("#cmbSum option:selected").text());
        if($("#cmbSum").val() == '0'){
            $("#cmbProv").addClass("is-invalid");
            $("#cmbSum").addClass("is-invalid");
            alertify.error('Та өгөгдөл оруулах аймаг сумаа сонгоно уу!!!');
            return;
        }
        $('#modalLogCattleQnttNew').modal('show');
    });
});
// END Modal show hiij haruulah button click event
