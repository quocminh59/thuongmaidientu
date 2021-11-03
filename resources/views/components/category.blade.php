 <div class="home-category">
    @foreach ($data['parentCategories'] as $key => $item)
        <div class="parent-category">
            {!! $data['icons'][$key] !!}
            <p>{{ $item['category_name'] }}</p>
        </div>
    @endforeach
    <div class="wrap-subcategory">
        @foreach ($data['parentCategories'] as $key => $item)
            <div class="sub-category">
                @foreach ($data['subCategories'][$key] as $sub)
                    @if ($sub["category_code"] == $item["category_id"])
                        <div class="sub-item">
                            <div class="sub-first">
                                <span>{{ $sub["category_name"] }}</span>
                            </div>
                            <div class="sub-second">
                                @foreach ($data['subCategories'][$key] as $subt)
                                    @if ($subt["category_code"] == $sub["category_id"])
                                        <span>{{ $subt["category_name"] }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div>
        @endforeach
    </div>
</div> 