@extends('layout')
@section('title', $product->name)
@section('description', $product->summary)
@section('meta')
    <!-- META FOR FACEBOOK -->
    <meta property="og:site_name" content="{{config('app.url')}}"/>
    <meta property="og:rich_attachment" content="true"/>
    <meta property="og:type" content="article"/>
    <meta property="article:publisher" content="https://www.facebook.com/congdongvnexpress/"/>
    <meta property="og:url" itemprop="url" content="{{config('app.url')}}/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}"/>
    @foreach($listImage as $image)
        <meta property="og:image" itemprop="thumbnailUrl" content="{{ url($image->path . $image->name_to_store) }}"/>
        @break
    @endforeach
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="354"/>
    <meta content="'{{$product->name}}'" itemprop="headline" property="og:title"/>
    <meta content="{{$product->summary}}" itemprop="description" property="og:description"/>
    <meta property="article:tag" content="{{$product->name}}"/>
    <meta name="liston_category" content="1003159,1003184"/>
    <meta name="tt_site_id_detail" content="1003159" catename="Kinh doanh"/>
    <!-- END META FOR FACEBOOK -->
@endsection
@section('content')
    <div class="album">
        <h1 class="container card-header text-center bg-secondary text-light text-uppercase box-shadow">Chi tiết {{$product->name}}</h1>
        <div class="container bg-light box-shadow rounded-bottom">
            <div class="custom-modal-content py-5">
                <div class="col-12">
                    <label class="font-weight-bold">Một số hình ảnh của sản phẩm:</label>
                    <ol class="carousel-indicators carousel-indicators-custom mx-0">
                        <?php $no = 0; ?>
                        @foreach($listImage as $image)
                            <li data-target="#carouselExampleIndicators{{$product->id}}" data-slide-to="{{$no}}" class="active">
                                <img class="rounded d-block w-100" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                            </li>
                            <?php $no++; ?>
                        @endforeach
                    </ol>
                    <div id="carouselExampleIndicators{{$product->id}}" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            <?php $no = 0; ?>
                            @foreach($listImage as $image)
                                <div class="carousel-item{{$no == 0 ? ' active' : ''}}">
                                    <img class="rounded d-block w-100 border border-secondary" src="{{ url($image->path . $image->name_to_store) }}" alt="">
                                </div>
                                <?php $no++; ?>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators{{$product->id}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators{{$product->id}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                @if($product->youtube != null)
                    <div class="col-10 mx-auto my-3">
                        <iframe src="https://www.youtube.com/embed/{{$product->youtube}}"></iframe>
                    </div>
                @endif
                <div class="col-12">
                    <div class="card-body text-left">
                        <p class="card-text"><label class="font-weight-bold">Sơ lược: </label> {{$product->summary}}</p>
                        <p class="card-text"><label class="font-weight-bold">Mã sản phẩm: </label> {{$product->code ?? 'Đang cập nhật'}}</p>
                        <p class="card-text"><label class="font-weight-bold">Đơn giá: </label> {{number_format($product->price) ?? 'Đang cập nhật'}}đ</p>
                        <p class="card-text"><label class="font-weight-bold">Trạng thái: </label> {{$product->active == 1 ? 'Đang hoạt động' : 'Không hoạt động'}}</p>
                        <label class="font-weight-bold">Mô tả:</label>
                        <div class="container">{!! $product->introduce !!}</div>
                        <a href="/rg/dang-ky-thong-tin-san-pham/{{$product->id}}" class="btn btn-info">Đăng ký thông tin sản phẩm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
