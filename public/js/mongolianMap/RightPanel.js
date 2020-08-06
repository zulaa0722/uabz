$(document).ready(function(){
  $('path').on('click', function() {
      $('path.selected').attr("class", "aimag");
      $('path.selected').attr("class", "syms");
      $(this).attr("class", "selected");
      aimagName = $(this).attr('name');
      provCode = $(this).attr('id');
      //alert(provCode);
      $.ajax({
        type: 'get',
        url: getAimagInfo,
        data: {
            _token: csrf,
            name:aimagName,
            provCode: provCode
        },
        success:function(response){
          console.log(response);
          var div = "";
          $.each(response, function(key, val){
            div = div + '<div class="form-group row col-md-3">';
            div = div + '<div class="col-md-12" id="productName">'+val.product+'</div>';
            div = div + '<div class="col-md-12">Үлдсэн хоног: <label id="leftDays">'+val.leftDays+'</label></div>';
            div = div + '</div>';
          });
          $("#bottom").html("");
          $("#bottom").html(div);
          $("#changeName").text( aimagName );
          $("#selectedProvName").text( aimagName );
          $("#totalPop").text( response.totalPop );
          $("#standardPop").text( response.standardPop );
          $("#totalCattle").text( response.totalCattle );
          $("#reserveDay").text( response.reserveDay );

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
