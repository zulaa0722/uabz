$(document).ready(function(){
    $("#btnEditModalOpen").click(function(){
        if($("#cmbNorms").val() == '-1'){
            alertify.error("Та нормоо сонгоно уу!!!");
        }
        else{
            var table = $("#tableNorms").DataTable();
            table.rows().eq(0).each( function ( index ) {
                var row = table.row( index );

                var data = row.data();
                // console.log(data);
                // alert(data["productName"]);
                $("#editProductID" + data["producID"]).val(data["normQntt"]);
                $("#editProduct_kcal" + data["producID"]).val(data["normCkal"]);
                $("#lblEditKcal" + data["producID"]).text(data["normCkal"]);
            } );
            $("#lblEditNormName").text($("#cmbNorms option:selected").text());
            computeEditAllKcal();
            $("#modalNormEdit").modal("show");
        }
    });
});

function computeEditAllKcal(){
    var sumKcal = 0;
    var currentKcal = 0;
    $(".txtEditProductQtt").each(function(){
        if($(this).val() != "" && $(this).val() != "0"){
            currentKcal = $("#editProduct_kcal" + $(this).attr('foodid')).val();
            sumKcal = parseFloat(sumKcal) + parseFloat(currentKcal);
            $("#lblEditAllKcal").text(sumKcal.toFixed(1));
            $("#hideEditSumKcal").val(sumKcal.toFixed(1));
        }
    });
    var empty = true;
    $('.txtEditProductQtt').each(function(){
       if($(this).val()!=""){
            empty =false;
        }
    });
    if(empty){
        $("#lblEditAllKcal").text("0");
        $("#hideEditSumKcal").val("0");
    }
}

$(document).ready(function(){
    $(".txtEditProductQtt").keyup(function(){
            var qtt = $(this).val();
            var foodQntt = $(this).attr('foodQntt');
            var kcal = $(this).attr('kcal');
            var result = qtt * kcal / foodQntt;
            // alert(qtt);
            $("#editProduct_kcal" + $(this).attr('foodid')).val(result.toFixed(2));
            // $("#lblKcal" + $(this).attr('foodid')).empty();
            $("#lblEditKcal" + $(this).attr('foodid')).text(result.toFixed(2));
            computeEditAllKcal();
    });
});

$(document).ready(function(){
    $("#btnNormEdit").click(function(){
        if($("#hideEditSumKcal").val() == 0){
            alertify.alert("Бүтээгдэхүүний тоо хэмжээ оруулна уу!!!");
            return;
        }
        jsonObj = [];
        $(".txtEditProductQtt").each(function(){
            if($(this).val() != "" && $(this).val() != "0"){
                item = {}
                item ["productID"] = $(this).attr('foodid');
                item ["normQntt"] = $(this).val();
                item ["normCkal"] = $("#editProduct_kcal" + $(this).attr('foodid')).val();
                jsonObj.push(item);
            }
        });

        $.ajax({
            type: 'post',
            url: $(this).attr("post-url"),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                norms:jsonObj,
                normID:$("#cmbNorms").val(),
                sumKcal:$("#hideEditSumKcal").val()
            },
            success:function(res){
                if(res.status == 'success'){
                    alertify.alert(res.msg);
                    var splArray = $("#cmbNorms option:selected").text().split(" ");
                    var normName = splArray[0];
                    $("#cmbNorms").find('option:selected').text(normName + " /" + $("#hideEditSumKcal").val() + "/");
                    // $("#cmbNorms").append(new Option($("#txtNormName").val() + ' /' + $("#hideSumKcal").val() + 'ккал/', res.normID));
                    emtpyAfterPostEdit();
                    refreshNormsTable();
                    $('#modalNormEdit').modal('toggle');
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

function emtpyAfterPostEdit(){
    $(".txtProductQtt").each(function(){
      $(this).val('');
      $("#editProduct_kcal" + $(this).attr('foodid')).val('0');
      $("#lblEditKcal" + $(this).attr('foodid')).text('0');
    });
    $("#lblEditAllKcal").text("0");
    $("#hideEditSumKcal").val("0");
}
