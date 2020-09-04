$(document).on("click", '#btnDeclareDangerModal', function(event) {
        if($("#cmbDangerType").val() == "-1"){
            alertify.error("Дайчилгаа зарлах төрлөө зарлана уу!!!");
            $("#frmDeclareDangerByBus #txtPassword").removeClass('border border-danger');
            return;
        }

        $('#frmDeclareDangerByBus')[0].reset();
        $('#frmDeclareDangerByProvince')[0].reset();
        $("#frmDeclareDangerByProvince #divProvs").html('');
        $("#frmDeclareDangerBySum #divChoosedProvs").html('');
        $('#frmDeclareDangerBySum')[0].reset();
        $("#frmDeclareDangerBySum #divSums").html('');
        $("#frmDeclareDangerBySum #divChoosedSumduud").html('');

        $('#modalDeclareDanger form').hide();
        if($("#cmbDangerType").val() == "1"){
            $('#modalDeclareDanger').modal('show');
            $("#frmDeclareDangerByBus").show();
            return;
        }
        if($("#cmbDangerType").val() == "2"){
            $('#modalDeclareDanger').modal('show');
            $("#frmDeclareDangerByProvince").show();
            $("#frmDeclareDangerByProvince #cmbBus").removeClass('border border-danger');
            $("#frmDeclareDangerByProvince #txtPassword").removeClass('border border-danger');
            return;
        }
        if($("#cmbDangerType").val() == "3"){
            $('#modalDeclareDanger').modal('show');
            $("#frmDeclareDangerBySum #hide").show();
            $("#frmDeclareDangerBySum").show();
            $("#frmDeclareDangerBySum #cmbBus").removeClass('border border-danger');
            $("#frmDeclareDangerBySum #cmbProvs").removeClass('border border-danger');
            $("#frmDeclareDangerBySum #txtPassword").removeClass('border border-danger');
            return;
        }
});


// Аймгаар онц байдал зарлах хэсгийн бүс combobox сонгох үед тухайн бүсийн аймаг combobox-д fill хийх хэсэг
$(document).ready(function(){
    $("#frmDeclareDangerByProvince #cmbBus").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                bus:$(this).val()
            },
            success:function(res){
                var table = jQuery.parseJSON(res);
                var div="";
                $.each(table, function(index, item){
                    div = div + '<div class="col-md-4">';
                    div = div + '<div class="form-check">';
                    div = div + '<label class="form-check-label">';
                    div = div + '<input type="checkbox" id="checkProv' + item.id + '" provName="' + item.provName + '" class="form-check-input provs" name="provs[]" value="' + item.id + '">' + item.provName;
                    div = div + '</label></div></div>';
                });
                $("#frmDeclareDangerByProvince #divProvs").html('');
                $("#frmDeclareDangerByProvince #divProvs").html(div);
            }
        });
    });
});
// Аймгаар онц байдал зарлах хэсгийн бүс combobox сонгох үед тухайн бүсийн аймаг combobox-д fill хийх хэсэг


// START аймгаар онц байдал зарлах хэсгийн аймаг сонгох үед сонгосон аймгийг button хэлбэрээр харуулах хэсэг
$(document).on("click", "#frmDeclareDangerByProvince .provs", function(){
    if ($(this).prop('checked')) {
        $("#divChoosedProvs").append('<a href="#" id="atag' + $(this).val() + '" provID="' + $(this).val() + '" class="badge badge-info choosedProv">' + $(this).attr("provName") + '<i class="fas fa-times mx-1"></i></a>&nbsp;');
    }
    else{
        $("#atag" + $(this).val()).remove();
    }
});
// END аймгаар онц байдал зарлах хэсгийн аймаг сонгох үед сонгосон аймгийг button хэлбэрээр харуулах хэсэг


// START songogdson aimguud button helbereer garahad teriig darahad remove hiih heseg
$(document).on("click", "#frmDeclareDangerByProvince #divChoosedProvs a", function(){
    $("#checkProv" + $(this).attr("provID")).prop("checked", false);
    $(this).remove();
});
// END songogdson aimguud button helbereer garahad teriig darahad remove hiih heseg


