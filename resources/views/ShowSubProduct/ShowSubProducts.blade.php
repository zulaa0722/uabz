@extends('layouts.layout_master')
@section('css')
<link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
<link href="{{url('public/uaBCssJs/dropzone/dropzone.min.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div id="changeBlade" class="card-body">
            <h4 class="text-center">Гол нэрийн бүтээгдэхүүн дуусч буй сумд</h4>
            <table id="ShowSubProducts" class="table table-striped table-bordered wrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>№</th>
                    <th></th>
                    <th>Аймаг, нийслэл</th>
                    <th></th>
                    <th style="width:18%;">Сум, Дүүрэг</th>
                    <th></th>
                    <th>Гол нэрийн бүтээгдэхүүн</th>
                    <th>Үлдсэн хоног</th>
                    <th>Арга хэмжээ</th>
                    <th>Арга хэмжээ</th>

                  </tr>
                </thead>
                <tbody>
                  <form id="showCompanySubsForm" action="" method="post">

                  @foreach ($arr as $ar => $val)
                    <tr>
                      <td></td>
                      <td>{{$val["provID"]}}</td>
                      <td>{{$val["provName"]}}</td>
                      <td>{{$val["symID"]}}</td>
                      <td>{{$val["symName"]}}</td>
                      <td>{{$val["productID"]}}</td>
                      <td>{{$val["product"]}}</td>
                      <td class="text-danger">{{$val["leftDays"]}}</td>
                      <td>
                        <input id="showSub" type="button" class="btn btn-warning showSubProducts" name="" value="Орлуулах"
                          provID={{$val["provID"]}} symID={{$val["symID"]}} productID={{$val["productID"]}}
                          provName="{{$val["provName"]}}" symName="{{$val["symName"]}}" product="{{$val["product"]}}">
                      </td>
                      <td>
                        <input type="button" class="btn btn-danger editNorm" name="" value="Нормоос засах" id="changeNorm"
                        provID={{$val["provID"]}} symID={{$val["symID"]}} productID={{$val["productID"]}}
                        provName="{{$val["provName"]}}" symName="{{$val["symName"]}}" product="{{$val["product"]}}">
                      </td>
                    </tr>

                  @endforeach
                </form>
                </tbody>
            </table>
            @include('ShowSubProduct.ShowCompanySubs')
          </div>
        </div>
    </div>
  </div>

@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
    var dataRow = "";
    var showCompanySubs = "{{url("/SubReserveController/showCompanySubs")}}";
    var saveSubs = "{{url("SubReserveController/saveSubProducts")}}";
    var editNorm = "{{url("/SubReserveController/editNorm")}}"
    var table = "";
  </script>



<script type="text/javascript">
$(document).ready(function(){

  table = $('#ShowSubProducts').DataTable( {
    "language": {
            "lengthMenu": "_MENU_ мөрөөр харах",
            "zeroRecords": "Хайлт илэрцгүй байна",
            "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
            "infoEmpty": "Хайлт илэрцгүй",
            "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
            "sSearch": "Хайх: ",
            "paginate": {
                        "previous": "Өмнөх",
                        "next": "Дараахи"
                        },
            "select": {
                      rows: ""
                      }
            },
      select: {
        style: 'single'
      },
      "orderCellsTop": true,
      "fixedHeader": true,
      "scrollX": true,
      "stateSave": true,
      "columns": [
        {
          data: "id", name: "id",  render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        { data: "provID", name: "provID", visible: false},
        { data: "provName", name: "provName"},
        { data: "symID", name: "symID", visible: false},
        { data: "symName", name: "symName"},
        { data: "productID", name: "productID", visible: false},
        { data: "product", name: "product"},
        { data: "leftDays", name: "leftDays"},
        { data: "action1", name: "action1"},
        { data: "action", name: "action"},

      ]
    });

});
</script>
<script src="{{url('public/js/mongolianMap/ShowSubProduct.js')}}"></script>
@endsection
