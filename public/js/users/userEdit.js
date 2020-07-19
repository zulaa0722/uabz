$(document).ready(function(){
    $("#btnEditModalOpen").click(function(){
        if(dataRow == ""){
            alertify.error("Дээрхи хүснэгтээс засах мөрийг сонгоно уу!!!");
            return;
        }
        $("form#frmNewUser :input").each(function(){
            $(this).removeClass("is-invalid");
        });
        $("#name").val(dataRow['name']);
        $("#email").val(dataRow['email']);
        $('select[name="permission"]').find('option[value="' + dataRow['permission'] + '"]').attr("selected",true);
        $('select[name="province"]').find('option[value="' + dataRow['aimagCode'] + '"]').attr("selected",true);

        $("#modalUserEdit").modal("show");
    });
});


$(document).ready(function(){
    $("#btnUpdateUser").click(function(e){
        e.preventDefault();
        $("form#frmNewUser :input").each(function(){
            $(this).removeClass("is-invalid");
        });
        if($("#name").val() == ""){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#name").addClass("is-invalid");
            return;
        }
        if($("#email").val() == ""){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#email").addClass("is-invalid");
            return;
        }
        if($("#cmbPermission").val() == "0"){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#cmbPermission").addClass("is-invalid");
            return;
        }
        if($("#cmbProvince").val() == "0"){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#cmbProvince").addClass("is-invalid");
            return;
        }
        $.ajax({
            type: 'post',
            url: $(this).attr('post-url'),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: dataRow['id'],
                name: $("#name").val(),
                email: $("#email").val(),
                permission: $("#cmbPermission").val(),
                aimagCode: $("#cmbProvince").val()
            },
            success:function(res){
                if(res.status == "success"){
                    alertify.alert(res.msg);
                    refreshUserTable();
                }
                else{
                    alertify.alert(res.msg);
                }
            }
        });
    });
});


function refreshUserTable(){
  $('#tableUsers').dataTable().fnDestroy();
  table = $('#tableUsers').DataTable({
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
                "url": getUsersUrl,
                "dataType": "json",
                "type": "post",
                "data":{
                     _token: $('meta[name="csrf-token"]').attr('content')
                   }
              },
       "columns": [
         { data: "id", name: "id",  render: function (data, type, row, meta) {
       return meta.row + meta.settings._iDisplayStart + 1;
   }  },
         { data: "name", name: "name"},
         { data: "email", name: "email"},
         { data: "permission", name: "permission", "visible":false},
         { data: "permissionName", name: "permissionName"},
         { data: "aimagCode", name: "aimagCode", "visible":false},
         { data: "provName", name: "provName"}
         ]
     });
}
