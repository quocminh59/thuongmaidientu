<div class="wrap-menu-scroll display">
    <br>
    <div class="brand">
        <a href="/"><img src="{{ asset('images/logo.png') }}" alt="quocminhpc" style="width: 5.5rem;"></a>
    </div>
    <div class="btn-cate">
        <i class="fal fa-bars"></i>
        <span>Danh mục sản phẩm</span>
        <div class="space"></div>
        <div class="category-scroll display">
            @include('components.category')
        </div>
    </div>
    <div class="search-scroll">
        <input type="text" name="inputsearch" placeholder="Nhập từ khóa cần tìm kiếm">
        <div class="btn-search"><i class="fal fa-search"></i></div>
    </div>
    <div class="other">
        <a href="#" class="coupon function">
            <i class="fal fa-tags cd"></i>
            <span class="ct">Khuyến mãi</span>
        </a>
        <a href="#" class="donhang function">
            <i class="fal fa-clipboard-check cd"></i>
            <span class="ct">Đơn hàng</span>
        </a>

        @guest()
            <div class="wrap-user">
                <a class="user function">
                    <i class="fal fa-user-circle cd"></i>
                    <span class="ct">Đăng nhập</span>
                </a>
                <div class="panel hidden">
                    <a href="{{ route('login') }}" class="login auth">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="register auth">Đăng ký</a>
                    <a href="" class="facebook auth">Đăng nhập với facebook</a>
                    <a href="" class="google auth">Đăng nhập với google</a>
                </div>
            </div>
        @else
            <div class="wrap-user">
                <a class="user function">
                    <i class="fas fa-user-circle cd"></i>
                    @php
                        function name($string) {
                            $array = explode(" ", $string);
                            $number = count($array);
                            if($number > 1) return $array[$number-2].' '.$array[$number-1];
                            return $array[$number-1];
                        }
                    @endphp
                    <span class="ct">@php
                        echo name(Auth::user()->name);
                    @endphp</span>
                </a>
                <div class="panel hidden">
                    <a href="" class="login auth">Thông tin tài khoản</a>
                    <a href="" class="register auth">Quản lý đơn hàng</a>
                    <a href="" class="facebook auth">Sổ địa chỉ</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" value="Thoát" class="auth">
                    </form>
                </div>
            </div>   
        @endguest

        <a href="#" class="giohang function">
            <i class="fal fa-shopping-cart cd"></i>
            <span class="ct">Giỏ hàng</span>
        </a>
    </div>

</div>