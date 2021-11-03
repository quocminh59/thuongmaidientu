@extends('layouts.app')
@php
    $para = json_decode($product['0']['specifications']);
@endphp
{{--  {{ dd($brand) }}  --}}
<link rel="stylesheet" href="{{ asset('css\style\productdetail.css') }}">
@section('content')

<div class="breadcumb">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $product[0]['name'] }}</li>
        </ol>
    </nav>
</div>
{{--  {{  dd($productImage ) }}  --}}
<div class="wrap-main">
    <div class="main-header">
        <h1>{{ $product[0]['name'] }}</h1>
    </div>
    <div class="main-content">
        <div class="slide-image">
            <div class="image-main">
                <img src="{{ asset($product[0]['feature_image']) }}" alt="">
            </div>
            <div class="image-sub">
                @foreach ($productImage as $itemImage)
                    <img src="{{ asset($itemImage['image_path']) }}" alt="">
                @endforeach
            </div>
        </div>

        <div class="para">
            <div class="para-review">
                <span class="flex">
                    <p>Đánh giá:</p>
                    <p style="padding-left: 1rem;">
                        <i class="fal fa-star"></i>
                        <i class="fal fa-star"></i>
                        <i class="fal fa-star"></i>
                        <i class="fal fa-star"></i>
                        <i class="fal fa-star"></i>
                    </p>
                </span>
                <span class="flex flex-end">Lượt xem: {{ $product[0]['access_times'] }}</span>
            </div>

            <div class="para-product">
                <strong>Thông số sản phẩm</strong>
                <span class="para-product-list">
                    <ul>
                        <li>CPU: {{ $para->cpu }}</li>
                        <li>RAM: {{ $para->ram }}</li>
                        <li>Ổ cứng: {{ $para->harddisk }}</li>
                        <li>VGA: {{ $para->vga }}</li>
                        <li>Màn hình: {{ $para->monitor }}</li>
                        <li>HĐH: {{ $para->operating }}</li>
                        <li>Pin: {{ $para->pin }}</li>
                        <li>Màu: {{ $para->color }}</li>
                    </ul>
                </span>
            </div>

            <div class="product-price">
                <span class="lastprice">{{ number_format($product[0]['lastprice'], 0, ',', '.') }} đ</span>
                <span class="firstprice">{{ number_format($product[0]['price'], 0, ',', '.') }} đ</span>
                @php
                    $saleprice = $product[0]['price'] - $product[0]['lastprice'];
                @endphp
                <span class="saleprice">Tiết kiệm {{ number_format($saleprice, 0, ',', '.') }} đ</span>
            </div>

            <div class="vat">
                <span>Giá đã có VAT</span>
                <span>Bảo hành 12 tháng</span>
            </div>

            <div class="product-gift">
                <div class="gift-header">
                    <i class="fal fa-gift"></i>
                    <span>Quà tặng và ưu đãi kèm theo</span>
                </div>
                <div class="gift-content">
                    {!! $product[0]['gift'] !!}
                </div>
            </div>

            <div class="product-button">
                <p>Số lượng: </p>
                <div class="number-input">
                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                    <input class="quantity" min="0" name="quantity" value="1" type="number">
                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                </div>
                <div class="buttoncart">
                    <i class="fal fa-cart-plus"></i>
                    <span>Thêm vào giỏ hàng</span>
                </div>
            </div>

            <div class="buy">
                <strong>Đặt mua ngay</strong>
                <span>Giao hàng tận nơi nhanh chóng</span>
            </div>
        </div>

        <div class="info">
            <div class="info-wrap">
                <div class="info-header">SẢN PHẨM ĐANG CÓ SẴN TẠI</div>
                <div class="info-list">
                    <ul>
                        <li>131 Lê Thanh Nghị - Q. Hai Bà Trưng - Hà Nội</li>
                        <li>43 Thái Hà - Q. Đống Đa - Hà Nội</li>
                        <li>79 Nguyễn Văn Huyên - Q. Cầu Giấy - Hà Nội</li>
                        <li>511 Quang Trung - Q. Hà Đông - Hà Nội</li>
                        <li>520 Cách Mạng Tháng 8 - Quận 3 - TP HCM</li>
                        <li>299 Minh Khai - Từ Sơn - Bắc Ninh</li>
                        <li>59 Thợ Nhuộm - Q. Hoàn Kiếm - Hà Nội</li>
                    </ul>
                </div>
            </div>

            <div class="info-wrap">
                <div class="info-header">YÊN TÂM MUA HÀNG</div>
                <div class="info-list">
                    <ul>
                        <li>Uy tín 20 năm xây dựng và phát triển</li>
                        <li>Sản phẩm chính hãng 100%</li>
                        <li>Đổi trả hàng miễn phí trong 3 ngày</li>
                        <li>Trả góp lãi suất 0% toàn bộ giỏ hàng</li>
                        <li>Trả bảo hành tận nơi sử dụng</li>
                        <li>Bảo hành tận nơi cho doanh nghiệp</li>
                        <li>Ưu đãi riêng cho học sinh sinh viên</li>
                        <li>Vệ sinh miễn phí trọn đời PC, Laptop</li>
                    </ul>
                </div>
            </div>

            <div class="info-wrap">
                <div class="info-header">MIỄN PHÍ GIAO HÀNG</div>
                <div class="info-list">
                    <ul>
                        <li>Giao hàng siêu tốc trong 2h</li>
                        <li>Giao hàng miễn phí toàn quốc</li>
                        <li>Nhận hàng và thanh toán tại nhà (ship COD)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrap-product-footer">
    <div class="product-describe">
        <h1>Đánh giá chi tiết sản phẩm</h1>
        <div class="product-content">
            {!! $product[0]['content'] !!}
        </div>
        <div class="button-content">
            <span>Xem thêm</span>
            <i class="fal fa-chevron-down"></i>
        </div>
    </div>
    <div class="speciations">
        <h1>Thông số kỹ thuật</h1>
        <table class="table table-default table-striped collap">
            <tbody>
                <tr style="display: none;"></tr>
                <tr>
                    <th scope="row">Hãng sản xuất</th>
                    <td>{{ $brand[0]['brand_name'] }}</td>
                </tr>
                <tr>
                    <th scope="row">Chủng loại</th>
                    <td>
                        @if (isset($para->type ))
                        {{ $para->type   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Part Number</th>
                    <td>
                        @if (isset($para->partnumber ))
                        {{ $para->partnumber   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Màu sắc</th>
                    <td>
                        @if (isset($para->color ))
                        {{ $para->color  }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Bộ vi xử lý</th>
                    <td>
                        @if (isset($para->cpu ))
                        {{ $para->cpu   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Chipset</th>
                    <td>
                        @if (isset($para->chipset ))
                        {{ $para->chipset   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Bộ nhớ trong</th>
                    <td>
                        @if (isset($para->ram ))
                        {{ $para->ram   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Số khe cắm</th>
                    <td>
                        @if (isset($para->numberofram))
                        {{ $para->numberofram  }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Dung lượng tối đa</th>
                    <td>
                        @if (isset($para->maxram ))
                        {{ $para->maxram   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">VGA</th>
                    <td>
                        @if (isset($para->vga ))
                        {{ $para->vga   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Ổ cứng</th>
                    <td>
                        @if (isset($para->harddisk ))
                        {{ $para->harddisk   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Ổ quang</th>
                    <td>
                        @if (isset($para->drive ))
                        {{ $para->drive   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Card Reader</th>
                    <td>
                        @if (isset($para->cardreader ))
                        {{ $para->cardreader   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Màn hình</th>
                    <td>
                        @if (isset($para->monitor ))
                        {{ $para->monitor   }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Webcam</th>
                    <td>
                        @if (isset($para->webcam ))
                        {{ $para->webcam  }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Xem thêm cấu hình chi tiết
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                            <strong>
                                Thông số kỹ thuật chi tiết Laptop MSI Gaming GF63 (10SC-014VN) (i5 10200H/8GB RAM/512GBSSD/GTX1650 4G/15.6 inch FHD 144Hz/Win 10/Đen)
                            </strong>
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-default table-striped expande">
                            <tbody>
                                <tr style="display: none;"></tr>
                                <tr>
                                    <th scope="row">Hãng sản xuất</th>
                                    <td>{{ $brand[0]['brand_name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Chủng loại</th>
                                    <td>
                                        @if (isset($para->type ))
                                        {{ $para->type   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Part Number</th>
                                    <td>
                                        @if (isset($para->partnumber ))
                                        {{ $para->partnumber   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Màu sắc</th>
                                    <td>
                                        @if (isset($para->color ))
                                        {{ $para->color  }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Bộ vi xử lý</th>
                                    <td>
                                        @if (isset($para->cpu ))
                                        {{ $para->cpu   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Chipset</th>
                                    <td>
                                        @if (isset($para->chipset ))
                                        {{ $para->chipset   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Bộ nhớ trong</th>
                                    <td>
                                        @if (isset($para->ram ))
                                        {{ $para->ram   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Số khe cắm</th>
                                    <td>
                                        @if (isset($para->numberofram))
                                        {{ $para->numberofram  }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Dung lượng tối đa</th>
                                    <td>
                                        @if (isset($para->maxram ))
                                        {{ $para->maxram   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">VGA</th>
                                    <td>
                                        @if (isset($para->vga ))
                                        {{ $para->vga   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Ổ cứng</th>
                                    <td>
                                        @if (isset($para->harddisk ))
                                        {{ $para->harddisk   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Ổ quang</th>
                                    <td>
                                        @if (isset($para->drive ))
                                        {{ $para->drive   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Card Reader</th>
                                    <td>
                                        @if (isset($para->cardreader ))
                                        {{ $para->cardreader   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Màn hình</th>
                                    <td>
                                        @if (isset($para->monitor ))
                                        {{ $para->monitor   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Webcam</th>
                                    <td>
                                        @if (isset($para->webcam ))
                                        {{ $para->webcam  }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Audio</th>
                                    <td>
                                        @if (isset($para->audio ))
                                        {{ $para->audio   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Giao tiếp mạng</th>
                                    <td>
                                        @if (isset($para->network ))
                                        {{ $para->network   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Giao tiếp không dây</th>
                                    <td>
                                        @if (isset($para->wifi ))
                                        {{ $para->wifi   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cổng giao tiếp</th>
                                    <td>
                                        @if (isset($para->hub ))
                                        {{ $para->hub   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Pin</th>
                                    <td>
                                        @if (isset($para->pin ))
                                        {{ $para->pin   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Kích thước (rộng x dài x cao)</th>
                                    <td>
                                        @if (isset($para->size ))
                                        {{ $para->size   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cân nặng</th>
                                    <td>
                                        @if (isset($para->weight ))
                                        {{ $para->weight   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Hệ điều hành</th>
                                    <td>
                                        @if (isset($para->operating ))
                                        {{ $para->operating   }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Phụ kiện đi kèm</th>
                                    <td>
                                        @if (isset($para->spare ))
                                        {{ $para->spare   }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
