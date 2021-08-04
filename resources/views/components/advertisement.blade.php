<div class="area advertisement">
    <div class="carousel" data-flickity='{"autoPlay": true , " wrapAround": true}'>
        <div class="carousel-cell">
            <img src="{{ asset('images/hinh1.jpg') }}"></img>
        </div>
        <div class="carousel-cell">
            <img src="{{ asset('images/hinh2.jpg') }}"></img>
        </div>
        <div class="carousel-cell">
            <img src="{{ asset('images/hinh3.jpg') }}"></img>
        </div>   
    </div>

    <div class="offer">
        <div class="offer-item">
            <img src="{{ asset('images/uudai1.jpg') }}" alt="">
        </div>
        <div class="offer-item">
            <img src="{{ asset('images/uudai2.jpg') }}" alt="">
        </div>
        <div class="offer-item">
            <img src="{{ asset('images/uudai3.jpg') }}" alt="">
        </div>
        <div class="offer-item">
            <img src="{{ asset('images/uudai4.jpg') }}" alt="">
        </div>
    </div>

     @include('components.category') 

    <div class="infor">
        <div class="infor-item">
            <img src="{{ asset('images/news.jpg') }}" alt="">
        </div>
        <div class="infor-item">
            <img src="{{ asset('images/build.jpg') }}" alt="">
        </div>
    </div>
</div>