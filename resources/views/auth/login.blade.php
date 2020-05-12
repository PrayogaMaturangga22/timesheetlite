@extends('logintemplate')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12" style="padding-top: 15%;">
                            <div style="padding-top: 20px;">
                                <img style="display: block; margin-left: auto; margin-right: auto; width: 50px; margin-bottom: 10px;" src="{{ URL::asset('img/logo.png') }}" alt="" height="50px">
                                <h2 style="font-family: Century Gothic; text-align: center;"><strong>mytimesheet</strong><span style="font-size: 14px;">.id</span></h2>
                                <h2 style="text-align: center;">Data Center</h2>
                            </div>        
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12" style="padding-top: 30px;">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>
        
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>
        
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="captcha">Captcha</label>
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @if($errors->first('g-recaptcha-response') != "")
                                        <span class="text-danger">Please complete captcha validation</span>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
        
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
                </div>
                <div class="form-group row mb-0" style="padding-top: 20px;">
                    <div class="col-md-12">
                        <p style="text-align: center;">&copy; 2020 PT. Ganeshcom Studio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
