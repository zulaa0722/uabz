@extends('layouts.layout_master')

@section('content')
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div  class="card-body">
            <h4 Class="text-center">Гол нэрийн хүнсний бүтээгдэхүүний нөөцийг тодотгох</h4>
            <div class="row">
              <div class="row col-md-4">
                <div class="list-group col-md-6">
                  <label>Аймаг аа сонгоно уу.</label>
                  @foreach ($provs as $prov)
                    <a href="#" onclick="aimag({{$prov->provID}}, '{{url("/get/dangered/syms/by/provID")}}')" class="list-group-item list-group-item-action" data-toggle="list">{{$prov->provName}}</a>
                  @endforeach
                </div>
                <div class="list-group col-md-6" id="listSyms">


                </div>
              </div>
              <div class="row col-md-8">
                <div class="row col-md-12">
                  <table post-url="{{url("/get/log/cattles")}}" id="cattleDB" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>№</th>
                          <th>№</th>
                          <th>№</th>
                          @foreach ($cattles as $cattle)
                            <th>{{$cattle->cattleName}}</th>
                          @endforeach
                          {{-- <th>Огноо</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                </div>
                <div class="row col-md-12">

                  <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                  <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                  <button class="btn btn-danger" type="button" name="button" id="btnAxaxDelete">Устгах</button>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
  </div>
@endsection

@section('css')
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
    var cols1 = <?php echo json_encode($cattles); ?>;
  </script>

  <script src="{{url("public/js/logCattle/logCattleShow.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleNew.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleEdit.js")}}"></script>
  <script src="{{url("public/js/logCattle/logCattleShow.js")}}"></script>
@endsection
