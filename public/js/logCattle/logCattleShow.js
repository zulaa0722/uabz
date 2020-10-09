function aimag(aimagCode, url){
    $.ajax({
      type:"post",
      url:url,
      data:{
          _token:$('meta[name="csrf-token"]').attr('content'),
          provID:aimagCode
      },
      success:function(res){
          $("#listSyms").empty();
          $("#listSyms").append("<label>Сумаа сонгоно уу.</label>");
          $.each(res, function(key, val){
              // alert(val.symName);
              var atag = '<a href="#" onclick="getSymData(' + val.symID + ', ' + val.id + ')" class="list-group-item list-group-item-action" data-toggle="list">' + val.symName + '</a>';
              $("#listSyms").append(atag);
          });
      }
    });
}

function getSymData(symID, dangerID){
  refresh(symID, dangerID);
}

function refresh(symID, dangerID){

  $('#cattleDB').dataTable().fnDestroy();
  cols = [
    { data: "number", name: "number"},
    { data: "provID", name: "provID"},
    { data: "sumID", name: "sumID"}
  ];
  $.each(cols1, function(key, val){
    alert(val.id);
    item = {};
    item["data"] = '' + val.cattleName + '';
    item["name"] = '' + val.cattleName + '';
    cols.push(item);
  });
console.log(cols);
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
    "ajax":{
        "url": $("#cattleDB").attr("post-url"),
        "dataType": "json",
        "type": "post",
        "data":{
            _token: $('meta[name="csrf-token"]').attr('content')
          }
     },
     // "initComplete":function( settings, json){
     //      $(".btnYear").prop('disabled', false);
     //      $("#loadImage").addClass('d-none');
     //  },
     "columns": cols
  });
}
