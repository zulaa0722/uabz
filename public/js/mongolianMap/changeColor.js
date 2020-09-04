$("#document").ready(function(){
    $.ajax({
        type:"post",
        url:getAllSumsReserveDayCountURL,
        data:{
          _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(res){
            res = jQuery.parseJSON(res);
            // console.log(res);
            $.each(res, function(key, val){
                // $('g path[id="' + val.id + '"]').removeClass('aimag');
                if(val.days < 30 && val.days > 9){
                    $('g path[id="' + val.id + '"]').removeClass('oneSum');
                    $('g path[id="' + val.id + '"]').addClass('warning');
                }
                else if(val.days < 9){
                    $('g path[id="' + val.id + '"]').removeClass('oneSum');
                    $('g path[id="' + val.id + '"]').addClass('danger');
                }
                else{
                    $('g path[id="' + val.id + '"]').removeClass('oneSum');
                    $('g path[id="' + val.id + '"]').addClass('success');
                }

            });
        }
    });
});

function changeSymColor(){
    $.ajax({
        type:"post",
        url:getAllSumsReserveDayCountURL,
        data:{
            _token:$('meta[name="csrf-token"]').attr('content')
        },
        success:function(res){
            res = jQuery.parseJSON(res);
            $.each(res, function(key, val){
                // $('g path[id="' + val.id + '"]').removeClass('aimag');
                if(val.days < 30 && val.days > 9){
                    $('path[id="' + val.id + '"]').removeClass('oneSum');
                    $('path[id="' + val.id + '"]').addClass('warning');
                }
                else if(val.days < 9){
                    $('path[id="' + val.id + '"]').removeClass('oneSum');
                    $('path[id="' + val.id + '"]').addClass('danger');
                }
                else{
                    $('path[id="' + val.id + '"]').removeClass('oneSum');
                    $('path[id="' + val.id + '"]').addClass('success');
                }

            });
        }
    });
}
