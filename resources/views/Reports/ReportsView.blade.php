@extends('layouts.layout_master')

@section('content')
  <div class="form-row" style="background-color: white; height: 100%; margin-top: 30px;">

    <ol class="rectangle-list col-md-5">
      <li><a href="{{url("/reports/population")}}" id="pop">Монгол Улсын хүн амын тоо</a></li>
      <li><a href="javascript:void(0)" id="computeTable">Жишсэн хүн амын хэрэгцээг тооцох</a></li>
      {{-- <li><a href="javascript: void(0);" id="subProductBuy">Орлуулах бүтээгдэхүүн авсан бүртгэл</a></li> --}}
      {{--<li><a href="javascript: void(0);">Тариалангийн агуулах, элеватор, зоорийн</a></li>
      <li><a href="javascript: void(0);">Хүнсний үйлдвэрийн судалгаа</a></li>
      <li><a href="javascript: void(0);">Орон нутаг дахь давсны ордны судалгаа</a></li>
      <li><a href="javascript: void(0);">Тээврийн хэрэгслийн судалгаа</a></li>
      <li><a href="javascript: void(0);">Хүнсний хангамжийн шуурхай штабын бүрэлдэхүүнд </a> </li> --}}
    </ol>
    <div id="reportContainer" class="col-md-7">
      <div id="chartPop" style="height:400px;"></div>
      <table id="reportTable" class="table table-striped table-bordered wrap d-none" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
          <tr>
            <th rowspan="2" style="vertical-align:middle;">№</th>
            <th rowspan="2" style="vertical-align:middle;">Хүнсний бүтээгдэхүүний нэр төрөл</th>
            <th rowspan="2" style="vertical-align:middle;">Жишсэн нэг хүний жилийн хүнсний хэрэгцээ /кг/</th>
            <th colspan="{{count($pop)}}" style="vertical-align:middle;">Жишсэн хүн амын хүнсний хэрэгцээ /мян.тн/</th>
          </tr>
          <tr>

            @foreach ($pop as $val)
              <td>{{$val->date}}</td>
            @endforeach

          </tr>
        </thead>
        <tbody>
          @php
            $i=1;
          @endphp
          @foreach ($products as $product)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$product->productName}}</td>
              <td>{{$product->foodQntt * 365}}</td>
              @foreach ($pop as $val)
                <td>{{round(($val->standardPop*$product->foodQntt*365)/1000,2)}}</td>
              @endforeach

            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>

<style media="screen">

  thead th{
    text-align: center;
  }

  ol{
			counter-reset: li;
			list-style: none;
			*list-style: decimal;
			font: 15px ;
			padding: 0;
			margin-bottom: 4em;
			text-shadow: 0 1px 0 rgba(255,255,255,.5);
		}

		ol ol{
			margin: 0 0 0 2em;
		}
  .rectangle-list a{
    position: relative;
    display: block;
    padding: .4em .4em .4em .8em;
    *padding: .4em;
    margin: .5em 0 .5em 2.5em;
    background: #f6ecda;
    color: #444;
    text-decoration: none;
    transition: all .3s ease-out;
  }

  .rectangle-list a:hover{
    background: #f7e4bf;
  }

  .rectangle-list a:before{
    content: counter(li);
    counter-increment: li;
    position: absolute;
    left: -2.5em;
    top: 50%;
    margin-top: -1em;
    background: #f8ab17;
    height: 2em;
    width: 2em;
    line-height: 2em;
    text-align: center;
    font-weight: bold;
  }

  .rectangle-list a:after{
    position: absolute;
    content: '';
    border: .5em solid transparent;
    left: -1em;
    top: 50%;
    margin-top: -.5em;
    transition: all .3s ease-out;
  }

  .rectangle-list a:hover:after{
    left: -.5em;
    border-left-color: #f8ab17;
  }
</style>

@endsection

@section('css')

@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">

  </script>
<script src="{{url('public/js/chart/reportPopulation.js')}}"></script>
<script src="{{url('public/js/chart/jquery.canvasjs.min.js')}}"></script>
@endsection
