<div id="modalUserEdit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хэрэглэгчийн мэдээлэл засах</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmNewUser" method="POST" action="{{ route('register') }}">
                  @csrf

                  <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Хэрэглэгчийн нэр:</label>

                      <div class="col-md-6">
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="email" class="col-md-4 col-form-label text-md-right">Нэвтрэх цахим хаяг:</label>

                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Хэрэглэгчийн төвшин:</label>

                      <div class="col-md-6">
                          <select class="form-control" id="cmbPermission" name="permission">
                              <option value="0">Сонгоно уу</option>
                              <option value="1">Бүрэн эрх</option>
                              <option value="2">Аймгийн эрх</option>
                              <option value="3">Байгууллагын эрх</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group row d-none" id="divProvince">
                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Аймаг:</label>

                      <div class="col-md-6">
                          <select class="form-control" id="cmbProvince" name="province">
                              <option value="0">Сонгоно уу</option>
                              @foreach ($provinces as $province)
                                  <option value="{{$province->provCode}}">{{$province->provName}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group row d-none" id="divOrganization">
                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Албан байгууллага:</label>

                      <div class="col-md-6">
                          <select class="form-control" id="cmbOrganization" name="organization">
                              <option value="0">Сонгоно уу</option>
                              @foreach ($organizations as $organization)
                                  <option value="{{$organization->id}}">{{$organization->fullName}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                          <button post-url="{{url('/update/users')}}" id="btnUpdateUser" type="submit" class="btn btn-primary">
                              Засах
                          </button>
                      </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
