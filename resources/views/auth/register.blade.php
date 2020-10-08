@extends('layouts.layout_master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    <h4 class="text-center"><strong>Хэрэглэгч нэмэх</strong></h4>
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
                                <button id="btnSaveUser" type="submit" class="btn btn-primary">
                                    Хадгалах
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
  <script src="{{url("public/js/users/userNew.js")}}"></script>
@endsection
