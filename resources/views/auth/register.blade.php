@extends('layouts.app')

@section('content')
<div class="wrap-register">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
        </ol>
    </nav>

    <div class="main-register">
        <div class="header">ĐĂNG KÝ</div>
        <div class="main-form">
            <form method="post" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="email">Địa chỉ Email</label>
                    <div class="wrap-input">
                        <input id="email" type="email" class="form form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                        <input id="password" type="password" class="form form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password-confirm">Nhập lại mật khẩu</label>
                    <div class="wrap-input">
                        <input id="password-confirm" type="password" class="form form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name">Họ và tên</label>
                    <div class="wrap-input">
                        <input id="name" type="text" class="form form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sex">Giới tính</label>
                    <div class="wrap-input sex">
                        <div class="rd">
                            <input id="male" type="radio" class=" @error('sex') is-invalid @enderror" name="sex" value="Nam" required autocomplete="sex" autofocus>
                            Nam
                        </div>
                        <div class="rd">
                            <input id="female" type="radio" class=" @error('sex') is-invalid @enderror" name="sex" value="Nữ" required autocomplete="sex" autofocus>
                            Nữ
                        </div>

                        @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="birthday">Ngày sinh</label>
                    <div class="wrap-input">
                        <input id="birthday" type="date" class="form form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>
                        @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="phone">Điện thoại di động</label>
                    <div class="wrap-input">
                        <input id="phone" type="text" class="form form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label></label>
                    <button type="submit" class="btn btn-primary btn-register">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
