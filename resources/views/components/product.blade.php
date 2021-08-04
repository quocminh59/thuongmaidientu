<div id="product">
    <div class="wrap-products">
        <div id="product-main">
            <div class="scaffold">
                <div class="scaffold-header">
                    <h2>Laptop Gaming</h2>
                    <div class="sub-title">
                        <span>Laptop Asus </span>
                        <span>Laptop Dell </span>
                        <span>Laptop HP</span>
                        <span>Laptop Acer</span>
                        <span>Laptop MSI</span>
                    </div>
                    <a href="" class="show-all">Xem tất cả</a>
                </div>
                
                <div id="carousel-laptop" class="owl-carousel owl-theme scaffold-main">
                    @for ($i = 0; $i < count($products[12]); $i++)
                    <div class="product-item item">
                        <div class="product-image">
                            <a href="{{ route('show.productdetail', ['slug' => $products[12][$i]['slug']]) }}">
                                <img src="{{ asset($products[12][$i]['feature_image']) }}" alt="">
                            </a>
                        </div>
                        
                        <div class="rating">
                            @for ($j = 0; $j < 5; $j++)
                                <span class="fal fa-star" style="color:#80808082; font-size:1.5rem"></span>
                            @endfor
                            <span>(0)</span>
                            <span class="product-code">Mã: LTLG012</span>
                        </div>
                        
                        <div class="product-item-main">
                            <span class="product-name">
                                <a href="">{{ $products[12][$i]['name'] }}</a>
                            </span>
                            <div class="product-old-cost">
                                <span style="text-decoration: line-through">{{ number_format($products[12][$i]['price'], 0, ',', '.') }} đ</span>
                                <span class="product-sales">(Tiết kiệm: {{ $products[12][$i]['sales_percent']*100 }}% )</span>
                            </div>
                            <span class="product-price">{{ number_format($products[12][$i]['lastprice'], 0, ',', '.') }} đ</span>
                            <div class="product-status">
                                <strong class="fal fa-check"></strong>
                                <span>Còn hàng</span>
                            </div>
                            <span class="product-cart">
                                <a @click="addCart()"><i class="fal fa-shopping-cart"></i></a>
                            </span>     
                        </div>
                    </div>
                    @endfor 
                </div>
            </div>
            {{--  AddCart({{ $products[12][$i]['id'] }})  --}}
        </div>
    </div>
</div>