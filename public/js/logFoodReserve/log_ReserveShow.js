$(document).ready(function(){
  $("#cmbProv").change(function(){

    if($("#cmbProv").val() == "-1")
      $("#showSymDiv").addClass("d-none")

    var url = $(this).attr("post-url");
    var provID = $(this).val();

    $("#showSymDiv").removeClass("d-none");

    $.ajax({
      type: "post",
      url: url,
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: provID
      },
      success: function(res){
        // console.log(res);
        $('#cmbSym').empty();
        $("#cmbSym").append($('<option>', {
            value: '-1',
            text: 'Сонгоно уу'
          }).attr('dangerID', 'lol')
        );
        $.each(res, function(key, val){
            $("#cmbSym").append($('<option>', {
                value: val.symID,
                text: val.symName
              }).attr('dangerID', val.id)
            );
        });
      }
    });
  });
});

$(document).ready(function(){
    $("#cmbSym").change(function(){
        if($(this).val() == "0"){
          $("#lblProv").text("");
          $("#lblSym").text("");
        }
        else{
          $("#lblProv").text($("#cmbProv option:selected").text() + " аймгийн ");
          $("#lblSym").text($("#cmbSym option:selected").text() + " сумын ");
          refresh($(this).val(), $("#cmbSym option:selected").attr('dangerid'));
        }
    });
});

function refresh(symID, dangerID){

  $('#remainingProducts').dataTable().fnDestroy();
  cols = [
    { data: "number", name: "number"},
    { data: "date", name: "date"}
  ];
  $.each(cols1, function(key, val){

    item = {};
    item["data"] = '' + val.id + '';
    item["name"] = '' + val.id + '';
    cols.push(item);
  });
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
