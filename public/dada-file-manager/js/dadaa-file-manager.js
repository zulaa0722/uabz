var parent="dadaa123";
$(document).ready(function(){
  rlf();
  rrf();
});
$(document).ready(function(){
    $("#btnNewFolderShow").click(function(){
        $("#modalNewFolder").modal('show');
    });
});


$(document).ready(function(){
    $("#btnNewFolder").click(function(){
        var proceed = true;
        if($("#txtNewFolderName").val() == ""){
            alertify.error("Хавтасны нэр хоосон байна!!!");
            proceed = false;
        }
        if(proceed){
            $.ajax({
                type:"POST",
                url:$("#btnNewFolder").attr("post-url"),
                data:{
                    _token:$('meta[name="csrf-token"]').attr('content'),
                    pid:parent,
                    fn:$("#txtNewFolderName").val()
                },
                success:function(response){
                    console.log(response);
                    var myObj = JSON.parse(response);
                    if(myObj.status == "success"){
                        alertify.alert(myObj.msg);
                        rlf();
                        rrf();
                        $("#txtNewFolderName").val("");
                        $("#modalNewFolder").modal('hide');
                    }
                    else{
                        alertify.error(myObj.msg);
                    }
                }
            });
        }
    });
});

function rlf(){
    $.ajax({
        type:"POST",
        url:$("#fl-left").attr('glfu'),
        data:{
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(response){
            $("#fl-left").empty();
            $("#fl-left").html(response);
        },
        error:function(){
            alertify.error("Сервер алдаа!!! Веб мастерт хандана уу!!!");
        }
    });
}

function rrf(){
    $("#fl-right").empty();
    // alert(parent + " aaa " + $("#btnBackFolder").attr("data-id"));
    $.ajax({
        type:"post",
        url:$("#fl-right").attr('grfu'),
        data:{
            _token:$('meta[name="csrf-token"]').attr('content'),
            pid:parent
        },
        success:function(response){
            $("#fl-right").empty();
            $("#fl-right").html(response);
        },
        error:function(){
            alertify.error("Сервер алдаа!!! Веб мастерт хандана уу!!!");
        }
    });
}

$(document).on('click', '.clickable', function(){
    parent = $(this).attr('data-id');
    // alert(parent);
    rrf();
});

$(document).on('change', '#cmbActionFolder', function(){
    if($(this).val()=="edit"){
        $("#hideOldFolderName").val($(this).attr("fname"));
        $("#txtEditFolderName").val($(this).attr("fname"));
        $("#modalEditFolder").modal('show');
        // alert(parent);
    }
    else if($(this).val()=="delete"){
      var url = $(this).attr("durl");
      var fp = $(this).attr("data-id");
      alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
        if (e) {
            deleteFolder(url, fp);
        } else {
            alertify.error('Устгах үйлдэл цуцлагдлаа.');
        }
      });
    }
});

function deleteFolder(url, fp){
    $.ajax({
        type:"post",
        url:url,
        data:{
          _token:$("meta[name=csrf-token]").attr("content"),
          fp:fp
        },
        success:function(response){
          var myObj = JSON.parse(response);
          if(myObj.status == "success"){
              alertify.alert(myObj.msg);
              rlf();
              rrf();
          }
          else{
              alertify.error(myObj.msg);
          }
        }
    });
}

function renameFolder(pid, oldFolder, newFolder, url){
    $.ajax({
        type:"get",
        url:url,
        data:{
            _token:$("meta[name=csrf-token]").attr("content"),
            pid:pid,
            oldFolder:oldFolder,
            newFolder:newFolder
        },
        success:function(response){
            var myObj = JSON.parse(response);
            if(myObj.status == "success"){
                alertify.alert(myObj.msg);
                rlf();
                rrf();
                $("#modalEditFolder").modal("hide");
            }
            else{
                alertify.error(myObj.msg);
            }
        }
    });
}

$(document).ready(function(){
    $("#btnEditFolder").click(function(){
        var pid = $("#btnBackFolder").attr("data-real-id");
        var oldFolder = $("#hideOldFolderName").val();
        var newFolder = $("#txtEditFolderName").val();
        var url = $("#btnEditFolder").attr("post-url");
        renameFolder(pid, oldFolder, newFolder, url);
    });
});

$(document).on('click', '#btnBackFolder', function(){
    parent = $("#btnBackFolder").attr("data-id");
    if(parent == "dadaa123" || parent=="public")
      return;
    if($("#btnBackFolder").attr("data-id") != "public"){
        $.ajax({
            type:"post",
            url:$("#fl-right").attr('grfu'),
            data:{
                _token:$('meta[name="csrf-token"]').attr('content'),
                pid:$("#btnBackFolder").attr("data-id")
            },
            success:function(response){
                $("#fl-right").empty();
                $("#fl-right").html(response);
            },
            error:function(){
                alertify.error("Сервер алдаа!!! Веб мастерт хандана уу!!!");
            }
        });
    }
});

$(document).on('click', '#btnNewFileShow', function(){
    $("#modalUploadFile").modal('show');
    // $("#images").html("");
});

$(document).on('change', '#cmbImgFolder', function(){
    if($(this).val() == "show"){
        $('#imgShowImage').attr('src',$(this).attr("img-url"));
        $("#modalShowImage").modal('show');
        $("option:selected").removeAttr("selected");
    }
    else if($(this).val() == "delete"){
        var path = $(this).attr("ip");
        var url = $(this).attr("durl");
        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
            if (e) {
                deleteImage(url, path);
            } else {
                alertify.error('Устгах үйлдэл цуцлагдлаа.');
            }
        });
    }
});

function deleteImage(url, path){
    $.ajax({
        type:"POST",
        url:url,
        data:{
            _token:$('meta[name="csrf-token"]').attr('content'),
            path:path
        },
        success:function(response){
            var myObj = JSON.parse(response);
            if(myObj.status == "success"){
                alertify.alert(myObj.msg);
                rrf();
                $("#modalEditFolder").modal("hide");
            }
            else{
                alertify.error(myObj.msg);
            }
        }
    });
}

$(document).on('click', '.clickableImage', function(){
    if($("#hideType").val() == "editor"){
      SelectFile($(this).attr("img-url"));
    }
    else{
      getFileUrl($(this).attr("img-url"));
    }
});

function SelectFile( fileUrl )
{
    var img = new Image();
    var width=0;
    var height=0;
    img.onload = function(){
        // alert( this.width+' '+ this.height );
        window.opener.document.getElementById("cke_122_textInput").value = fileUrl;
        window.opener.document.getElementById("cke_132_textInput").value = this.width;
        window.opener.document.getElementById("cke_135_textInput").value = this.height;
        window.opener.document.getElementById("cke_116_previewImage").src = fileUrl;
        window.opener.document.getElementById("cke_116_previewImage").style.display = "block";
        // window.opener.document.getElementById("cke_116_previewImage").innerHTML="<img src='" + fileUrl + "' id='PreviewImage' />" + window.opener.document.getElementById("cke_115_previewLink").innerHTML;
        window.close();
    };
    img.src = fileUrl;
}

function getFileUrl(fileUrl){
  // window.opener.document.dada = fileUrl;
  window.opener.setImageUrl(fileUrl);
  window.close();
}
