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
      $("#provName").text(dataRow[3]);
      $("#symName").text(dataRow[4]);

      var i=5;
      $(".cattleQnttFields").each(function(){
        $(this).val(dataRow[i]);
        var qntt = dataRow[i];
        var toSheep = $(this).attr("ratio");
        $("#sheep"+$(this).attr("id")).text((toSheep * qntt).toFixed(2));
        var allSheep = parseFloat($("#sheep"+$(this).attr("id")).text());
        $("#sheepKg"+$(this).attr("id")).text((allSheep * 18.7).toFixed(2));
        i++;
      });
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

  $.ajax({
    type:'post',
    url:cattleQnttNew,
    data:{
      _token: $('meta[name="csrf-token"]').attr('content'),
      provID: dataRow[1],
      symID: dataRow[2],
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
          console.log(response.msg);
          alertify.error(response.msg);
        }
    }
  });
}