// Сумаар онц байдал зарлах хэсгийн бүс сонгох үед тухайн бүсийн аймгуудыг сонгох хэлбэрээр харуулах хэсэг
$(document).ready(function(){
    $("#frmDeclareDangerBySum #cmbBus").change(function(){
        $.ajax({
            type:"post",
            url:$(this).attr('post-url'),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                bus:$(this).val()
            },
            success:function(res){
                $("#frmDeclareDangerBySum #cmbProvs option").remove();
                var table = jQuery.parseJSON(res);
                var div="";
                $("#frmDeclareDangerBySum #cmbProvs").append('<option value="-1">Сонгоно уу</option>');
                $.each(table, function(index, item){
                    $("#frmDeclareDangerBySum #cmbProvs").append('<option value="' + item.id + '"> ' + item.provName + ' </option>');
                });
            }
        });
    });
});
// Сумаар онц байдал зарлах хэсгийн бүс сонгох үед тухайн бүсийн аймгуудыг сонгох хэлбэрээр харуулах хэсэг


// Сумаар онц байдал зарлах хэсгийн аймаг сонгох үед тухайн аймгийн сумдуудыг сонгох хэлбэрээр харуулах хэсэг
$(document).ready(function(){
    $("#frmDeclareDangerBySum #cmbProvs").change(function(){
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
                $("#frmDeclareDangerBySum #divSums").html('');
                $("#frmDeclareDangerBySum #divSums").html(div);
            }
        });
    });
});
// Сумаар онц байдал зарлах хэсгийн аймаг сонгох үед тухайн аймгийн сумдуудыг сонгох хэлбэрээр харуулах хэсэг


// START sumaar onts baidal zarlah hesgiin sum deer click hiihed door check hiisen sumdiig button hesgeer nemj haruulna
$(document).on("click", "#frmDeclareDangerBySum .sumduud", function(){
    if ($(this).prop('checked')) {
        $("#divChoosedSumduud").append('<a href="#" id="atag' + $(this).val() + '" sumID="' + $(this).val() + '" class="badge badge-info choosedSum">' + $(this).attr("sumName") + '<i class="fas fa-times mx-1"></i></a>&nbsp;');
    }
    else{
        $("#atag" + $(this).val()).remove();
    }
});
// END sumaar onts baidal zarlah hesgiin sum deer click hiihed door check hiisen sumdiig button hesgeer nemj haruulna


// START songogdson sumduud button helbereer garahad teriig darahad remove hiih heseg
$(document).on("click", "#frmDeclareDangerBySum #divChoosedSumduud a", function(){
    $("#check" + $(this).attr("sumID")).prop("checked", false);
    $(this).remove();
});
// END songogdson sumduud button helbereer garahad teriig darahad remove hiih heseg


