$(document).ready(function(){
    $("#btnNormDelete").click(function(){
        if($("#cmbNorms").val() == "-1"){
            $("#cmbNormError").text("Та устгах нормоо сонгоно уу!!!");
            $("#cmbNorms").addClass("is-invalid");
            return;
        }
        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
            $("#cmbNormError").text("");
            $("#cmbNorms").removeClass("is-invalid");
            if (e) {
                $.ajax({
                    type: 'post',
                    url: $("#btnNormDelete").attr("post-url"),
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        normID:$("#cmbNorms").val()
                    },
                    success:function(res){
                        if(res.status == 'success'){
                            alertify.alert(res.msg);
                            $("#cmbNorms").find('option:selected').remove();
                            refreshNormsTable();
                        }
                        else{
                            alertify.error(res.msg);
                        }
                    }
                });
            }
        });
    });
});
