$(document).ready(function(){
  $('path').on('click', function() {
      $('path.selected').attr("class", "aimag");
      // $('path.selected').attr("class", "syms");
      $(this).attr("class", "selected");
      aimagName = $(this).attr('name');
      provCode = $(this).attr('id');
      //alert(provCode);
      $.ajax({
        type: 'get',
        url: getAimagInfo,
        data: {
            _token: csrf,
            name: aimagName,
            provCode: provCode
        },
        success:function(response){
          //console.log(response);
          var div = "";
          $.each(response.bottomSide, function(key, val){
            div = div + '<div class="form-group row col-md-3">';
            div = div + '<div class="col-md-12" id="productName" style="color:#000">'+val.product+'</div>';
            if(val.leftDays > 2)
              div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays">'+val.leftDays+'</label></div>';
            else {
              div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays" style="color:red;">'+val.leftDays+'</label></div>';
            }
            div = div + '</div>';
          });
          $("#bottom").html("");
          $("#bottom").html(div);

          $("#changeName").text( aimagName );
          $("#selectedProvName").text( aimagName );
          $("#totalPop").text( response.rightSide.totalPop );
          $("#standardPop").text( response.rightSide.standardPop );
          $("#totalCattle").text( response.rightSide.totalCattle );
          $("#reserveDay").text( response.rightSide.reserveDay );

          var data = [];
          // console.log(response);

          $.each(response.totalPop1, function(key, val){
            item = {};
            item["label"] = val.symName;
            item["y"] = val.totalPop;
            // console.log(item);
            data.push(item);
          });

          var options = {
          	animationEnabled: true,

          	data: [{
          		type: "doughnut",
          		innerRadius: "80%",
          		//showInLegend: true,
          		legendText: "{label}",
          		indexLabel: "{label}:",
          		dataPoints: data
          	}]
          };
          $("#chartContainer").CanvasJSChart(options);

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
  });
});
$(document).on("click", "path[data-toggle='tooltip']", function(){
    //alert($(this).attr('id') + 'lol');
    var symName = $(this).attr('name');

    $.ajax({
      type: "get",
      url: getSymInfo,
      data: {
        symCode: $(this).attr('id')
      },
      success:function(response){
        var div = "";
        $.each(response.bottomSide, function(key, val){
          div = div + '<div class="form-group row col-md-3">';
          div = div + '<div class="col-md-12" id="productName">'+val.product+'</div>';
          div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays">'+val.leftDays+'</label></div>';
          div = div + '</div>';
        });
        $("#bottom").html("");
        $("#bottom").html(div);

       $("#changeName").text( symName );

        $("#totalPop").text( response.rightSide.totalPop );
        $("#standardPop").text( response.rightSide.standardPop );
        $("#totalCattle").text( response.rightSide.totalCattle );
        $("#reserveDay").text( response.rightSide.reserveDay );
      }
    });
});
