$(document).ready(function(){
  $("#btnAddModalOpen").click(function(){

    if(dataRow == "")
    {
      alertify.error('Та ЗАСАХ мөрөө дарж сонгоно уу!!!');
      return;
    }

    $(".foodProductFields").keyup(function(){

      var qntt = $(this).val();
      var foodQntt = $(this).attr("foodQntt");
      var foodKcal = $(this).attr("foodKcal");
      var foodTotalKcal = qntt*1000*foodKcal/foodQntt;
      $("#foodTotalKcal"+$(this).attr("id")).text(foodTotalKcal.toFixed(2) + " Ккал");
    });

    $("#modalFoodReserveNew").modal("show");
    $("#provName").text(dataRow[3]);
    $("#symName").text(dataRow[4]);
// console.log(parseFloat(dataRow[6]));
    var i=6;
    $(".foodProductFields").each(function(){
      if($(this).val != "")
        $(this).val(parseFloat(dataRow[i]));
        var qntt = parseFloat(dataRow[i]);
        var foodQntt = $(this).attr("foodQntt");
        var foodKcal = $(this).attr("foodKcal");
        var foodTotalKcal = qntt*1000*foodKcal/foodQntt;
        $("#foodTotalKcal"+$(this).attr("id")).text(foodTotalKcal.toFixed(2) + " Ккал");
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
    if($("#foodReserveDate").val() == ""){ alertify.error("Огноог оруулна уу!"); return;}
    var isEmpty = 0;

    $(".foodProductFields").each(function(){
      if($(this).val() != "")
      {
        isEmpty++;
      }
    });
    if(isEmpty == 0){ alertify.error("Та нөөцийн тоо хэмжээг оруулна уу!"); return; }

    jsonObj = [];
    $(".foodProductFields").each(function(){
        if($(this).val() != "" ){
            item = {}
            item ["productID"] = $(this).attr('id');
            item ["foodQntt"] = $(this).val();
            item ["totalKcal"] = $("#foodTotalKcal"+$(this).attr('id')).text();
            // if(item ["totalKcal"] == "NaN")

            jsonObj.push(item);
        }
    });

    $.ajax({
      type:'post',
      url:foodReserveNewUrl,
      data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        provID: dataRow[1],
        symID: dataRow[2],
        reserveDate: $("#foodReserveDate").val(),
        qntt: jsonObj
      },
      success:function(response){
          if(response.status == 'success'){

            var table = $("#FoodReserveTable").DataTable();

            var rowData = [];
            var index = 0;
            $(".foodProductFields").each(function(){
              rowData[index] = $(this).val();
              index++;
            });

            //songogdson moriin nudnii utgiig oorchilj bn
            table.rows({ selected: true })
            .every(function (rowIdx, tableLoop, rowLoop){
              for(var i=0; i<index; i++)
                table.cell(rowIdx, i+6).data(rowData[i]);
            }).draw();

//             var table = $("#FoodReserveTable").DataTable().rows({ selected: true }).every(function (rowIdx, tableLoop, rowLoop) {
// table.row(this).cell(rowIdx,2).data("").draw()
// table.row(this).cell(rowIdx, 3).data("").draw()
// });
            // var table = $("#FoodReserveTable").DataTable();
            // last_row = table.row(':last').data();
            //
            // var rowData = [];
            // rowData[0] = parseInt(last_row[0])+1;
            // rowData[1] = $("#provName").val();
            // rowData[2] = $("#symName").val();
            // rowData[3] = $('#provName option:selected').text();
            // rowData[4] = $('#symName option:selected').text();
            // var index = 5;
            // $(".foodProductFields").each(function(){
            //   rowData[index] = $(this).val();
            //   index++;
            // });
            // table.row.add( rowData ).draw( false );
            $("#modalFoodReserveNew").modal("hide");
            alertify.alert(response.msg);
          }
          else{
            // alertify.error(response.msg);
            console.log(response.msg);
          }



          // FoodProductsTableRefresh();
          // emptyForm();
          // dataRow = "";
      }
    });
  }
});
