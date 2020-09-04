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

                    <th>Аймаг, нийслэл</th>
                    <th style="width:18%;">Сум, Дүүрэг</th>
                    <th>Гол нэрийн бүтээгдхүүн</th>
                    <th>Үлдсэн хоног</th>
                    <th>Арга хэмжээ</th>
                    <th>Арга хэмжээ</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Архангай</td>
                    <td>Батцэнгэл</td>
                    <td>Төмс</td>
                    <td style="font-color:red;">2</td>
                    <td>
                      <input type="button" class="btn btn-warning" name="" value="Орлуулах" id="showSub">
                    </td>
                    <td>
                      <input type="button" class="btn btn-danger" name="" value="Нормоос хасах" id="changeNorm">
                    </td>
                  </tr>
                </tbody>
            </table>

          </div>
        </div>
    </div>
  </div>

@endsection

{{-- @section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
    #ShowSubProducts tbody tr.hover {
      color: white;
      background-color: #8893f2;
    }
    #ShowSubProducts tbody tr{
      cursor: pointer;
    }
  </style>
@endsection --}}
@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
    var dataRow = "";
    var foodReserveNewUrl = "{{url("/foodReserve/insert")}}";
    var foodReserveDeleteUrl = "{{url("/foodReserve/delete")}}";
  </script>



<script type="text/javascript">
$(document).ready(function(){

  // $('#ShowSubProducts thead tr').clone(true).appendTo( '#ShowSubProducts thead' );
  // var filterIndex = 0;
  //   $('#ShowSubProducts thead tr:eq(1) th').each( function (i) {
  //     if(filterIndex == 4 || filterIndex == 3)
  //     {
  //       $(this).html( '<input type="text" style="width:110%;" placeholder="Хайх..." />' );
  //       $( 'input', this ).on( 'keyup change', function () {
  //           if ( table.column(i).search() !== this.value ) {
  //               table.column(i).search( this.value ).draw();
  //           }
  //       });
  //     }
  //     else {
  //       $(this).html('');
  //     }
  //     filterIndex++;
  //   });
  var table = $('#ShowSubProducts').DataTable( {
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
      "scrollX": true
      // "stateSave": true
      });

});
</script>
<script src="{{url('public/js/mongolianMap/ShowSubProduct.js')}}"></script>
@endsection
