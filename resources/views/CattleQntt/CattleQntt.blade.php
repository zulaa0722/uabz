@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-8">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Малын махны хэмжээ /тоо толгой/</h4>
                  <table id="cattleQnttDB" class="table table-striped table-bordered wrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>Аймаг</th>
                          <th>Сум</th>
                          @foreach ($cattles as $cattle)
                              <th>{{$cattle->cattleName}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                          @foreach ($syms as $sym)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$sym->provName}}</td>
                              <td>{{$sym->symName}}</td>
                              @foreach ($cattles as $cattle)
                                  <td>
                                  @php
                                      $cattleCounts = App\Http\Controllers\CattleQnttController::getCattleCountBySymID($sym->id, $cattle->id);
                                      foreach ($cattleCounts as $cattleCount) {
                                          echo $cattleCount->cattQntt;
                                      }
                                  @endphp
                                  </td>
                              @endforeach
                            </tr>
                            @php
                              $i++;
                            @endphp
                          @endforeach
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnCattleQnttDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('CattleQntt.CattleQnttNew')
@include('CattleQntt.CattleQnttEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#cattleQnttDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#cattleQnttDB tbody tr{
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
  var getCattleQntt = "{{url("/getCattleQntt")}}";
  var cattleQnttNew = "{{url("/cattleQntt/insert")}}";
  var cattleQnttEditUrl = "{{url("/cattleQntt/edit")}}";
  var cattleQnttDeleteUrl = "{{url("/cattleQntt/delete")}}";

  $(document).ready(function(){

    $('#cattleQnttDB thead tr').clone(true).appendTo( '#cattleQnttDB thead' );

    var filterIndex = 0;
      $('#cattleQnttDB thead tr:eq(1) th').each( function (i) {
        if(filterIndex == 1 || filterIndex == 2)
        {
          $(this).html( '<input type="text" style="width:110%;" placeholder="Хайх..." />' );
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table.column(i).search( this.value ).draw();
              }
          });
        }
        else {
          $(this).html('');
        }
        filterIndex++;
      });

    var table = $('#cattleQnttDB').DataTable({
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
          "scrollX":true
        });

        $('#cattleQnttDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#cattleQnttDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/CattleQntt/CattleQnttNew.js")}}"></script>
<script src="{{url("public/js/CattleQntt/CattleQnttEdit.js")}}"></script>
<script src="{{url("public/js/CattleQntt/CattleQnttDelete.js")}}"></script>



@endsection
