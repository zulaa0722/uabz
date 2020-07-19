$(document).ready(function(){
    $(".txtProductQtt").keyup(function(){
            var qtt = $(this).val();
            var foodQntt = $(this).attr('foodQntt');
            var kcal = $(this).attr('kcal');
            var result = qtt * kcal / foodQntt;
            // alert(qtt);
            $("#product_kcal" + $(this).attr('foodid')).val(result.toFixed(2));
            // $("#lblKcal" + $(this).attr('foodid')).empty();
            $("#lblKcal" + $(this).attr('foodid')).text(result.toFixed(2));
            computeAllKcal();
    });
});

function computeAllKcal(){
    var sumKcal = 0;
    var currentKcal = 0;
    $(".txtProductQtt").each(function(){
        if($(this).val() != "" && $(this).val() != "0"){
            currentKcal = $("#product_kcal" + $(this).attr('foodid')).val();
            sumKcal = parseFloat(sumKcal) + parseFloat(currentKcal);
            $("#lblAllKcal").text(sumKcal.toFixed(2));
            $("#hideSumKcal").val(sumKcal.toFixed(2));
        }
    });
    var empty = true;
    $('.txtProductQtt').each(function(){
       if($(this).val()!=""){
            empty =false;
        }
    });
    if(empty){
        $("#lblAllKcal").text("0");
        $("#hideSumKcal").val("0");
    }
}

$(document).ready(function(){
    $("#btnNormAdd").click(function(){
        if($("#txtNormName").val() == ""){
            alertify.alert("Нормын нэрээ оруулна уу!!!");
            return;
        }
        if($("#hideSumKcal").val() == 0){
            alertify.alert("Бүтээгдэхүүний тоо хэмжээ оруулна уу!!!");
            return;
        }
        jsonObj = [];
        $(".txtProductQtt").each(function(){
            if($(this).val() != "" && $(this).val() != "0"){
                item = {}
                item ["productID"] = $(this).attr('foodid');
                item ["normQntt"] = $(this).val();
                item ["normCkal"] = $("#product_kcal" + $(this).attr('foodid')).val();
                jsonObj.push(item);
            }
        });
        $.ajax({
            type: 'post',
            url: $(this).attr("post-url"),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                norms:jsonObj,
                normName:$("#txtNormName").val(),
                sumKcal:$("#hideSumKcal").val()
            },
            success:function(res){
                if(res.status == 'success'){
                    alertify.alert(res.msg);
                    $("#cmbNorms").append(new Option($("#txtNormName").val() + ' /' + $("#hideSumKcal").val() + 'ккал/', res.normID));
                    emtpyAfterPost();
                }
                else if(res.status == 'exist'){
                    alertify.error(res.msg);
                }
                else{
                    alertify.error(res.msg);
                }
            }
        });
        console.log(jsonObj);
    });
});

function emtpyAfterPost(){
    $("#txtNormName").val('');
    $(".txtProductQtt").each(function(){
      $(this).val('');
      $("#product_kcal" + $(this).attr('foodid')).val('0');
      $("#lblKcal" + $(this).attr('foodid')).text('0');
    });
    $("#lblAllKcal").text("0");
    $("#hideSumKcal").val("0");
}
