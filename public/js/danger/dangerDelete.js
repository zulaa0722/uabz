$(document).ready(function(){
    $("#btnCancelDanger").click(function(){
        // alert(dataRow["id"]);
        $.ajax({
            type: "POST",
            url: $("#btnCancelDanger").attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                id:dataRow["id"]
            },
            success:function(res){
              if(res.status == "error"){
                  alertify.error(res.msg);
              }
              else{
                  refresh();
                  alertify.alert(res.msg);
              }
            }
        });
    });
});
