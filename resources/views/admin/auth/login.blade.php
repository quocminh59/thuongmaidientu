<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="{{ asset('css\app.css') }}">
    <link rel="stylesheet" href="{{ asset('css\style\admin.css') }}">
</head>
<body>
    <div class="wrap-login">
       <div class="background">
           <img src="{{ asset('images/login.jpg') }}" alt="">
       </div>
       <div class="main-form">
            <div class="header">
                <img src="{{ asset('images/admin.png')}}" alt="">
                <p>Quản Trị Viên</p>
            </div>
            <div class="login">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="wrap-input">
                             <input id="username" placeholder="Username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
     
                             @error('username')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                        </div>            
                    </div>
     
                    <div class="mb-3">
                         <div class="wrap-input">
                             <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
     
                             @error('password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                    </div>
                    <div class="mb-3">
                        <div class="wrap-input">
                            <input type="submit" class="btn btn-success" value="Đăng Nhập">
                        </div>
                    </div>
                </form>
            </div>
       </div>
    </div>

    @if ( isset($message) && $message != '')
        <script type="text/javascript">
            alert($message);
        </script>
    @endif
</body>
    <script src="{{ asset('js\app.js') }}"></script>
</html>
