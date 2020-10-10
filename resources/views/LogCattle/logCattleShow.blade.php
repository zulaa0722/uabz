@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
            <div class="card">
              {{-- START div CARD BODY --}}
              <div  class="card-body">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label text-md-right">Аймгаа сонгоно уу=></label>
                    <div class="col-md-6">
                      <select post-url="{{url("/get/dangered/syms/by/provID")}}" class="form-control" id="cmbProv" name="">
                        <option value="0">Сонгоно уу</option>
                        @foreach ($provs as $prov)
                          <option value="{{$prov->provID}}">{{$prov->provName}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 d-none" id="divSums">
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label text-md-right">Сумаа сонгоно уу=></label>
                    <div class="col-md-6">
                      <select class="form-control" id="cmbSum" name="">
                        <option value="0">Сонгоно уу</option>
                      </select>
                    </div>
                  </div>
                </div>

                <h4 class="text-center"><span class="text-success" id="lblProv"></span> <span class="text-success" id="lblSum"></span> малын тоо толгойны мэдээлэл</h4>

                <table post-url="{{url("/get/log/cattles")}}" id="cattleDB" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 40%;">
                  <thead>
                    <tr>
                      <th rowspan="2">№</th>
                      <th rowspan="2">Огноо</th>
                      @foreach ($cattles as $cattle)
                        <th style="text-align:center;" colspan="3">{{$cattle->cattleName}}</th>
                      @endforeach
                    </tr>
                    <tr>
                      @foreach ($cattles as $cattle)
                        <th>Тоо</th>
                        <th>Хонин толгой</th>
                        <th>Кг</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                <button class="btn btn-danger" type="button" name="button" id="btnLogCattleDelete">Устгах</button>
              </div>
              {{-- END div CARD BODY --}}
            </div>
          </div>
        </div>
      </div>
    </div>
@include('logCattle.logCattleNew')
@include('logCattle.logCattleEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
    <style media="screen">
      #cattleDB tbody tr.selected {
        color: white;
        background-color: #8893f2;
      }
      #cattleDB tbody tr{
        cursor: pointer;
      }
    </style>
@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
    var table="";
    var sheepKG = parseFloat("{{ConstantVariables::sheepKG}}");
    var cattlesCols = <?php echo json_encode($cattles); ?>;
    console.log(cattlesCols);
    $(document).ready(function(){
      table = $('#cattleDB').DataTable({
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
        "stateSave": true,
        "orderCellsTop": true,
        "fixedHeader": true,
        "scrollX":true,
        "processing": true,
        "scrollX": true,
        "order": [[1, 'asc']],
         "columnDefs": [{
            "targets": "_all",
            "orderable": false
         }],
      });
    });
  </script>
  <script src="{{url("public/js/logCattle/logCattleShow.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleNew.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleEdit.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleShow.js")}}"></script>
@endsection
