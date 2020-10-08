function aimag(aimagCode, url){
    $.ajax({
      type:"post",
      url:url,
      data:{
        _token:$('meta[name="csrf-token"]').attr('content'),
        provID:aimagCode
      },
      success:function(res){
          $("#listSyms").empty();
          $("#listSyms").append("<label>Сумаа сонгоно уу.</label>");
          $.each(res, function(key, val){
              // alert(val.symName);
              var atag = '<a href="#" onclick="getSymData(' + val.symID + ', ' + val.id + ')" class="list-group-item list-group-item-action" data-toggle="list">' + val.symName + '</a>';
              $("#listSyms").append(atag);
          });
      }
    });
}

function getSymData(symID, dangerID){
  alert(dangerID);
}
