$(document).ready(function(){
  $("#btnShowSpentModal").click(function(e){
    var symCode = $("#cmbSym").val();

    e.preventDefault();
    $("#cmbProv").removeClass("is-invalid");
    $("#cmbSym").removeClass("is-invalid");
    if(symCode == null || symCode == "-1"){
        $("#cmbProv").addClass("is-invalid");
        $("#cmbSym").addClass("is-invalid");
        alertify.error('Та зарцуулалт оруулах аймаг, сумаа сонгоно уу!!!');
        return;
    }

    $("#provName").text($("#cmbProv option:selected").text() + " аймгийн ");
    $("#symName").text($("#cmbSym option:selected").text() + " сумын ");

    $.ajax({
      type: "post",
      url: $(this).attr("urlProducts"),
      data: {
        symCode: symCode,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(res){
        $.each(res, function(key, val)
        {
          $("#totalRemain"+val.id).html(val.mainQntt);
          $("#totalKcal"+val.id).html(parseInt(val.totalKcal).toLocaleString());
          var fat = (val.foodFat * val.mainQntt)/val.foodQntt;
          var protein = (val.foodProtein * val.mainQntt)/val.foodQntt;
          var carbon = (val.foodCarbon * val.mainQntt)/val.foodQntt;
          $("#fat"+val.id).html(parseInt(fat).toLocaleString());
          $("#protein"+val.id).html(parseInt(protein).toLocaleString());
          $("#carbon"+val.id).html(parseInt(carbon).toLocaleString());
          $("#tomKcal"+val.id).html(parseInt(val.foodTomCkal).toLocaleString());
          $("#foodQntt"+val.id).html(val.foodQntt.toLocaleString());
        });
      }
    });

    $("#modalLogSpent").modal("show");
  });

  $("#btnDeleteSpent").click(function(e){

    if(dataRow == "")
    {
      alertify.error("Та устгах МӨР өө сонгоно уу.");
      return;
    }
    var date = dataRow['date'];

    $.ajax({
      type: "post",
      url: $(this).attr("deleteSpentUrl"),
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        symCode: $("#cmbSym").val(),
        provCode: $("#cmbProv").val(),
        dangerID: $("#cmbSym option:selected").attr('dangerid'),
        date: date
      },
      success: function(res){
        refresh($("#cmbSym").val(), $("#cmbSym option:selected").attr('dangerid'));
        alertify.alert(res);
        dataRow = "";
      }
    });
  });
});

$(document).on("keyup", ".spentInput", function(){
  var prodID = $(this).attr("prodID");
  var remain = $("#totalRemain"+prodID).html();
  $("#remainingLbl"+prodID).text(remain - $(this).val());
  var usedKcal = ($("#tomKcal"+$(this).attr('prodID')).html() * $(this).val()) / $("#foodQntt"+$(this).attr('prodID')).html() ;
  $("#usedKcal"+$(this).attr('prodID')).html(parseInt(usedKcal).toLocaleString());
});

$(document).on("click", ".accordion", function(){

  this.classList.toggle("active");
  var panel = this.nextElementSibling;

  // if($(this).hasClass('active'))
  //   $(this).next().css({'border':'1px solid', 'border-radius': '5px'});
  // else
  //   $(this).next().css('border','none');

  if (panel.style.maxHeight) {
    panel.style.maxHeight = null;
  } else {
    panel.style.maxHeight = panel.scrollHeight + "px";
  }

});
$(document).ready(function(){
  $("#btnInsertSpent").click(function(){

    if($("#spentDate").val() == "")
    {
      alertify.error('Та зарцуулалт оруулсан огноог оруулна уу!!!');
      return;
    }
    $(".cattleQnttFields").removeClass("is-invalid");
    $("#dateOgnoo").removeClass("is-invalid");

    jsonObj = [];
    $(".spentInput").each(function(){
        if($(this).val() != "" ){
            item = {}
            item ["prodID"] = $(this).attr('prodID');
            item ["usedQntt"] = $(this).val();
            item["remainingQntt"] = $("#totalRemain"+$(this).attr('prodID')).html() - $(this).val();

            var usedKcal = parseFloat($("#usedKcal"+$(this).attr('prodID')).html().replace(/,/g, ''));
            item["usedKcal"] = usedKcal;

            var totalKcal = parseFloat($("#totalKcal"+$(this).attr('prodID')).html().replace(/,/g, ''));
            item["remainingTotalKcal"] = totalKcal - usedKcal;
            jsonObj.push(item);
        }
    });
    // console.log(jsonObj);

    $.ajax({
      type: "post",
      url: $(this).attr("inserSpentUrl"),
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        insertData: jsonObj,
        symCode: $("#cmbSym").val(),
        provCode: $("#cmbProv").val(),
        dangerID: $("#cmbSym option:selected").attr('dangerid'),
        date: $("#spentDate").val()
      },
      success: function(res){
        $("#dateOgnoo").val('');
        $(".spentInput").each(function(){
          $(this).val('');
        });
        alertify.alert(res);
        refresh($("#cmbSym").val(), $("#cmbSym option:selected").attr('dangerid'));
        $("#modalLogSpent").modal("hide");
      }

    });
  });







});
