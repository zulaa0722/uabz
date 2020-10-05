var dataRow = "";


$(document).ready(function(){
  refresh();
  // table = $('#tableDangers').DataTable({
  //  "language": {
  //          "lengthMenu": "_MENU_ мөрөөр харах",
  //          "zeroRecords": "Хайлт илэрцгүй байна",
  //          "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
  //          "infoEmpty": "Хайлт илэрцгүй",
  //          "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
  //          "sSearch": "Хайх: ",
  //          "paginate": {
  //            "previous": "Өмнөх",
  //            "next": "Дараахи"
  //          },
  //          "select": {
  //              rows: ""
  //          }
  //      },
  //      select: {
  //        style: 'single'
  //    },
  //      "processing": true,
  //      "serverSide": true,
  //      "stateSave": true,
  //      "ajax":{
  //               "url": $("#tableDangers").attr("dangersShow"),
  //               "dataType": "json",
  //               "type": "post",
  //               "data":{
  //                    _token: $('meta[name="csrf-token"]').attr('content')
  //                  }
  //             },
  //      "columns": [
  //        { data: "id", name: "id",  render: function (data, type, row, meta) {
  //      return meta.row + meta.settings._iDisplayStart + 1;
  //  }},
  //        { data: "commandNumber", name: "commandNumber"},
  //        { data: "declareDate", name: "declareDate"},
  //        { data: "comment", name: "comment"},
  //        { data: "statName", name: "statName"}
  //        ]
  //  });
  //
  //  $('#tableDangers tbody').on( 'click', 'tr', function () {
  //    if ( $(this).hasClass('selected') ) {
  //        $(this).removeClass('selected');
  //        dataRow = "";
  //    }else {
  //        table.$('tr.selected').removeClass('selected');
  //        $(this).addClass('selected');
  //        var currow = $(this).closest('tr');
  //        dataRow = $('#tableDangers').DataTable().row(currow).data();
  //    }
  //    });
});


function refresh(){
  // alert("A");
  // return;
  $('#tableDangers').dataTable().fnDestroy();
  table = $('#tableDangers').DataTable({
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
                "url": $("#tableDangers").attr("dangersShow"),
                "dataType": "json",
                "type": "post",
                "data":{
                     _token: $('meta[name="csrf-token"]').attr('content')
                   }
              },
       "columns": [
         { data: "id", name: "id",  render: function (data, type, row, meta) {
       return meta.row + meta.settings._iDisplayStart + 1;
   }},
         { data: "commandNumber", name: "commandNumber"},
         { data: "declareDate", name: "declareDate"},
         { data: "comment", name: "comment"},
         { data: "statName", name: "statName"}
         ]
   });

   $('#tableDangers tbody').on( 'click', 'tr', function () {
     if ( $(this).hasClass('selected') ) {
         $(this).removeClass('selected');
         dataRow = "";
     }else {
         table.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         var currow = $(this).closest('tr');
         dataRow = $('#tableDangers').DataTable().row(currow).data();
     }
     });
}
