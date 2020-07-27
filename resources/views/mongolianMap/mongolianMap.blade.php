@extends('layouts.layout_master')
@section('css')
  <style media="screen">
.aimag{
  fill:black;
  fill-opacity:0.4;
  stroke:white;
  stroke-width:8;
}
.aimag:hover{
  fill:transparent;
}
path {
  cursor: pointer;
}
.selected {
  stroke: white;
  stroke-width: 8;
  fill:transparent;
}

.hotuud:hover{
fill:transparent;
}
.hotuud{
  fill:black;
  fill-opacity:0.4;
  stroke:white;
  stroke-width:8;

}
.syms:hover{
stroke:blue;
stroke-width:2;
}
.syms{
  fill:green;
  fill-opacity:1;
  stroke:white;
  stroke-width:1;
}
.oneSum{
  stroke-width:2;
  stroke:white;
  fill:green;
}

.insideCity{
  fill:black;
  fill-opacity:0.4;
  stroke:white;
  stroke-width:4;
}

  </style>
@endsection
@section('content')

  <div class="row">
    <div class="col-md-9">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                  <div id="changeBlade" class="card-body">
                    <div class="col-md-6">
                      <div class="page-title-box">
                          <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item"><a href="{{url("/mongolia/maps")}}" id="mongolianMap">Монгол Улс</a></li>
                              <li class="breadcrumb-item active " id="nameID"></li>
                          </ol>
                      </div>
                    </div>
                    <div id="changeProvince">
                        @include('mongolianMap.allMaps')

                    </div>
                    <div class="" style="display:none">
                      @include('mongolianMap.Tuv')
                    </div>


    <style media="screen">
      .aimagTextName{
        /* font-weight:bold; */
        fill:#E4FD0C;
        stroke:#E4FD0C;
        font-family:tahoma;
        font-size:62.3503px;
        stroke-miterlimit:1px;
        cursor:pointer;
      }

      .symTextName{
        font-weight:bold;
        fill:#fff;
        font-family:tahoma;
        cursor:pointer;
        /* stroke: black; stroke-width: 1; */
      }
    </style>

  <div class="col-md-12 float-right">
    <div class="page-title-box">
        <ol class="breadcrumb mb-0 float-right">
            <li class="breadcrumb-item"><a href="javascript:void(0)" id="toSum">Сумаар харах</a></li>
            <li class="breadcrumb-item"><a href=""></a></li>
        </ol>
    </div>
  </div>
</div>

              </div>
          </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title mb-12" id="changeName">Монгол Улсын хэмжээнд</h4>

                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

        </div>
      </div>

    </div>
  </div>


@endsection

@section('js')

  <script type="text/javascript">
  var csrf = "{{ csrf_token() }}";
  var changeUrl = "{{url("/get/name")}}";
  var allMongolianMap = "{{url("/mongolian/allMaps")}}";
  var changeBladeProvince = "{{url("/mongolian/province")}}";
  var aimagName = "";
  var provID = "";

      $(document).ready(function(){
      //   $.ajax({
      //     type: 'get',
      //     url: allMongolianMap,
      //     data: {
      //         _token: csrf
      //     },
      //     success:function(response){
      //       $("#changeProvince").html("");
      //       $("#changeProvince").html(response);
      //     },
      //   error: function(jqXhr, json, errorThrown){// this are default for ajax errors
      //     var errors = jqXhr.responseJSON;
      //     var errorsHtml = '';
      //     $.each(errors['errors'], function (index, value) {
      //         errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
      //     });
      //     alert(errorsHtml);
      //   }
      // });

        $('[data-toggle="tooltip"]').tooltip();

        $('path').on('click', function() {
            $('path.selected').attr("class", "aimag");
            $('path.selected').attr("class", "syms");
            $(this).attr("class", "selected");
            aimagName = $(this).attr('name');
            provID = $(this).attr('id');
            $.ajax({
              type: 'get',
              url: changeUrl,
              data: {
                  _token: csrf,
                  name:aimagName
              },
              success:function(response){
                $("#changeName").html("");
                $("#changeName").html(response);

                $("#nameID").html("");
                $("#nameID").html(response);
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

        $("#toSum").click(function(){
          if(aimagName != ""){
            $.ajax({
              type: 'get',
              url: changeBladeProvince,
              data: {
                  _token: csrf,
                  name: provID
              },
              success:function(response){
                $("#changeProvince").html("");
                $("#changeProvince").html(response);
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
        }else{
          alert("аймаг сонгон уу");
        }

        });


      });
  </script>
@endsection
