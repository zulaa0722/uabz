@extends('layouts.layout_master')

<style >
   @media print {
     body{
       visibility: hidden;
     }

     #axaxDB
     {
       width: 100%;
       height: 100%;
       border: solid;
       table-layout: fixed;
       visibility: visible;
     }
     #zailaa
     {
       visibility: visible;
     }
   }
 </style>
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Авч хэрэгжүүлэх арга хэмжээ</h4>
                  <table id="axaxDB" class="table table-bordered stripe hover cell-border order-column" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr class="text-center">
                          <th style="display:none;"></th>
                          <th style="display:none;"></th>
                          <th style="display:none;"></th>
                          <th style="display:none;"></th>
                          <th style="display:none;"></th>
                          <th style="display:none;"></th>
                          <th>№</th>
                          <th>Авч хэрэгжүүлэх <br> арга хэмжээ</th>
                          <th>Зэрэг</th>
                          <th>Ц (Шийдвэр гарсан <br> хугацаа)</th>
                          <th>Төлөв</th>
                          <th>Удирдан зохицуулах <br> байгууллага</th>
                          <th>Дэмжлэг үзүүлэх <br> байгууллага</th>

                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $j=1;
                        @endphp
                          @foreach ($axaxTypes as $axaxType)
                            <tr style="background-color: #ccc; text-align: center;" class="mergedColumn">
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td colspan="7">{{$axaxType->typeName}}</td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                              <td style="display:none;"></td>
                            </tr>
                            @php
                            $axaxes = App\Http\Controllers\AxaxController::getAxaxesByType($axaxType->id);
                            $i=1;
                            @endphp
                            @foreach ($axaxes as $axax)
                              <tr axaxID="{{$axax->id}}">
                                <td style="display:none;">{{$axax->levelID}}</td>
                                <td style="display:none;">{{$axax->statusID}}</td>
                                <td style="display:none;">{{$axax->mainOrgID}}</td>
                                <td style="display:none;">{{$axax->typeID}}</td>
                                <td style="display:none;">{{$axax->supportOrg}}</td>
                                <td style="display:none;">{{$axax->id}}</td>
                                @if ($i < 10)
                                  <td>2.{{$j}}.0{{$i}}</td>
                                @else
                                  <td>2.{{$j}}.{{$i}}</td>
                                @endif
                                <td>{{$axax->axaxName}}</td>
                                <td>{{$axax->levelName}}</td>
                                <td>{{$axax->inTime}}</td>
                                <td>{{$axax->statusName}}</td>
                                <td>{{$axax->abbrName}}</td>
                                <td>{{$axax->supportOrgNames}}</td>
                              </tr>
                              @php
                                $i++;
                              @endphp
                            @endforeach
                            @php
                              $j++;
                            @endphp
                          @endforeach

                        </tr>
                      </tbody>
                    </table>
                    <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                    <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnAxaxDelete">Устгах</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>

@include('Axax.AxaxNew')
@include('Axax.AxaxEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
      #axaxDB tbody tr.selected {
        color: white;
        background-color: #8893f2;
      }
      #axaxDB tbody tr{
        cursor: pointer;
      }
      #axaxDB .mergedColumn{
        cursor: default;
      }


      /* #zailaa
      {
        visibility: visible;
      } */
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
  var csrf = "{{ csrf_token() }}";
  var getAxax = "{{url("/getAxax")}}";
  var axaxNew = "{{url("/axax/insert")}}";
  var axaxEditUrl = "{{url("/axax/edit")}}";
  var axaxDeleteUrl = "{{url("/axax/delete")}}";

  // table = $('#axaxDB').DataTable();

  $(document).ready(function(){

     table = $('#axaxDB').DataTable({
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
          "select": {style : 'single' },
          "stateSave": true,
          // "ordering": false,
          "order": [[6, 'asc']],
           "columnDefs": [{
              "targets": "_all",
              "orderable": false
           }],
          "columns": [
            { data: "levelID", name: "levelID", visible: false},
            { data: "statusID", name: "statusID", visible: false},
            { data: "mainOrgID", name: "mainOrgID", visible: false},
            { data: "axaxTypeID", name: "axaxTypeID", visible: false},
            { data: "supportOrg", name: "supportOrg", visible: false},
            { data: "id", name: "id", visible: false},
            { data: "number", name: "number"},
            { data: "axaxName", name: "axaxName"},
            { data: "levelName", name: "levelName"},
            { data: "inTime", name: "inTime"},
            { data: "statusName", name: "statusName"},
            { data: "mainName", name: "mainName"},
            { data: "supportName", name: "supportName"}
            ]
        });
        // table.order( [ 5, 'asc' ] ).draw();

        $('#axaxDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
            $('#axaxDB tbody tr').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              // alert($(this).attr("axaxID"));
              dataRow = $('#axaxDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

<script src="{{url("public/js/Axax/AxaxNew.js")}}"></script>
<script src="{{url("public/js/Axax/AxaxEdit.js")}}"></script>
<script src="{{url("public/js/Axax/AxaxDelete.js")}}"></script>
@endsection
