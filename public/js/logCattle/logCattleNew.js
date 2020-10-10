$(document).ready(function(){
    $(".cattleQnttFields").keyup(function(){
        var qntt = $(this).val();
        var toSheepRatio = $(this).attr("ratio");

        $("#sheep"+$(this).attr("id")).text((toSheepRatio * qntt).toFixed(2));
        var allSheep = parseFloat($("#sheep"+$(this).attr("id")).text());
        $("#sheepKg"+$(this).attr("id")).text((allSheep * sheepKG).toFixed(2));
    });
});


$(document).ready(function(){
    $("#btnLogCattleQnttAdd").click(function(e){
        e.preventDefault();
        $(".cattleQnttFields").removeClass("is-invalid");
        $("#dateOgnoo").removeClass("is-invalid");
        var isEmpty = 0;
        $(".cattleQnttFields").each(function(){
          if($(this).val() != "")
          {
            isEmpty++;
          }
        });
        if(isEmpty == 0){ alertify.error("Та малын тоо толгойг оруулна уу!"); return; }
        if($("#dateOgnoo").val() == ""){
            alertify.error("Огноо оруулна уу!!!");
            $("#dateOgnoo").addClass("is-invalid");
            return;
        }
        insertLogCattles($(this).attr('post-url'));
    });
});


function insertLogCattles(url){
    jsonObj = [];
    $(".cattleQnttFields").each(function(){
        if($(this).val() != "" ){
            item = {};
            item ["cattleID"] = $(this).attr('id');
            item ["cattleQntt"] = $(this).val();
            item ["toSheepQntt"] = $("#sheep"+$(this).attr('id')).text();
            item ["toSheepKg"] = $("#sheepKg"+$(this).attr('id')).text();
            jsonObj.push(item);
        }
    });


    $.ajax({
        type:"post",
        url:url,
        data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            provID: $("#cmbProv").val(),
            symCode: $("#cmbSum").val(),
            date:$("#dateOgnoo").val(),
            dangerid:$("#cmbSum option:selected").attr('dangerid'),
            jsonObj: jsonObj
        },
        success:function(res){

        }
    });
}
