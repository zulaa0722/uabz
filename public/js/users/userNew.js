$(document).ready(function(){
    $("#btnSaveUser").click(function(e){
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
        if($("#password").val() == ""){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#password").addClass("is-invalid");
            return;
        }
        if($("#password-confirm").val() == ""){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#password-confirm").addClass("is-invalid");
            return;
        }
        if($("#password").val() != $("#password-confirm").val()){
            alertify.error("Таны оруулсан нууц үг таарахгүй байна!!!");
            $("#password-confirm").addClass("is-invalid");
            $("#password").addClass("is-invalid");
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
        $("#frmNewUser").submit();
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
