@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div  class="card-body">
              <h4 class="text-center">Аймаг, сумдын хүнсний цэс</h4>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                    <h6 class="text-right" style="margin-top:10px;"><strong>Цэс сонгоно уу =></strong></h6>
                  </div>
                  <div class="col-md-3">
                    <select id="cmbNorms" class="form-control" name="">
                      <option value="-1">Сонгоно уу</option>
                      @foreach ($normNames as $normName)
                          <option value="{{$normName->id}}">{{$normName->NormName}} /{{$normName->sumKcal}}ккал/</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <small id="cmbNormError" class="text-danger">

                    </small>
                  </div>
                </div>
                <div class="row" style="margin-left:5px;">
                    <div class="text-right">
                      <br>
                        <button class="btn btn-warning pull-right" type="button" name="button" id="btnEditModalOpen">Сонгосон цэс засах</button>
                        <button class="btn btn-danger pull-right" type="button" name="button" post-url="{{url('/norm/delete')}}" id="btnNormDelete">Сонгосон цэс устгах</button>
                    </div>
                </div>
              </div>
              <table id="tableNorms" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>№</th>
                    <th>Хүнсний нэр</th>
                    <th>Тоо хэмжээ</th>
                    <th>Ккал</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Шинэ цэс нэмэх</button>

          </div>
        </div>
    </div>
  </div>
@include('Norm.normNew')
@include('Norm.normEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
  #foodProductsDB tbody tr.selected {
    color: white;
    background-color: #8893f2;
  }
  #foodProductsDB tbody tr{
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
  var dataRow = "";
  var table = "";
  var getNormsUrl = "{{url('/get/norms')}}";

  $(document).ready(function(){
     table = $('#tableNorms').DataTable({
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
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "ajax":{
                   "url": "{{url('/get/norms')}}",
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id:$("#cmbNorms").val()
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "productName", name: "productName"},
            { data: "normQntt", name: "normQntt"},
            { data: "normCkal", name: "normCkal"}
            ]
        });

        $('#tableNorms tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#tableNorms').DataTable().row(currow).data();
          }
          });
  });
  </script>

  <script src="{{url("public/js/Norm/norm.js")}}"></script>
  <script src="{{url("public/js/Norm/normNew.js")}}"></script>
  <script src="{{url("public/js/Norm/normEdit.js")}}"></script>
  <script src="{{url("public/js/Norm/normDelete.js")}}"></script>
@endsection
