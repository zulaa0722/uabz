$(document).ready(function(){
  $("#btnInsertSpent").click(function(){
    $("#modalLogSpent").modal("show");
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
