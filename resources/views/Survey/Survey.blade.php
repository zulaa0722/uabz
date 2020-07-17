@extends('layouts.layout_master')

@section('content')
  <ol class="rectangle-list">
   {{-- <li><a href="{{url("/forms/form1")}}">Хавсралт 1</a></li> --}}
   <li><a href="{{url("/Survey/drinkingWater")}}">Ундны усны эх үүсвэрийн судалгаа</a></li>
   <li><a href="javascript: void(0);">Хүнсний худалдааны томоохон төв, захын судалгаа</a></li>
   <li><a href="javascript: void(0);">Хүнсний агуулах зоорийн судалгаа</a></li>
   <li><a href="javascript: void(0);">Тариалангийн агуулах, элеватор, зоорийн судалгаа</a></li>
   <li><a href="javascript: void(0);">Хүнсний үйлдвэрийн судалгаа</a></li>
   <li><a href="javascript: void(0);">Орон нутаг дахь давсны ордны судалгаа</a></li>
   <li><a href="javascript: void(0);">Тээврийн хэрэгслийн судалгаа</a></li>
   <li><a href="javascript: void(0);">Хүнсний хангамжийн шуурхай штабын бүрэлдэхүүнд ажиллах <br>
                                           шаардлагатай албан тушаалтны тухай</a> </li>
 </ol>

<style media="screen">
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
    background: #ddd;
    color: #444;
    text-decoration: none;
    transition: all .3s ease-out;
  }

  .rectangle-list a:hover{
    background: #eee;
  }

  .rectangle-list a:before{
    content: counter(li);
    counter-increment: li;
    position: absolute;
    left: -2.5em;
    top: 50%;
    margin-top: -1em;
    background: #fa8072;
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
    border-left-color: #fa8072;
  }
</style>

@endsection

@section('css')

@endsection

@section('js')

@endsection
