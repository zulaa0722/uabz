$(document).ready(function(){
    $("#btnChangePasswordModalOpen").click(function(){
        if(dataRow == ""){
            alertify.error("Дээрхи хүснэгтээс засах мөрийг сонгоно уу!!!");
            return;
        }
        $("form#frmChangePasswordUser :input").each(function(){
            $(this).removeClass("is-invalid");
        });
        $("#lblChangePasswordUsername").text(dataRow['name']);
        $("#modalUserChangePassword").modal("show");
    });
});


$(document).ready(function(){
    $("#btnChangePasswordUser").click(function(e){
        e.preventDefault();
        $("form#frmChangePasswordUser :input").each(function(){
            $(this).removeClass("is-invalid");
        });
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

        $.ajax({
            type: 'post',
            url: $(this).attr('post-url'),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: dataRow['id'],
                password: $("#password").val()
            },
            success:function(res){
                if(res.status == "success"){
                    $("#modalUserChangePassword").modal("toggle");
                    alertify.alert(res.msg);
                    emptyChangePasswordForm();
                }
                else{
                    alertify.alert(res.msg);
                }
            }
        });
    });
});


function emptyChangePasswordForm(){
    $("#password").val('');
    $("#password-confirm").val('');
    $("form#frmChangePasswordUser :input").each(function(){
        $(this).removeClass("is-invalid");
    });
}
