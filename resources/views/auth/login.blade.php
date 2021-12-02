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
                                    <h2>Inicio de Sesión</h2> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- Banner Area End -->
        <!-- Login start -->
        <div class="login-area pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <div class="login">
                            <div class="login-form-container">
                                <div class="login-text">
                                    <h2>Iniciar Sesión</h2>
                                    <span>Por favor, ingresa con tus datos de usuario.</span>
                                </div>
                                <div class="login-form">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <fieldset class="form-label-group form-group position-relative has-icon-left">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </fieldset>

                                        <fieldset class="form-label-group position-relative has-icon-left">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Contraseña" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </fieldset>
                                        <div class="form-group d-flex justify-content-between align-items-center">
                                            <div class="text-right"><a href="{{ route('forgot-password') }}" class="card-link">¿Olvidaste la contraseña?</a></div>
                                        </div>
                                        <div class="button-box text-center">
                                            <button type="submit" class="default-btn">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login end --> 
@endsection


