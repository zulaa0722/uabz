$(document).ready(function(){
    $("#btnDeleteUser").click(function(){
        if(dataRow == ""){
            alertify.error("Дээрхи хүснэгтээс устгах хэрэглэгчийн мөрийг сонгоно уу!!!");
            return;
        }
        alertify.confirm( "Та хэрэглэгч устгахдаа итгэлтэй байна уу?", function (e) {
              if (e) {
                  $.ajax({
                      type: 'post',
                      url: $("#btnDeleteUser").attr("post-url"),
                      data: {
                          _token: $('meta[name="csrf-token"]').attr('content'),
                          id:dataRow['id']
                      },
                      success:function(res){
                          if(res.status == 'success'){
                              alertify.alert(res.msg);
                              table.rows('.selected').remove().draw(false);
                              dataRow = "";
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
