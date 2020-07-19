$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
        $("#modalNormNew").modal("show");
    });
});

$(document).ready(function(){
    $("#cmbNorms").change(function(){
        $("#cmbNormError").text("");
        $("#cmbNorms").removeClass("is-invalid");
        refreshNormsTable();
    });
});

function refreshNormsTable(){
  $('#tableNorms').dataTable().fnDestroy();
  $('#tableNorms').DataTable({
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
                "url": getNormsUrl,
                "dataType": "json",
                "type": "post",
                "data":{
                     _token: $('meta[name="csrf-token"]').attr('content'),
                     id:$("#cmbNorms").val()
                   }
              },
       "columns": [
         { data: "id", name: "id",  render: function (data, type, row, meta) {
       return meta.row + meta.settings._iDisplayStart + 1;
   }  },
         { data: "productName", name: "productName"},
         { data: "normQntt", name: "normQntt"},
         { data: "normCkal", name: "normCkal"}
         ]
     });
}
