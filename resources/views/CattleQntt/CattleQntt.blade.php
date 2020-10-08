@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-9">
            <style >
               @media print {
                 body{
                   visibility: hidden;
                 }
             #mal
             {
               visibility: visible;
             }
                 #cattleQnttDB
                 {
                   width: 100%;
                   height: 100%;
                   border: solid;
                   table-layout: fixed;
                   visibility: visible;
                 }

               }
             </style>
              <div class="card">
                <div  class="card-body">
                  <label class="text-success">Он ==> </label>
                  <input type="button" class="btn btn-info btn-sm btnYear" name="" value="{{$year-3}}">
                  <input type="button" class="btn btn-info btn-sm btnYear" name="" value="{{$year-2}}">
                  <input type="button" class="btn btn-info btn-sm btnYear" name="" value="{{$year-1}}">
                  <input type="button" class="btn btn-outline-info btn-sm btnYear" name="" value="{{$year}}">
                  <div class="d-none" id="loadImage">
                      <div class="d-flex flex-column align-items-center justify-content-center">
                         <div class="row">
                             <div class="spinner-border text-danger" role="status">
                                 <span class="sr-only">Loading...</span>
                             </div>
                          </div>
                          <div class="row">
                            <strong>Өгөгдөл ачааллаж байна</strong>
                          </div>
                      </div>
                  </div>
                  <h4 Class="text-center" id="mal">Малын тоо толгой <span class="text-success" id="headerYear">{{$year}} он</span></h4>
                  <table id="cattleQnttDB" post-url="{{url("/get/all/cattle/quantity")}}" class="table table-striped table-bordered wrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th></th>
                          <th></th>
                          <th>Аймаг</th>
                          <th>Сум</th>
                          @foreach ($cattles as $cattle)
                              <th>{{$cattle->cattleName}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                    <button class="btn btn-warning" type="button" name="button" id="btnAddModalOpen">Тоо толгой нэмэх</button>
                    <button class="btn btn-danger" type="button" name="button" id="btnCattleQnttDelete">Устгах</button>
                    <button onclick="window.print()">ustgah</button>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('CattleQntt.CattleQnttNew')
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
  var cattleQnttNew = "{{url("/cattleQntt/insert")}}";
  var cattleQnttDeleteUrl = "{{url("/cattleQntt/delete")}}";
  var table = "";
  var year = {{$year}};

  $(document).ready(function(){
    // alert(year);


        $('#cattleQnttDB thead tr').clone(true).appendTo( '#cattleQnttDB thead' );
        var filterIndex = 0;
        $('#cattleQnttDB thead tr:eq(1) th').each( function(i)  {
          if(filterIndex == 3 || filterIndex == 4)
          {
            $(this).html( '<input type="text" style="width:110%;" placeholder="Хайх..." />' );
            $( 'input', this) .on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value)  {
                    table.column(i).search(this.value).draw();
                }
            });
          }
          else {
            $(this).html('');
          }
          filterIndex++;
        });
        refresh({{$year}});

        table.column( 1 ).visible( false );
        table.column( 2 ).visible( false );

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
<script src="{{url("public/js/CattleQntt/CattleQnttShow.js")}}"></script>
<script src="{{url("public/js/CattleQntt/CattleQnttNew.js")}}"></script>
<script src="{{url("public/js/CattleQntt/CattleQnttDelete.js")}}"></script>
@endsection
