$(document).ready(function(){

  $("#computeTable").click(function(e){
    e.preventDefault();
    $("#chartPop").addClass("d-none");
    $("#reportTable").removeClass("d-none");
  });

  $("#pop").click(function(e){
    e.preventDefault();
    $("#reportTable").addClass("d-none")
    $("#chartPop").removeClass("d-none");

    $.ajax({
      type: 'get',
      url: $(this).attr('href'),
      data: "pop",
      success: function(response){
        // console.log(response);

        var totalPop=[];
        var standardPop=[];

        $.each(response, function(key, val){
          item = {};
          var s = parseInt(val.totalPop);
          s=(s/1000);
          item["label"] = val.date;
          item["y"] = parseFloat(s.toFixed(2));
          totalPop.push(item);

          item1 = {};
          var a = parseInt(val.standardPop);
          a = (a/1000);
          item1["label"] = val.date;
          item1["y"] = parseFloat(a.toFixed(2));
          standardPop.push(item1);
        });
        console.log(totalPop);
        console.log(standardPop);
        var chart = new CanvasJS.Chart("chartPop", {
          	animationEnabled: true,
          	title:{
          		text: "Монгол Улсын хvн амын тоо /мянган хvнээр/"
          	},
          	axisY: {
          		title: "",
          		titleFontColor: "#0400a7",
          		lineColor: "#0400a7",
          		labelFontColor: "#0400a7",
          		tickColor: "#4F81BC"
          	},
          	axisY2: {
          		title: "",
          		titleFontColor: "#C0504E",
          		lineColor: "#C0504E",
          		labelFontColor: "#C0504E",
          		tickColor: "#C0504E"
          	},
          	toolTip: {
          		shared: true
          	},
          	legend: {
          		cursor:"pointer",
          		itemclick: toggleDataSeries
          	},
          	data: [{
          		type: "column",
          		name: "Нийт хүн ам",
          		legendText: "Нийт хүн ам",
          		showInLegend: true,
          		dataPoints:totalPop,
          	},
          	{
          		type: "column",
          		name: "Жишсэн хүн ам",
          		legendText: "Жишсэн хүн ам",
          		axisYType: "secondary",
          		showInLegend: true,
          		dataPoints:standardPop,
          	}]
          });
          chart.render();

      }
    });
    function toggleDataSeries(e) {
    	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    		e.dataSeries.visible = false;
    	}
    	else {
    		e.dataSeries.visible = true;
    	}
    	chart.render();
    }
  });
});
