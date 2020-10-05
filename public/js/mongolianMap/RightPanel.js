$(document).ready(function(){
  $('path').on('click', function() {
      $('path.selected').attr("class", "aimag");
      // $('path.selected').attr("class", "syms");
      $(this).attr("class", "selected");
      aimagName = $(this).attr('name');
      provCode = $(this).attr('id');
      $("#titleOfremainingDays").css('display', 'block');
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
            div = div + '<div class="form-group row col-md-3" style="margin-right: 2px;">';
            div = div + '<button class="accordion col-md-12" style="cursor:default;"><div class="col-md-12"><label id="productName">'+val.product+'</label></div>';
            if(val.leftDays > 2)
	          //div = div + '<label style="color:red;">Section 2321</label>'
              div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays">'+val.leftDays+'</label></div>';
            else {
              div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays" style="color:red;">'+val.leftDays+'</label></div>';
            }
            div = div + '</button>';
            div = div + '<div class="panel col-md-12" style="padding: 0px;">';
            div = div + '<div class="col-md-12" style="float:left;"><label>Нийт үлдсэн /кг/:&nbsp&nbsp&nbsp&nbsp</label>';
            div = div + '<label id="remaining">'+val.remaining+'</label></div>';
            div = div + '<button><label>Орлуулах</label></button>';
            div = div + '</div>';

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
$(document).on("click", "path[data-toggle='tooltip']", function(){
    //alert($(this).attr('id') + 'lol');
    var symName = $(this).attr('name');
    $("#titleOfremainingDays").css('display', 'block');

    $.ajax({
      type: "get",
      url: getSymInfo,
      data: {
        symCode: $(this).attr('id')
      },
      success:function(response){
        var div = "";
        $.each(response.bottomSide, function(key, val){
          div = div + '<div class="form-group row col-md-3" style="margin-right: 2px;">';
          div = div + '<button class="accordion col-md-12" style="cursor:default;"><div class="col-md-12"><label id="productName">'+val.product+'</label></div>';
          if(val.leftDays > 2)
          //div = div + '<label style="color:red;">Section 2321</label>'
            div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays">'+val.leftDays+'</label></div>';
          else {
            div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays" style="color:red;">'+val.leftDays+'</label></div>';
          }
          div = div + '</button>';
          div = div + '<div class="panel col-md-12" style="padding: 0px;">';
          div = div + '<div class="col-md-12" style="float:left;"><label>Нийт үлдсэн /кг/:&nbsp&nbsp&nbsp&nbsp</label>';
          div = div + '<label id="remaining">'+val.remaining+'</label></div>';
          div = div + '</div>';

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
