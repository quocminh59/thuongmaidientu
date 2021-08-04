@extends('layouts.app')

@section('content')
<div class="wrap-login">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
        </ol>
    </nav>

    <div class="main-login">
        <div class="header">ĐĂNG NHẬP</div>
        <div class="main-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email">Email</label>
                    <div class="wrap-input">
                        <input id="email" type="email" class="form form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password">Mật khẩu</label>
                    <div class="wrap-input">
                        <input id="password" type="password" class="form form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label></label>
                    <div class="form-check">
                        <input class="check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="check-label" for="remember">Remember me</label>
                    </div>
                </div>

                <div class="mb-3 lgin">
                    <label></label>
                    <button type="submit" class="btn btn-danger btn-login">Đăng Nhập</button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection
