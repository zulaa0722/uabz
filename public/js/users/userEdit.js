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
        $('select[name="organization"]').find('option[value="' + dataRow['organizationID'] + '"]').attr("selected",true);
        if(dataRow['permission'] == 1){
            $("#divProvince").addClass('d-none');
            $("#divOrganization").addClass('d-none');
        }
        if(dataRow['permission'] == 2){
            $("#divProvince").removeClass('d-none');
            $("#divOrganization").addClass('d-none');
        }
        if(dataRow['permission'] == 3){
            $("#divProvince").addClass('d-none');
            $("#divOrganization").removeClass('d-none');
        }

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
            alertify.error("Цахим хаягаа оруулна уу!!!");
            $("#email").addClass("is-invalid");
            return;
        }
        if($("#cmbPermission").val() == "0"){
            alertify.error("Хэрэглэгчийн түвшингээ сонгоно уу!!!");
            $("#cmbPermission").addClass("is-invalid");
            return;
        }
        if($("#cmbPermission").val() == "2" && $("#cmbProvince").val() == "0"){
            alertify.error("Аймгаа сонгоно уу!!!");
            $("#cmbProvince").addClass("is-invalid");
            return;
        }
        if($("#cmbPermission").val() == "3" && $("#cmbOrganization").val() == "0"){
            alertify.error("Байгууллагаа сонгоно уу!!!");
            $("#cmbOrganization").addClass("is-invalid");
            return;
        }
        $.ajax({
            type: 'post',
            url: $("#btnUpdateUser").attr('post-url'),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: dataRow['id'],
                name: $("#name").val(),
                email: $("#email").val(),
                permission: $("#cmbPermission").val(),
                aimagCode: $("#cmbProvince").val(),
                organization: $("#cmbOrganization").val()
            },
            success:function(res){
                if(res.status == "success"){
                    alertify.alert(res.msg);
                    refreshUserTable();
                }
                else{
                    alertify.error(res.msg);
                }
            }
        });
    });
});


$(document).ready(function(){
    $("#cmbPermission").change(function(){
        if($(this).val() == "1" || $(this).val() == "0"){
            $("#divProvince").addClass('d-none');
            $("#divOrganization").addClass('d-none');
        }
        if($(this).val() == "2"){
            $("#divProvince").removeClass('d-none');
            $("#divOrganization").addClass('d-none');
        }
        if($(this).val() == "3"){
            $("#divProvince").addClass('d-none');
            $("#divOrganization").removeClass('d-none');
        }
    });
});


function refreshUserTable(){
    table.rows({ selected:true}).every(function (rowIdx, tableLoop, rowLoop){
        table.cell(rowIdx, 1).data($("#name").val());
        table.cell(rowIdx, 2).data($("#email").val());
        table.cell(rowIdx, 3).data($("#cmbPermission").val());
        table.cell(rowIdx, 4).data($("#cmbPermission option:selected").text());
        table.cell(rowIdx, 5).data($("#divProvince").val());
        table.cell(rowIdx, 6).data($("#divProvince option:selected").text());
        table.cell(rowIdx, 7).data($("#divOrganization").val());
        table.cell(rowIdx, 8).data($("#divOrganization option:selected").text());
    }).draw();
    dataRow = '';
}
