@extends('layouts.auth')

@section('content')
    <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
        <img src="{{ asset('admin-template/app-assets/images/pages/login.png') }}" alt="branding logo">
    </div>
    <div class="col-lg-6 col-12 p-0">
        <div class="card rounded-0 mb-0 px-2">
            <div class="card-header pb-1">
                <div class="card-title">
                    <h4 class="mb-0">Login</h4>
                </div>
            </div>
            <p class="px-2">Welcome back, please login to your account.</p>
            <div class="card-content">
                <div class="card-body pt-1">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico" required>
                            <div class="form-control-position">
                                <i class="feather icon-user"></i>
                            </div>
                            <label for="user-name">Correo</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>

                        <fieldset class="form-label-group position-relative has-icon-left">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Contraseña" required>
                            <div class="form-control-position">
                                <i class="feather icon-lock"></i>
                            </div>
                            <label for="user-password">Contraseña</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="text-right"><a href="auth-forgot-password.html" class="card-link">¿Olvidaste la contraseña?</a></div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right btn-inline">Entrar</button>
                    </form>
                </div>
            </div>
            <div class="login-footer">
                <div class="divider">
                </div>
            </div>
        </div>
    </div>
@endsection