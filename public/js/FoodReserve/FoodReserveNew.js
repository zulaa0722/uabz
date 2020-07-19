$(document).ready(function(){
  $("#btnAddModalOpen").click(function(){

    if(dataRow == "")
    {
      alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
      return;
    }

      $("#modalFoodReserveNew").modal("show");
      $("#provName").text(dataRow[3]);
      $("#symName").text(dataRow[4]);

    var i=5;
    $(".foodProductFields").each(function(){
      $(this).val(dataRow[i]);
      i++;
    });

  });

  // $("#provName").change(function(){
  //   $("#symName option[value!='-1']").each(function(){
  //     $(this).remove();
  //   })
  //   $.ajax({
  //     type: "post",
  //     url: $("#provName").attr("getSymUrl"),
  //     data: {
  //       _token: $('meta[name="csrf-token"]').attr('content'),
  //       provID: $("#provName").val()
  //     },
  //     success:function(response){
  //       $.each(response, function (value, index ) {
  //          var o = new Option(index['symName'], index['id']);  // Option(name, val)
  //          $("#symName").append(o);
  //       });
  //     }
  //   });
  // });

  $("#btnFoodReserveAdd").click(function(e){
        e.preventDefault();
        mainCode();
  });

  function mainCode()
  {
    // if($("#provName").val() == -1){ alertify.error("Аймаг сонгоно уу!"); return;}
    // if($("#symName").val() == -1){ alertify.error("Сум сонгоно уу!"); return;}
    if($("#foodReserveDate").val() == ""){ alertify.error("Огноог оруулна уу!"); return;}
    var isEmpty = true;

    $(".foodProductFields").each(function(){
      if($(".foodProductFields").val() == "")
        isEmpty = true;
      else
        isEmpty = false;
    });

    if(isEmpty == true){ alertify.error("Та нөөцийн тоо хэмжээг оруулна уу!"); return; }

    jsonObj = [];
    $(".foodProductFields").each(function(){
        if($(this).val() != "" ){
            item = {}
            item ["productID"] = $(this).attr('id');
            item ["foodQntt"] = $(this).val();
            jsonObj.push(item);
        }
    });

    $.ajax({
      type:'post',
      url:foodReserveNewUrl,
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: $("#provName").val(),
        symID: $("#symName").val(),
        reserveDate: $("#foodReserveDate").val(),
        qntt: jsonObj
      },
      success:function(response){
          if(response.status == 'success'){
            var table = $("#FoodReserveTable").DataTable();
            last_row = table.row(':last').data();

            var rowData = [];
            rowData[0] = parseInt(last_row[0])+1;
            rowData[1] = $("#provName").val();
            rowData[2] = $("#symName").val();
            rowData[3] = $('#provName option:selected').text();
            rowData[4] = $('#symName option:selected').text();
            var index = 5;
            $(".foodProductFields").each(function(){
              rowData[index] = $(this).val();
              index++;
            });
            table.row.add( rowData ).draw( false );
            alertify.alert(response.msg);
          }
          else{
            alertify.error(response.msg);
          }



          // FoodProductsTableRefresh();
          // emptyForm();
          // dataRow = "";
      },
      error: function(jqXhr, json, errorThrown){// this are default for ajax errors
        var errors = jqXhr.responseJSON;
        var errorsHtml = '';
        $.each(errors['errors'], function (index, value) {
            errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
        });
        alert(errorsHtml);
      }
    });
  }



});
