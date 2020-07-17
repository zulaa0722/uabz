@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-8">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Монгол Улсын бүсчлэл</h4>
                  <table id="sectorDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Бүсийн нэр</th>
                          <th>Бүсийн код</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td></td>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnSectorAdd">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnSectorEdit">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnSectorDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Sector.SectorNew')
@include('Sector.SectorEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#sectorDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#sectorDB tbody tr{
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
  var getSector = "{{url("/getSector")}}";
  var sectorNew = "{{url("/sector/insert")}}";
  var sectorEditUrl = "{{url("/sector/edit")}}";
  var sectorDeleteUrl = "{{url("/sector/delete")}}";

  $(document).ready(function(){
    var table = $('#sectorDB').DataTable({
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
                   "url": getSector,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: "{{ csrf_token() }}"
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "sectorName", name: "sectorName"},
            { data: "sectorCode", name: "sectorCode"}
            ]
        });

        $('#sectorDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#sectorDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/Sector/SectorNew.js")}}"></script>
<script src="{{url("public/js/Sector/SectorEdit.js")}}"></script>
<script src="{{url("public/js/Sector/SectorDelete.js")}}"></script>



@endsection
