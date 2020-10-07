$(document).ready(function(){
    $("#btnAddModalOpen").click(function(){
      $(".cattleQnttFields").keyup(function(){
        var qntt = $(this).val();
        var toSheep = $(this).attr("ratio");
        $("#sheep"+$(this).attr("id")).text((toSheep * qntt).toFixed(2));
        var allSheep = parseFloat($("#sheep"+$(this).attr("id")).text());
        $("#sheepKg"+$(this).attr("id")).text((allSheep * 18.7).toFixed(2));
      });

      if(dataRow == "")
      {
        alertify.error('Та НЭМЭХ мөрөө сонгоно уу!!!');
        return;
      }

      $("#modalCattleQnttNew").modal("show");
      $("#provName").text(dataRow["provName"]);
      $("#symName").text(dataRow["sumName"]);
      $("#lblYear").text(year);


      $("#1").val(dataRow["sheep"]);
      var qntt = dataRow["sheep"];
      var toSheep = $("#1").attr("ratio");
      $("#sheep1").text((toSheep * qntt).toFixed(2));
      var allSheep = parseFloat($("#sheep1").text());
      $("#sheepKg1").text((allSheep * 18.7).toFixed(2));


      $("#2").val(dataRow["goat"]);
      qntt = dataRow["goat"];
      toSheep = $("#2").attr("ratio");
      $("#sheep2").text((toSheep * qntt).toFixed(2));
      allSheep = parseFloat($("#sheep2").text());
      $("#sheepKg2").text((allSheep * 18.7).toFixed(2));


      $("#3").val(dataRow["cattle"]);
      qntt = dataRow["cattle"];
      toSheep = $("#3").attr("ratio");
      $("#sheep3").text((toSheep * qntt).toFixed(2));
      allSheep = parseFloat($("#sheep3").text());
      $("#sheepKg3").text((allSheep * 18.7).toFixed(2));


      $("#4").val(dataRow["horse"]);
      qntt = dataRow["horse"];
      toSheep = $("#4").attr("ratio");
      $("#sheep4").text((toSheep * qntt).toFixed(2));
      allSheep = parseFloat($("#sheep4").text());
      $("#sheepKg4").text((allSheep * 18.7).toFixed(2));


      $("#5").val(dataRow["camel"]);
      qntt = dataRow["camel"];
      toSheep = $("#5").attr("ratio");
      $("#sheep5").text((toSheep * qntt).toFixed(2));
      allSheep = parseFloat($("#sheep5").text());
      $("#sheepKg5").text((allSheep * 18.7).toFixed(2));
    });

    $("#btnCattleQnttAdd").click(function(e){
        e.preventDefault();
        mainCode();
    });

});

function mainCode()
{
  var isEmpty = 0;
  $(".cattleQnttFields").each(function(){
    if($(this).val() != "")
    {
      isEmpty++;
    }
  });
  if(isEmpty == 0){ alertify.error("Та малын тоо толгойг оруулна уу!"); return; }

  jsonObj = [];
  $(".cattleQnttFields").each(function(){
      if($(this).val() != "" ){
          item = {}
          item ["cattleID"] = $(this).attr('id');
          item ["cattleQntt"] = $(this).val();
          item ["toSheepQntt"] = $("#sheep"+$(this).attr('id')).text();
          item ["toSheepKg"] = $("#sheepKg"+$(this).attr('id')).text();
          jsonObj.push(item);
      }
  });

  // console.log(jsonObj);
  // return;

  $.ajax({
    type:'post',
    url:cattleQnttNew,
    data:{
      _token: $('meta[name="csrf-token"]').attr('content'),
      provID: dataRow["provID"],
      symID: dataRow["sumID"],
      year:year,
      qntt: jsonObj
    },
    success:function(response){
        if(response.status == 'success'){

          var table = $("#cattleQnttDB").DataTable();

          var rowData = [];
          var index = 0;
          $(".cattleQnttFields").each(function(){
            rowData[index] = $(this).val();
            index++;
          });

          //songogdson moriin nudnii utgiig oorchilj bn
          table.rows({ selected: true })
          .every(function (rowIdx, tableLoop, rowLoop){
            for(var i=0; i<index; i++)
              table.cell(rowIdx, i+5).data(rowData[i]);
          }).draw();

          $("#modalCattleQnttNew").modal("hide");
          alertify.alert(response.msg);
        }
        else{
          alertify.error(response.msg);
        }
    }
  });
}
