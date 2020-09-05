@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Монгол Улсын сумд</h4>
                  <table id="symDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Аймаг нэр</th>
                          <th>Сумын нэр</th>
                          <th>Сумын код</th>
                          <th></th>
                          <th></th>
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
                    <button class="btn btn-danger" type="button" name="button" id="btnSymDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Sym.SymNew')
@include('Sym.SymEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#symDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#symDB tbody tr{
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
  var getSym = "{{url("/getSym")}}";
  var symNew = "{{url("/sym/insert")}}";
  var symEditUrl = "{{url("/sym/edit")}}";
  var symDeleteUrl = "{{url("/sym/delete")}}";

  $(document).ready(function(){
    var table = $('#symDB').DataTable({
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
                   "url": getSym,
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            {
              data: "id", name: "id",  render: function (data, type, row, meta)
              {
                return meta.row + meta.settings._iDisplayStart + 1;
              }
            },

            { data: "provName", name: "provName"},
            { data: "symName", name: "symName"},
            { data: "symCode", name: "symCode"},
            { data: "provID", name: "provID", visible:false},
            { data: "normID", name: "normID", visible:false},
            { data: "isCustomizeID", name: "isCustomizeID", visible:false},
            { data: "isStart", name: "isStart", visible:false}
            ]
        });

        $('#symDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#symDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/Sym/SymNew.js")}}"></script>
<script src="{{url("public/js/Sym/SymEdit.js")}}"></script>
<script src="{{url("public/js/Sym/SymDelete.js")}}"></script>



@endsection
