@extends('layouts.user.template')

@section('content')
    @include('layouts.user.partials.header')   
    <!-- Banner Area Start -->
    <div class="banner-area-wrapper">
        <div class="banner-area text-center">   
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-content-wrapper">
                            <div class="banner-content">
                                <h2>Recuperar Contraseña</h2> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="login-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    @if (Session::has('msj-exitoso'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <strong>{{ Session::get('msj-exitoso') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Session::has('msj-erroneo'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <strong>{{ Session::get('msj-erroneo') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h2>Recuperar Contraseña</h2>
                                <span>Por favor, ingresa tu correo electrónico.</span>
                            </div>
                            <div class="login-form">
                                <form action="{{ route('reset-password') }}" method="POST">
                                    @csrf
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <div class="text-center">
                                        <button type="submit" class="default-btn">Restablecer Contraseña</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection