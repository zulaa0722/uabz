@extends('layouts.layout_master')
@section('css')
  <style media="screen">
    .aimag{
        fill:black;
        fill-opacity:0.4;
        stroke:white;
        stroke-width:8;
    }

    .danger{
        /* fill:transparent; */
        fill:red;
        fill-opacity:0.9;
        stroke:white;
        stroke-width:8;
    }

    .warning{
        /* fill:transparent; */
        fill:yellow;
        fill-opacity:0.9;
        stroke:white;
        stroke-width:8;
    }

    .success{
        /* fill:transparent; */
        fill:green;
        fill-opacity:0.8;
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
                    <div class="form-group row" id="divDeedHeseg">
                    <div class="col-md-6 border border-danger">
                      <div class="form-group" id="divDeclareDangerContent">
                        <label class="col-md-12 col-form-label text-md-center">Онц байдал зарлах</label>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <select class="form-control" id="cmbDangerType" name="">
                              <option value="-1">Сонгоно уу</option>
                              <option value="1">Бүсээр</option>
                              <option value="2">Аймгаар</option>
                              <option value="3">Сумаар</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <input type="button" id="btnDeclareDangerModal" class="btn btn-danger" name="btnDeclareDangerModal" value="Онц байдал зарлах">
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 border border-danger">
                      <div class="form-group">
                        <div class="text-center">
                          <label class="col-md-9 col-form-label text-md-center">Гол нэрийн бүтээгдээхүүний нөөц дуусч байгаа сумууд</label>
                          <h3 class="text-danger">{{ App\Http\Controllers\SubReserveController::getSymCount()}}</h3>
                            <a class="btn btn-info" href="{{url("/SubReserveController")}}">Дэлгэрэнгүй</a>
                        </div>
                      </div>
                    </div>
                  </div>
                      <div class="page-title-box">
                          <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item"><a href="{{url("/mongolia/maps")}}" id="mongolianMap">Монгол Улс</a></li>
                              <li class="breadcrumb-item active " id="selectedProvName"></li>
                          </ol>
                      </div>

                    <div id="changeProvince">
                        @include('mongolianMap.allMaps')
                        {{-- @include('ShowSubProduct.ShowSubProducts') --}}
                        @include('mongolianMap.danger.dangerModal')
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
                      <div class="page-title-box" id="divBtnShowBySym">
                          <ol class="breadcrumb mb-0 float-right">
                              <li class="breadcrumb-item"><a href="javascript:void(0)" id="toSum">Сумаар харах</a></li>
                              <li class="breadcrumb-item"><a href=""></a></li>
                          </ol>
                      </div>
                      <div class="d-none" id="divShowBySymLoading">
                        <div class="d-flex flex-column align-items-center justify-content-right">
                          <div class="row">
                            <div class="spinner-border text-primary" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div>
                          <div class="row">
                            <strong>Аймгийн өгөгдөл татаж байна...</strong>
                          </div>
                        </div>
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
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Нийт хүн ам:
                        </div>
                        <div class="col-md-3">
                          <img src="{{url('\public\images\icons\population.png')}}" width="35" alt="" style="padding-bottom:4px;">
                        </div>
                        <div id="totalPop" class="col-md-9 text-left" style="font-size:22px;">
                          2237812
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Жишсэн хүн ам:
                        </div>
                        <div class="col-md-3">
                          <img src="{{url('\public\images\icons\standard.png')}}" width="35" alt="" style="padding-bottom:4px;">
                        </div>
                        <div id="standardPop" class="col-md-9 text-left" style="font-size:22px;">
                          1737812
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Нийт малын тоо толгой:
                        </div>
                        <div class="col-md-3 col-xm-3">
                          <img src="{{url('\public\images\icons\cattleIcon.png')}}" width="35" alt="" style="padding-bottom:4px;">
                        </div>
                        <div id="totalCattle" class="col-md-9 col-xm-9 text-left" style="font-size:22px;">
                          52037812
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Нийт хоногийн нөөц
                        </div>
                        <div id="reserveDay" class="col-md-12 text-center text-success border border-success rounded-circle" style="font-size:45px;">
                          56234
                        </div>
                        <div class="col-md-12 text-center">
                          Хоног
                        </div>
                      </div>

                      <a class="badge badge-info col-md-12 text-center" href="{{url("/show/dangers")}}">Бүх онц байдлуудыг харах</a>

                      <div id="chartContainer" class="col-md-12"></div>

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
          <h4 class="card-title mb-12" id="">Тухайн хүнсний бүтээгдэхүүний үлдсэн хоног</h4>
          <div class="form-group row" id="bottom">
            {{-- <div class="form-group row col-md-3">
              <div class="col-md-12" id="productName">Гурил:</div>
              <div class="col-md-12">Үлдсэн хоног: <label id="leftDays">3</label></div>
            </div> --}}
          </div>

        </div>
      </div>
    </div>
  </div>


@endsection

@section('js')

  <script type="text/javascript">
    var csrf = "{{ csrf_token() }}";
    var getAimagInfo = "{{url("/get/getAimagInfo")}}";
    var getSymInfo = "{{url("/get/getSymInfo")}}";
    var allMongolianMap = "{{url("/mongolian/allMaps")}}";
    var changeBladeProvince = "{{url("/mongolian/province")}}";
    var getAlertedProvJson = "{{url("/test/get")}}";
    var aimagName = "";
    var provCode = "";
    var getAllSumsReserveDayCountURL = "{{url("/get/sums/reserve/count")}}";

      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $("#toSum").click(function(){
          if(aimagName != ""){
            $("#changeProvince").prop( "disabled", true );
            $("#divBtnShowBySym").hide();
            $("#divShowBySymLoading").removeClass("d-none");
            $.ajax({
              type: 'get',
              url: changeBladeProvince,
              data: {
                  _token: csrf,
                  provCode: provCode
              },
              success:function(response){
                $("#changeProvince").html("");
                $("#changeProvince").html(response);
                changeSymColor();
                $("#divDeedHeseg").hide();
                $("#divShowBySymLoading").addClass("d-none");
                $("#changeProvince").prop( "disabled", false );
              },
              error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';
                $.each(errors['errors'], function (index, value) {
                    errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
                });
                // alert(errorsHtml);
                $("#divBtnShowBySym").show();
                $("#divShowBySymLoading").addClass("d-none");
                $("#changeProvince").prop( "disabled", false );
              }
          });
        }else{
          alert("аймаг сонгоно уу");
        }

        });


      });
  </script>

  <script src="{{url('public/js/mongolianMap/test.js')}}"></script>
  <script src="{{url('public/js/mongolianMap/RightPanel.js')}}"></script>
  <script src="{{url('public/js/mongolianMap/changeColor.js')}}"></script>
  <script src="{{url('public/js/chart/jquery.canvasjs.min.js')}}"></script>
@endsection
