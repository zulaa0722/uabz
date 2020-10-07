

<div id="modalAxaxNew" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Авч хэрэгжүүлэх арга хэмжээ нэмэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              @csrf
              <form id="frmAxaxNew" action="" method="post">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Хэрэгжүүлэх арга хэмжээний чиглэл:</label>
                    <select class="form-control" id="axaxTypeID" name="axaxTypeID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($axaxTypes as $axaxType)
                        @php
                          $axaxCount = App\Http\Controllers\AxaxController::getAxaxCountByType($axaxType->id);
                        @endphp
                        <option axaxCount="{{$axaxCount}}" value="{{$axaxType->id}}">{{$axaxType->typeName}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label>Хэрэгжүүлэх арга хэмжээ:</label>
                      <textarea class="form-control" id="axaxName" name="axaxName" rows="4"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Ц (Шийдвэр гарсан хугацаа) + (хоног:цаг):</label>
                    <input type="text" class="form-control" id="inTime" name="inTime"></textarea>
                  </div>
                  <div class="col-md-3">
                    <label>Төлөв:</label>
                    <select class="form-control" id="statusID" name="statusID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($statuss as $status)
                        <option value="{{$status->id}}">{{$status->statusName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Зэрэг:</label>
                    <select class="form-control" id="levelID" name="levelID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($levels as $level)
                        <option value="{{$level->id}}">{{$level->levelName}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Удирдан зохицуулах байгууллага</label>
                    <select class="form-control" name="mainOrgID" id="mainOrgID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($organizations as $organization)
                        <option value="{{$organization->id}}">{{$organization->abbrName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Тайлбар:</label>
                    <textarea class="form-control" id="comment" name="comment"></textarea>
                  </div>
                </div>
              </form>
                <div class="col-md-12">
                  <label>Дэмжлэг үзүүлэх байгууллагууд:</label><br>
                  @foreach ($organizations as $organization)
                    <label class="form-check-label">
                      <input type="checkbox" class="supportOrgs" name="" id="" value="{{$organization->id}}">&nbsp;{{$organization->abbrName}}&nbsp;&nbsp;&nbsp;
                    </label>
                    {{-- <option value="{{$organization->id}}">{{$organization->abbrName}}</option> --}}
                  @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnAxaxAdd" class="btn btn-primary">Хадгалах</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
