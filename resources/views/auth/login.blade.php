@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <br>
        <br>
        <div class="col-md-1 col-form-label text-md-right"></div>
        <div class="col-md-8" style="margin-bottom: 500px">
            <br>
            <br>
            <br>
            <b-card>
            <div class="title m-b-md" style="text-align: center">
                <h1>LOGO</h1>
                <h3>E-mail: admin@gmail.com</h3>
                <h3>Password : 123456</h3>
            </div>
            <div style="padding-top:20px;">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-1 col-form-label text-md-right"></div>
                            <div class="col-md-10">
                                <label for="email" class="text-muted" style="font-family:Tahoma">E-mail</label>
                                <b-input size="lg" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1 col-form-label text-md-right"></div>
                        </div>
                        <div class="form-group row">
                          
                            <div class="col-md-1 col-form-label text-md-right"></div>
                            <div class="col-md-10">
                                <label for="password" class="text-muted" style="font-family:Tahoma">Password</label>
                                <b-input size="lg" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1 col-form-label text-md-right"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 offset-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-1">
                                <button type="submit" class="btn btn-outline-secondary btn-lg"  style="width: 100%;">
                                    {{ __('Login') }}
                                </button>
                                <br>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <br>
        </b-card>
        
        </div>
        
    </div>
</div>
@endsection
