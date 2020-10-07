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
          //Aimgiin medeelluudiig dood hesegt gargaj bn
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

            div = div + '<table style="text-align:center" class="col-md-12">';

            if(val.isMeat === 1)
            {
              div = div + '<tr style="border-bottom: 1px solid"><td></td><td>Хүнсний нөөц</td><td>Амьд мал</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт үлдсэн /кг/:</td><td>'+val.remaining+'</td><td>'+val.totalCattleKg+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт уураг /гр/:</td><td>'+val.foodProtein+'</td><td>'+parseInt(val.totalCattleProtein)+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт өөх тос /гр/:</td><td>'+val.foodFat+'</td><td>'+val.totalCattleFat+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт нүүрс ус /гр/:</td><td>'+val.foodCarbon+'</td><td>'+val.totalCattleCarbon+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт Ккал /мян.ккал/:</td><td>'+val.Kcal/1000+'</td><td>'+val.totalCattleKcal/1000+'</td></tr>';
            }else {
              div = div + '<tr style="border-bottom: 1px solid" class="col-md-12"><td></td><td>Хүнсний нөөц</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт үлдсэн /кг/:</td><td>'+val.remaining+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт уураг /гр/:</td><td>'+val.foodProtein+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт өөх тос /гр/:</td><td>'+val.foodFat+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт нүүрс ус /гр/:</td><td>'+val.foodCarbon+'</td></tr>';
              div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт Ккал /мян.ккал/:</td><td>'+val.Kcal/1000+'</td></tr>';
            }
            div = div + '</table>';
            div = div + '<div class="col-md-12"><a href="javascript:showSub()">Орлуулах</a> &nbsp&nbsp&nbsp&nbsp ';
            div = div + '<a href="javascript:showSub()">Нормоос хасах</a></div>';
            div = div + '</div>';

            div = div + '</div>';
          });
          $("#bottom").html("");
          $("#bottom").html(div);

          //baruun taliin hunii too maliin toog haruulj bn
          $("#changeName").text( aimagName );
          $("#selectedProvName").text( aimagName );
          $("#totalPop").text( response.rightSide.totalPop );
          $("#standardPop").text( response.rightSide.standardPop );
          $("#totalCattle").text( response.rightSide.totalCattle );
          $("#reserveDay").text( response.rightSide.reserveDay );

          //doughnut chart-iin data-g fill hiij bn
          var data = [];
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

//hunsnii tovchin deer darj oor medeelluudiig harj bn
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
          div = div + '<table style="text-align:center" class="col-md-12">';

          if(val.isMeat === 1)
          {
            div = div + '<tr style="border-bottom: 1px solid"><td></td><td>Хүнсний нөөц</td><td>Амьд мал</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт үлдсэн /кг/:</td><td>'+val.remaining+'</td><td>'+val.totalCattleKg+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт уураг /гр/:</td><td>'+val.foodProtein+'</td><td>'+val.totalCattleProtein+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт өөх тос /гр/:</td><td>'+val.foodFat+'</td><td>'+val.totalCattleFat+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт нүүрс ус /гр/:</td><td>'+val.foodCarbon+'</td><td>'+val.totalCattleCarbon+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт Ккал:</td><td>'+val.Kcal+'</td><td>'+val.totalCattleKcal+'</td></tr>';
          }else {
            div = div + '<tr style="border-bottom: 1px solid" class="col-md-12"><td></td><td>Хүнсний нөөц</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт үлдсэн /кг/:</td><td>'+val.remaining+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт уураг /гр/:</td><td>'+val.foodProtein+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт өөх тос /гр/:</td><td>'+val.foodFat+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт нүүрс ус /гр/:</td><td>'+val.foodCarbon+'</td></tr>';
            div = div + '<tr style="border-bottom: 1px solid"><td style="text-align:left">Нийт Ккал:</td><td>'+val.Kcal+'</td></tr>';
          }
          div = div + '</table>';
          div = div + '<div class="col-md-12"><a href="javascript:showSub()">Орлуулах</a> &nbsp&nbsp&nbsp&nbsp ';
          div = div + '<a href="javascript:showSub()">Нормоос хасах</a></div>';
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
