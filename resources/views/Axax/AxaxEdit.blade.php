<div id="modalAxaxEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Авч хэрэгжүүлэх арга хэмжээ засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmAxaxEdit" action="" method="post">
                @csrf
                <input type="hidden" name="rowID" id="rowID">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label>Хэрэгжүүлэх арга хэмжээ:</label>
                      <textarea class="form-control" id="eaxaxName" name="axaxName" rows="4" ></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-8">
                    <label>Ц (Шийдвэр гарсан хугацаа) + (хоног:цаг):</label>
                    <textarea class="form-control" id="einTime" name="inTime"></textarea>
                  </div>
                  <div class="col-md-4">
                    <label>Зэрэг:</label>
                    <select class="form-control" id="elevelID" name="levelID">
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
                    <select class="form-control" name="mainOrgID" id="emainOrgID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($organizations as $organization)
                        <option value="{{$organization->id}}">{{$organization->fullName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Дэмжлэг үзүүлэх байгууллага</label>
                    <select class="form-control" name="supportOrgID" id="esupportOrgID">
                        <option value="-1">Сонгоно уу</option>
                      @foreach ($organizations as $organization)
                        <option value="{{$organization->id}}">{{$organization->fullName}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAxaxUpdate" class="btn btn-primary">Хадгалах</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