//START Sumaar onts baidal zarlah heseg
$(document).ready(function(){
    $("#btnDeclareDangerSum").click(function(e){
        e.preventDefault();
        $("#frmDeclareDangerBySum #cmbBus").removeClass('border border-danger');
        $("#frmDeclareDangerBySum #cmbProvs").removeClass('border border-danger');
        $("#frmDeclareDangerBySum #txtPassword").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #txtCommandNumber").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #dateDeclareDate").removeClass('border border-danger');
        if($("#frmDeclareDangerBySum #cmbBus").val() == "-1"){
            alertify.error("Та бүсээ сонгоно уу!!!");
            $("#frmDeclareDangerBySum #cmbBus").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerBySum #cmbProvs").val() == "-1"){
            alertify.error("Та бүсээ сонгоно уу!!!");
            $("#frmDeclareDangerBySum #cmbProvs").addClass('border border-danger');
            return;
        }
        //START sum songoogui bol aldaa zaah heseg
        if($("#frmDeclareDangerBySum .choosedSum").length == 0){
            alertify.error("Та сум дүүргээ сонгоно уу!!!");
            return;
        }
        //END sum songoogui bol aldaa zaah heseg
        if($("#frmDeclareDangerBySum #txtCommandNumber").val() == ""){
            alertify.error("Та тушаалын дугаараа оруулна уу!!!");
            $("#frmDeclareDangerByBus #txtCommandNumber").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerBySum #dateDeclareDate").val() == ""){
            alertify.error("Та эхлэх огноогоо оруулна уу!!!");
            $("#frmDeclareDangerByBus #dateDeclareDate").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerBySum #txtPassword").val() == ""){
            alertify.error("Та нууц үгээ оруулна уу!!!");
            $("#frmDeclareDangerBySum #txtPassword").addClass('border border-danger');
            return;
        }

        // zarlah button arilgaad orond n unshij baigaa zurag haruulj baina
        $("#btnDeclareDangerSum").hide();
        $("#frmDeclareDangerBySum #divLoading").removeClass("d-none");
        // zarlah button arilgaad orond n unshij baigaa zurag haruulj baina

        jsonChoosedSumduud = [];
        $.each($("#frmDeclareDangerBySum .choosedSum"), function(key, value){
            item = {};
            item["sumID"] = $(this).attr("sumid");
            jsonChoosedSumduud.push(item);
        });

        $.ajax({
            type: "post",
            url: $("#btnDeclareDangerSum").attr("post-url"),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                commandNumber:$("#frmDeclareDangerBySum #txtCommandNumber").val(),
                declareDate:$("#frmDeclareDangerBySum #dateDeclareDate").val(),
                comment:$("#frmDeclareDangerBySum #areaComment").val(),
                sector:$("#frmDeclareDangerBySum #cmbBus").val(),
                province:$("#frmDeclareDangerBySum #cmbProvs").val(),
                sums:jsonChoosedSumduud,
                password:$("#frmDeclareDangerBySum #txtPassword").val()
            },
            success:function(res){
                $("#btnDeclareDangerSum").show();
                $("#frmDeclareDangerBySum #divLoading").addClass("d-none");
                if(res.status == "error"){
                    alertify.error(res.msg);
                }
                else{
                    $('#frmDeclareDangerBySum')[0].reset(); //ene formiin buh ugugduliig hoosloj baina
                    $('#modalDeclareDanger').modal('toggle');
                    alertify.alert(res.msg);
                }
            },
            error: function (jqXHR, exception) {
                $("#btnDeclareDangerSum").show();
                $("#frmDeclareDangerBySum #divLoading").addClass("d-none");
                alertify.error("Алдаа гарлаа дахин оролдоно уу!!!");
            }
        });
    });
});
//END Sumaar onts baidal zarlah heseg


//START Aimgaar onts baidal zarlah heseg
$(document).ready(function(){
    $("#btnDeclareDangerProvince").click(function(e){
        e.preventDefault();
        // buh ulaan hureeg arilgaj baina
        $("#frmDeclareDangerByProvince #cmbBus").removeClass('border border-danger');
        $("#frmDeclareDangerByProvince #txtPassword").removeClass('border border-danger');
        $("#frmDeclareDangerByProvince #txtCommandNumber").removeClass('border border-danger');
        $("#frmDeclareDangerByProvince #dateDeclareDate").removeClass('border border-danger');
        // buh ulaan hureeg arilgaj baina


        if($("#frmDeclareDangerByProvince #cmbBus").val() == "-1"){
            alertify.error("Та бүсээ сонгоно уу!!!");
            $("#frmDeclareDangerByProvince #cmbBus").addClass('border border-danger');
            return;
        }

        //START aimag songoogui bol aldaa zaah heseg
        if($("#frmDeclareDangerByProvince .choosedProv").length == 0){
            alertify.error("Та аймгаа сонгоно уу!!!");
            return;
        }
        //END aimag songoogui bol aldaa zaah heseg
        if($("#frmDeclareDangerByProvince #txtCommandNumber").val() == ""){
            alertify.error("Та тушаалын дугаараа оруулна уу!!!");
            $("#frmDeclareDangerByProvince #txtCommandNumber").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerByProvince #dateDeclareDate").val() == ""){
            alertify.error("Та эхлэх огноогоо оруулна уу!!!");
            $("#frmDeclareDangerByProvince #dateDeclareDate").addClass('border border-danger');
            return;
        }

        if($("#frmDeclareDangerByProvince #txtPassword").val() == ""){
            alertify.error("Та нууц үгээ оруулна уу!!!");
            $("#frmDeclareDangerByProvince #txtPassword").addClass('border border-danger');
            return;
        }

        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina
        $("#btnDeclareDangerProvince").hide();
        $("#frmDeclareDangerByProvince #divLoading").removeClass("d-none");
        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina

        jsonChoosedProvs = [];
        $.each($("#frmDeclareDangerByProvince .choosedProv"), function(key, value){
            item = {};
            item["provID"] = $(this).attr("provid");
            jsonChoosedProvs.push(item);
        });

        $.ajax({
            type: "post",
            url: $("#btnDeclareDangerProvince").attr("post-url"),
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                commandNumber:$("#frmDeclareDangerByProvince #txtCommandNumber").val(),
                declareDate:$("#frmDeclareDangerByProvince #dateDeclareDate").val(),
                comment:$("#frmDeclareDangerByProvince #areaComment").val(),
                sector:$("#frmDeclareDangerByProvince #cmbBus").val(),
                provs:jsonChoosedProvs,
                password:$("#frmDeclareDangerByProvince #txtPassword").val()
            },
            success:function(res){
                $("#btnDeclareDangerProvince").show();
                $("#frmDeclareDangerByProvince #divLoading").addClass("d-none");
                if(res.status == "error"){
                    alertify.error(res.msg);
                }
                else{
                    $('#frmDeclareDangerByProvince')[0].reset(); //ene formiin buh ugugduliig hoosloj baina
                    $('#modalDeclareDanger').modal('toggle');
                    alertify.alert(res.msg);
                }
            },
            error: function (jqXHR, exception) {
                $("#btnDeclareDangerProvince").show();
                $("#frmDeclareDangerByProvince #divLoading").addClass("d-none");
                alertify.error("Алдаа гарлаа дахин оролдоно уу!!!");
            }
        });
    });
});
//END Aimgaar onts baidal zarlah heseg



