$(document).ready(function(){
$("#provName").change(function(){
  // alert($("#provName").attr("getSymUrl"));
  $("#cmbSymNew option[value!='-1']").each(function(){
    $(this).remove();
  })
  $.ajax({
    type: "post",
    url: $("#provName").attr("getSymUrl"),
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
      provID: $("#provName").val()
    },
    success:function(response){

      $.each(response, function (value, index ) {
         var o = new Option(index['symName'], index['id']);  // Option(name, val)
         $("#cmbSymNew").append(o);
      });
    }
  });
});

$("#eprovName").change(function(){
  // alert($("#provName").attr("getSymUrl"));
  $("#ecmbSymNew option[value!='-1']").each(function(){
    $(this).remove();
  })
  $.ajax({
    type: "post",
    url: $("#eprovName").attr("getSymUrl"),
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
      provID: $("#eprovName").val()
    },
    success:function(response){

      $.each(response, function (value, index ) {
         var o = new Option(index['symName'], index['id']);  // Option(name, val)
         $("#ecmbSymNew").append(o);
      });
    }
  });
});

});
