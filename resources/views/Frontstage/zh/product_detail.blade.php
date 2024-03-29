@extends('Frontstage.zh.layouts')
@section('content')
    <div id="app">
        <div class="wrap">
            <div class="product-detail flex-row">
                <div class="col"><img src="{{ $product['image'] }}" alt=""></div>
                <div class="col">
                    <div class="sub-title">{{ $product['acting'] }}</div>
                    <h1>{{ $product['type'] }}</h1>
                    <div class="type">{{ $product['name'] }}</div>
                    @if ($product['features'] != '')
                        <h2>特色說明</h2>
                        <p>{!! $product['features'] !!}</p>
                    @endif
                    @if ($product['remark'] != '')
                        <h2>備註說明</h2>
                        <p>{{ $product['remark'] }}</p>
                    @endif
                    <div class="bottom-btn flex-row">
                        @if ($product['pdf'] !== null)
                            <a href="{{ $product['pdf'] }}" download="{{ $product['pdf_name'] }}.{{ $product['pdf_ext'] }}"
                                class="col hover-scale">檔案下載</a>
                        @endif
                        <a href="javascript:history.back()" class="col hover-scale">
                            < 返回上一頁</a>
                    </div>
                </div>
            </div>
            @if ($product['introduction'] != '')
                <div class="steps">產品說明</div>
                <div class="editor">
                    {!! $product['introduction'] !!}
                </div>
            @endif
            @if (count($product['video_urls']) > 0)
                <div class="steps">產品實績</div>
                <div class="p-video flex-row">
                    @foreach ($product['video_urls'] as $url)
                        <div class="col">
                            <div class="youtube">
                                <img src="{{ asset('Frontstage/images/youtube-base.png') }}" alt="">
                                <iframe src="{{ $url }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="back">
            <a href="javascript:history.back()" class="col hover-scale">
                < 返回上一頁</a>
        </div>
    </div>
@endsection
