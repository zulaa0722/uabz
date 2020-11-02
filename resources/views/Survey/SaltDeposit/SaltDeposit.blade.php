@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                <div  class="card-body">
                  <h4 Class="text-center">Орон нутаг дахь давсны ордын судалгаа</h4>
                  <table post-url="{{url('/survey/get/salt/deposits')}}" id="tableSaltDeposit" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr class="text-center">
                          <th>№</th>
                          <th>Аймаг, нийслэл</th>
                          <th>Сум, дүүрэг</th>
                          <th>Ордын нэр</th>
                          <th>Ордын нөөц /тн/</th>
                          <th>Ордын төлөв*</th>
                          <th>Аймгийн төв <br> хүртэлх зай /км/</th>
                          <th>Хариуцах хүний нэр</th>
                          <th>Холбоо барих утас</th>
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
                    <button class="btn btn-danger" type="button" post-url="{{url("/survey/salt/deposit/delete")}}" name="button" id="btnDeleteFoodFactory">Устгах</button>
                    {{-- <p class="text-right">**Механикжсан агуулах бол (М), уламжлалт ажиллагаатай бол (У), хөргүүртэй агуулах бол (X), <br>
                    хөргүүртэй агуулах бол (Xгүй) гэж тус тус тэмдэглэнэ. Төлөв давхардаж болно.</p> --}}
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@include('Survey.SaltDeposit.SaltDepositNew')
@include('Survey.SaltDeposit.SaltDepositEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#drinkingWaterSource tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#drinkingWaterSource tbody tr{
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

  $(document).ready(function(){
    var table = $('#tableSaltDeposit').DataTable({
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
                   "url": $("#tableSaltDeposit").attr('post-url'),
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
            { data: "provName", name: "provName"},
            { data: "symName", name: "symName"},
            { data: "dpstName", name: "dpstName"},
            { data: "dpstReserve", name: "dpstReserve"},
            { data: "dpstState", name: "dpstState"},
            { data: "distance", name: "distance"},
            { data: "resName", name: "resName"},
            { data: "contact", name: "contact"},
            { data: "provID", name: "provID", visible:false},
            { data: "symID", name: "symID", visible:false}
            ]
        });

        $('#tableSaltDeposit tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                dataRow = "";
            }else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                var currow = $(this).closest('tr');
                dataRow = $('#tableSaltDeposit').DataTable().row(currow).data();
            }
          });
  });
  </script>

<script src="{{url("public/js/Survey/SurveyAll.js")}}"></script>
<script src="{{url("public/js/Survey/SaltDeposit/SaltDepositNew.js")}}"></script>
<script src="{{url("public/js/Survey/SaltDeposit/SaltDepositEdit.js")}}"></script>
<script src="{{url("public/js/Survey/SaltDeposit/SaltDepositDelete.js")}}"></script>

@endsection
