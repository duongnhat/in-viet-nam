@extends('layout')
@section('title', $product->name)
@section('description', $product->summary)
@section('content')
    <h1 class="card-header text-center bg-secondary text-light text-uppercase">Chi tiết {{$product->name}}</h1>
    <div class="album py-5">
        <div class="container">
            <div class="custom-modal-content">
                <div class="col-12">
                    <ol class="carousel-indicators mx-0">
                        <?php $no = 0; ?>
                        @foreach($listImage as $image)
                            <li data-target="#carouselExampleIndicators{{$product->id}}" data-slide-to="{{$no}}" class="active">
                                <img class="d-block w-100" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                            </li>
                            <?php $no++; ?>
                        @endforeach
                    </ol>
                    <div id="carouselExampleIndicators{{$product->id}}" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            <?php $no = 0; ?>
                            @foreach($listImage as $image)
                                <div class="carousel-item{{$no == 0 ? ' active' : ''}}">
                                    <img class="d-block w-100 border border-secondary" src="{{ url($image->path . $image->name_to_store) }}" alt="">
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
                <div class="col-12">
                    <div class="card-body text-left">
                        <p class="card-text"><label class="font-weight-bold">Sơ lược: </label> {{$product->summary}}</p>
                        <p class="card-text"><label class="font-weight-bold">Mã sản phẩm: </label> {{$product->code ?? 'Đang cập nhật'}}</p>
                        <p class="card-text"><label class="font-weight-bold">Đơn giá: </label> {{number_format($product->price) ?? 'Đang cập nhật'}}đ</p>
                        <p class="card-text"><label class="font-weight-bold">Trạng thái: </label> {{$product->active == 1 ? 'Đang hoạt động' : 'Không hoạt động'}}</p>
                        <label class="font-weight-bold">Mô tả:</label>
                        <div class="container">{!! $product->introduce !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