// Buseer onts baidal zarlah heseg
$(document).ready(function(){
    $("#btnDeclareDangerBus").click(function(e){
        e.preventDefault();
        // buh ulaan hureeg arilgaj baina
        $("#frmDeclareDangerByBus #txtPassword").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #txtCommandNumber").removeClass('border border-danger');
        $("#frmDeclareDangerByBus #dateDeclareDate").removeClass('border border-danger');
        // buh ulaan hureeg arilgaj baina

        // checkboxuud checklesen esehiig shalgaj baina
        var checkCount = 0;
        $("#frmDeclareDangerByBus .sectors").each(function(){
            if($(this).prop('checked')){
                checkCount++;
            }
        });
        if(checkCount == 0){
            alertify.error("Та онц байдал зарлах бүсээ сонгоно уу!!!");
            return;
        }
        // checkboxuud checklesen esehiig shalgaj bainas
        if($("#frmDeclareDangerByBus #txtCommandNumber").val() == ""){
            alertify.error("Та тушаалын дугаараа оруулна уу!!!");
            $("#frmDeclareDangerByBus #txtCommandNumber").addClass('border border-danger');
            return;
        }
        if($("#frmDeclareDangerByBus #dateDeclareDate").val() == ""){
            alertify.error("Та эхлэх огноогоо оруулна уу!!!");
            $("#frmDeclareDangerByBus #dateDeclareDate").addClass('border border-danger');
            return;
        }
        if($("#txtPassword").val()==""){
            alertify.error("Та нууц үгээ оруулна уу!!!");
            $("#frmDeclareDangerByBus #txtPassword").addClass('border border-danger');
            return;
        }

        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina
        $("#btnDeclareDangerBus").hide();
        $("#frmDeclareDangerByBus #divLoading").removeClass("d-none");
        // zarlah button arilgaad orond niit unshij baigaa zurag haruulj baina

        // onts baidal zarlah ajax
        $.ajax({
            type:"post",
            url:$("#btnDeclareDangerBus").attr("post-url"),
            data:$("#frmDeclareDangerByBus").serialize(),
            success:function(res){
                $("#btnDeclareDangerBus").show();
                $("#frmDeclareDangerByBus #divLoading").addClass("d-none");
                if(res.status == "error"){
                    alertify.error(res.msg);
                }
                else{
                    $('#frmDeclareDangerByBus')[0].reset(); //ene formiin buh ugugduliig hoosloj baina
                    $('#modalDeclareDanger').modal('toggle');
                    alertify.alert(res.msg);
                }
            },
            error: function (jqXHR, exception) {
                $("#btnDeclareDangerBus").show();
                $("#frmDeclareDangerByBus #divLoading").addClass("d-none");
                alertify.error("Алдаа гарлаа дахин оролдоно уу!!!");
            }
        });
        // onts baidal zarlah ajax
    });
});
