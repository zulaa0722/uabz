// Онц байдал засах зориулалттай modal-ийг харуулах button click event
$(document).ready(function(){
    $("#btnOpenEditDangerModal").click(function(){
        if(dataRow == ""){
            alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
            return;
        }
        // хадгалсан сумдын мэдээллийг d_id аар нь аваад сонгогдсон сумдууд хэсэг дээр button хэлбэрээр харуулах хэсэг
        $.ajax({
            type:"post",
            url:$(this).attr("get-sums-url"),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                id:dataRow["id"]
            },
            success:function(res){
                var table = jQuery.parseJSON(res);
                console.log("table");
                console.log(table);
                var div="";
                $.each(table, function(index, item){
                    div = div + '<a href="#" id="atag' + item.symID + '" sumID="' + item.symID + '" class="badge badge-info choosedSum">' + item.symName + '<i class="fas fa-times mx-1"></i></a>&nbsp;';
                });
                $("#divChoosedSumduud").html('');
                $("#divChoosedSumduud").html(div);
            }
        });
        // хадгалсан сумдын мэдээллийг d_id аар нь аваад сонгогдсон сумдууд хэсэг дээр button хэлбэрээр харуулах хэсэг
        $("#txtCommandNumber").val(dataRow["commandNumber"]);
        $("#dateDeclareDate").val(dataRow["declareDate"]);
        $("#areaComment").val(dataRow["comment"]);
        $("#modalDangerEdit").modal("show");
    });
});
// Онц байдал засах зориулалттай modal-ийг харуулах button click event


// Бүс combobox сонгох үед аймаг combobox-ийг fill хийж байна
$(document).ready(function(){
    $("#cmbBus").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                bus:$(this).val()
            },
            success:function(res){
                var table = jQuery.parseJSON(res);
                $.each(table, function(index, item){
                    $("#cmbProvs").append('<option value="' + item.id + '"> ' + item.provName + ' </option>');
                });
            }
        });
    });
});
// Бүс combobox сонгох үед аймаг combobox-ийг fill хийж байна


//тухайн аймгийн сумдуудыг сонгох хэлбэрээр харуулах хэсэг
$(document).ready(function(){
    $("#cmbProvs").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                provID:$(this).val()
            },
            success:function(res){
                var table = jQuery.parseJSON(res);
                console.log(table);
                var div="";
                $.each(table, function(index, item){
                    div = div + '<div class="col-md-4">';
                    div = div + '<div class="form-check">';
                    div = div + '<label class="form-check-label">';
                    div = div + '<input type="checkbox" id="check' + item.symCode + '" sumName="' + item.symName + '" name="sums[]" class="form-check-input sumduud" value="' + item.symCode + '">' + item.symName;
                    div = div + '</label></div></div>';
                });
                $("#divSums").html('');
                $("#divSums").html(div);
            }
        });
    });
});
//тухайн аймгийн сумдуудыг сонгох хэлбэрээр харуулах хэсэг


// START sum deer click hiihed door check hiisen sumdiig button hesgeer nemj haruulna
$(document).on("click", ".sumduud", function(){
    if ($(this).prop('checked')) {
        $("#divChoosedSumduud").append('<a href="#" id="atag' + $(this).val() + '" sumID="' + $(this).val() + '" class="badge badge-info choosedSum">' + $(this).attr("sumName") + '<i class="fas fa-times mx-1"></i></a>&nbsp;');
    }
    else{
        $("#atag" + $(this).val()).remove();
    }
});
// END sum deer click hiihed door check hiisen sumdiig button hesgeer nemj haruulna


// START songogdson sumduud button helbereer garahad teriig darahad remove hiih heseg
$(document).on("click", "#divChoosedSumduud a", function(){
    $("#check" + $(this).attr("sumID")).prop("checked", false);
    $(this).remove();
});
// END songogdson sumduud button helbereer garahad teriig darahad remove hiih heseg
