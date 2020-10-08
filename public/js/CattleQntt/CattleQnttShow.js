$(document).ready(function(){
    $(".btnYear").click(function(){
        // alert($(this).attr("value"));
        year = $(this).attr("value");
        dataRow = "";
        $(".btnYear").removeClass("btn-outline-info");
        $(".btnYear").addClass("btn-info");
        $(this).removeClass("btn-info");
        $(this).addClass("btn-outline-info");
        $("#headerYear").text($(this).attr("value") + " он");
        refresh($(this).attr("value"));
    });
});


function refresh(year){
    table = "";
    $(".btnYear").prop('disabled', true);
    $("#loadImage").removeClass('d-none');
    $('#cattleQnttDB').dataTable().fnDestroy();
    table = $('#cattleQnttDB').DataTable({
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
          "url": $("#cattleQnttDB").attr("post-url"),
          "dataType": "json",
          "type": "post",
          "data":{
              _token: $('meta[name="csrf-token"]').attr('content'),
              year:year
            }
       },
       "initComplete":function( settings, json){
            $(".btnYear").prop('disabled', false);
            $("#loadImage").addClass('d-none');
        },
       "columns": [
         { data: "number", name: "number"},
         { data: "provID", name: "provID"},
         { data: "sumID", name: "sumID"},
         { data: "provName", name: "provName"},
         { data: "sumName", name: "sumName"},
         { data: "sheep", name: "5"},
         { data: "goat", name: "goat"},
         { data: "cattle", name: "cattle"},
         { data: "horse", name: "horse"},
         { data: "camel", name: "camel"}
         ]
    });


}
