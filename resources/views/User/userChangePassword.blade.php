<div id="modalUserChangePassword" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Хэрэглэгчийн нууц үг солих</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmChangePasswordUser" method="POST" action="">
                  @csrf

                  <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Хэрэглэгчийн нэр: </label>
                      <div class="col-md-6">
                        <label id="lblChangePasswordUsername" for="name" class="col-md-4 col-form-label text-md-left">Хэрэглэгчийн нэр:</label>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">Нууц үг:</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Нууц үгээ давтана уу:</label>

                      <div class="col-md-6">
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                  </div>

                  <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                          <button post-url="{{url('/change/password/users')}}" id="btnChangePasswordUser" type="submit" class="btn btn-primary">
                              Нууц үг солих
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
