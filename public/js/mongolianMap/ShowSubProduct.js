$(document).on("click", ".showSubProducts", function(){
  $("#modalShowSub").modal("show");

  $("#provName").text($(this).attr("provName"));
  $("#symName").text($(this).attr("symName"));

  $("#changeProduct").text($(this).attr("product"))





});
