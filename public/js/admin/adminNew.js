$(document).ready(function(){
    $("#btnNewAdmin").click(function(){
        var proceed = true;
        if($("#txtNewName").val() == ""){
            alertify.error("Хэрэглэгчийн нэрээ оруулна уу!!!");
            $("#txtNewName").addClass(" is-invalid");
            proceed = false;
        }
        if($("#txtNewEmail").val() == ""){
            alertify.error("Цахим хаягаа оруулна уу!!!");
            $("#txtNewName").addClass(" is-invalid");
            proceed = false;
        }
        if($("#cmbNewAdminType").val() == "0"){
            alertify.error("Хэрэглэгчийн төрлөө сонгоно уу!!!");
            $("#cmbNewAdminType").addClass(" is-invalid");
            proceed = false;
        }
        if($("#txtNewPassword").val() == ""){
            alertify.error("Нууц үгээ оруулна уу!!!");
            $("#txtNewName").addClass(" is-invalid");
            proceed = false;
        }
        if($("#txtNewPasswordRepeat").val() == ""){
            alertify.error("Нууц үгээ давтаж оруулна уу!!!");
            $("#txtNewName").addClass(" is-invalid");
            proceed = false;
        }
        if($("#txtNewPasswordRepeat").val() != $("#txtNewPassword").val()){
            alertify.error("Нууц үг хоорондоо таарахгүй байна!!!");
            $("#txtNewName").addClass(" is-invalid");
            proceed = false;
        }
    });
});


function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
