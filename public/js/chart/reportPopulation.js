$(document).ready(function(){

  $("#computeTable").click(function(){
    e.preventDefault();
    $("#reportTable").removeClass("d-none");
    $("#reportContainer").addClass("d-none");
  });

  $("#pop").click(function(e){
    e.preventDefault();
    $("#reportTable").addClass("d-none")

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
          item["label"] = val.date;
          item["y"] = parseInt(val.totalPop);
          totalPop.push(item);

          item1 = {};
          item1["label"] = val.date;
          item1["y"] = parseInt(val.standardPop);
          standardPop.push(item1);
        });

        var chart = new CanvasJS.Chart("reportContainer", {
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
