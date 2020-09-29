@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Монгол Улсын аймгууд</h4>
                  <table id="provinceDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Бүсийн нэр</th>
                          <th>Аймаг нэр</th>
                          <th>Аймгийн код</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <td></td>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnProvinceDelete">Устгах</button>
                    {{-- <button class="btn btn-danger" type="button" name="button" id="btnProvinceDelete">Хэвлэх</button> --}}
                    <button class="btn btn-primary hidden-print" onclick="printFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Хэвлэх</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Province.ProvinceNew')
@include('Province.ProvinceEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
    #provinceDB tbody tr.selected {
      color: white;
      background-color: #8893f2;
    }
    #provinceDB tbody tr{
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
  var csrf = "{{ csrf_token() }}";
  var getProvince = "{{url("/getProvince")}}";
  var provinceNew = "{{url("/province/insert")}}";
  var provinceEditUrl = "{{url("/province/edit")}}";
  var provinceDeleteUrl = "{{url("/province/delete")}}";

  $(document).ready(function(){
    var table = $('#provinceDB').DataTable({
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
          dom: 'Bfrtip',
          buttons: [
              'print', 'excel', 'pdf'
          ],
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "ajax":{
                   "url": getProvince,
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "sectorName", name: "sectorName"},
            { data: "provName", name: "provName"},
            { data: "provCode", name: "provCode"},
            { data: "isStart", name: "isStart", visible:false},
            { data: "sectorID", name: "sectorID", visible:false}
            ]
        });

        $('#provinceDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#provinceDB').DataTable().row(currow).data();
          }
          });
  });

    // $('#provinceDB').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'print'
    //     ]
    // } );

  </script>

<script src="{{url("public/js/Province/ProvinceNew.js")}}"></script>
<script src="{{url("public/js/Province/ProvinceEdit.js")}}"></script>
<script src="{{url("public/js/Province/ProvinceDelete.js")}}"></script>



@endsection
