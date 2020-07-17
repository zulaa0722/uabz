var count = 1;
function showUploadedItem(source,index,i) {
    var div = $("#images");
    var divCol = "<div class='col-md-3'>";
    divCol = divCol + "<img id='post-image' width='100%' height='80' class='" + i + "' src=''>";
    divCol = divCol + '<div class="progress">';
    divCol = divCol + '<div id="prog' + i + '" class="progress-bar progress-bar-error" data-transitiongoal="0"></div></div>';
    divCol = divCol + '<div id="alert' + i + '"class="alert alert-danger" style="display:none;" role="alert"></div>';
    divCol = divCol + "</div>";
    if(count%4==0){
      divCol = divCol + "<div class='clearfix'></div>";
    }
    div.append(divCol);
    // div.append("</div></div>");
    $("." + i + "").attr("src",source);
    count++;
}

$(document).on('change', '#fileUpload', function(){
    var file = this.files;
    $.each(file, function(i, filename) {
        // alert(filename["type"]);
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if(validImageTypes.includes(filename["type"])){
            reader = new FileReader();
            reader.onloadend = function (e) {
                showUploadedItem(e.target.result, filename.name, i);
            };
            reader.readAsDataURL(filename);
        }
    });
});

$(document).on('click', '#btnFileUpload', function(){
    var files = $("#fileUpload")[0].files;

    $.each(files, function(i, file) {
        $("#myFile1").files = file;
        // console.log($("#myFile1").files);
        var formdata = new FormData();
        formdata.append('image', file);
        formdata.append('path', parent);

        console.log(formdata);

        $.ajax({
            url:$("#btnFileUpload").attr('data-url'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:formdata,
            type:"POST",
            contentType: false,
            // contentType:"multipart/form-data",
            // contentType: "multipart/form-data; boundary=dadaa",
            processData: false,
            xhr: function(){
                // get the native XmlHttpRequest object
                var xhr = $.ajaxSettings.xhr() ;
                // set the onprogress event handler
                xhr.upload.onprogress = function(evt){
                  console.log('progress', evt.loaded/evt.total*100) ;
                  var percent = Math.round(evt.loaded/evt.total * 100);
                  $("#prog" + i).css('width',percent+"%").html(percent+"%");
                } ;
                // set the onload event handler
                xhr.upload.onload = function(){ console.log('DONE!') } ;
                // return the customized object
                return xhr ;
            },
            success:function(response){
                $.each(response, function(index, item){
                    if(item.success == "success"){
                        $("#prog" + i).addClass("progress-bar bg-success").html("Хадгаллаа!!!");
                        $("#alert" + i).hide();
                    }
                    else if(item.success == "bError"){
                        $("#prog" + i).addClass("progress-bar bg-danger").html("Алдаа");
                        $("#alert" + i).show();
                        $("#alert" + i).html(item.msg);
                    }
                    else{

                    }
                });
            },
            error:function(response){
              $("#prog" + i).addClass("progress-bar bg-danger").html("Алдаа");
              $("#alert" + i).show();
              $("#alert" + i).html("Алдаа гарлаа!!! Веб мастерт хандана уу!!!");
            }
        });
        rrf();
    });
});
