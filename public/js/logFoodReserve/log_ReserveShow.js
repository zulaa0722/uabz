function aimag(aimagCode, url){
    $.ajax({
      type:"post",
      url:url,
      data:{
        _token:$('meta[name="csrf-token"]').attr('content'),
        provID: aimagCode
      },
      success:function(res){
        // console.log(res);
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

  $('#remainingProducts').dataTable().fnDestroy();
  cols = [
    { data: "number", name: "number"}
  ];
  $.each(cols1, function(key, val){

    item = {};
    item["data"] = '' + val.id + '';
    item["name"] = '' + val.id + '';
    cols.push(item);
  });
  cols.push({data: "date", name: "date"})
// console.log(cols);
  table = $('#remainingProducts').DataTable({
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

    // "scrollCollapse": true,
    // "scroller":       true,
    "ordering": false,
    "ajax":{
        "url": $("#remainingProducts").attr("post-url"),
        "dataType": "json",
        "type": "post",
        "data":{
            _token: $('meta[name="csrf-token"]').attr('content'),
            dangerID: dangerID,
            symID: symID
          }
     },
     // "initComplete":function( settings, json){
     //      $(".btnYear").prop('disabled', false);
     //      $("#loadImage").addClass('d-none');
     //  },
     "columns": cols
  });
}
