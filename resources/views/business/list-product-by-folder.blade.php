@extends('layout')
@section('title', $folderFather->name)
@section('description', $folderFather->description)
@section('content')
    <h1 class="text-center text-uppercase mt-3 h1-header">Sản phẩm của {{$folderFather->name}}</h1>
    <div class="album py-2">
        <div class="container-fluid">
            @if($list->count() == 0 || $currentProduct == null)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row mx-1">
                    <div class="col-8">
                        <div class="card border bg-light p-0 w-75 m-auto">
                            <div>
                                <ul class="nav nav-tabs" id="image-video-product" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Xem hình ảnh</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">Xem video</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-1">
                                <div class="tab-content" id="image-video-productContent">
                                    <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="image-tab">
                                        <div class="card-body p-0">
                                            <div id="carouselExampleIndicators{{$currentProduct->id}}" class="carousel slide" data-interval="false">
                                                <div class="carousel-inner">
                                                    <?php $no = 0; ?>
                                                    @foreach($listImage as $image)
                                                        @if($image->product_id == $currentProduct->id)
                                                            <div class="carousel-item-div carousel-item{{$no == 0 ? ' active' : ''}}">
                                                                <img class="carousel-item-img m-auto h-100 rounded d-block" src="{{ url($image->path . $image->name_to_store) }}" alt="">
                                                            </div>
                                                            <?php $no++; ?>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators{{$currentProduct->id}}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators{{$currentProduct->id}}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <ol class="carousel-indicators carousel-indicators-custom m-0">
                                                <?php $no = 0; ?>
                                                @foreach($listImage as $image)
                                                    @if($image->product_id == $currentProduct->id)
                                                        <li data-target="#carouselExampleIndicators{{$currentProduct->id}}" data-slide-to="{{$no}}" class="active bg-light" style="height: 40px">
                                                            <img class="rounded d-block h-100 m-auto" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" width="40px" alt="">
                                                        </li>
                                                        <?php $no++; ?>
                                                    @endif
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                        <div class="card-body p-0">
                                            <div class="mx-auto iframe-youtube">
                                                <iframe src="https://www.youtube.com/embed/{{$currentProduct->youtube}}"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-75 mx-auto mt-3">
                            <strong>Share on: </strong>
                            <a class="mr-1" href="https://www.facebook.com/sharer.php?u={{url('')}}/pf/{{$folderFather->id}}/{{$currentProduct->id}}/{{strtolower(str_replace(" ","-",$currentProduct->text_domain))}}">
                                <img src="{{ url('images/facebook.png') }}" alt="facebook">
                            </a>
                            <a class="mr-1" href="https://www.facebook.com/sharer.php?u={{url('')}}/pf/{{$folderFather->id}}/{{$currentProduct->id}}/{{strtolower(str_replace(" ","-",$currentProduct->text_domain))}}">
                                <img src="{{ url('images/zalo.png') }}" alt="zalo">
                            </a>
                            <a class="mr-1" href="https://www.facebook.com/sharer.php?u={{url('')}}/pf/{{$folderFather->id}}/{{$currentProduct->id}}/{{strtolower(str_replace(" ","-",$currentProduct->text_domain))}}">
                                <img src="{{ url('images/instagram.png') }}" alt="instagram">
                            </a>
                            <a class="mr-1" href="https://www.facebook.com/sharer.php?u={{url('')}}/pf/{{$folderFather->id}}/{{$currentProduct->id}}/{{strtolower(str_replace(" ","-",$currentProduct->text_domain))}}">
                                <img src="{{ url('images/gmail.png') }}" alt="gmail">
                            </a>
                            <a class="mr-1" href="https://www.facebook.com/sharer.php?u={{url('')}}/pf/{{$folderFather->id}}/{{$currentProduct->id}}/{{strtolower(str_replace(" ","-",$currentProduct->text_domain))}}">
                                <img src="{{ url('images/telegram.png') }}" alt="telegram">
                            </a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border bg-light p-0" style="height: 550px">
                            <div>
                                <ul class="nav nav-tabs" id="product-info" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="rg-tab" data-toggle="tab" href="#rg" role="tab" aria-controls="rg" aria-selected="true">Đăng ký thông tin sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="false">Thông tin kỹ thuật</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Đăng ký tư vấn</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body overflow-auto my-2">
                                <div class="tab-content" id="product-infoContent">
                                    <div class="tab-pane fade show active" id="rg" role="tabpanel" aria-labelledby="rg-tab">
                                        <div class="card-body">
                                            <form method="post" action="/rg/{{$currentProduct->id}}/dang-ky-thong-tin-san-pham">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Tên sản phẩm:&nbsp;</label><label><h1 class="font-weight-bold" style="font-size: larger">{{$currentProduct->name}}</h1></label>
                                                    <input class="form-control" type="hidden" name="product_id" value="{{$currentProduct->id}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="qty">Số lượng</span>
                                                    </div>
                                                    <input type="text" class="form-control @error('qty') is-invalid @enderror" aria-label="Default" aria-describedby="qty" name="qty" value="{{old('qty')}}" autofocus>
                                                    @error('qty')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="specification">Quy cách</span>
                                                    </div>
                                                    <input type="text" class="form-control @error('specification') is-invalid @enderror" aria-label="Default" aria-describedby="specification" name="specification" value="{{old('specification')}}">
                                                    @error('specification')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="phone">Điện thoại liên hệ</span>
                                                    </div>
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" aria-label="Default" aria-describedby="phone" name="phone" value="{{old('phone')}}">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="email">Email</span>
                                                    </div>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" aria-label="Default" aria-describedby="email" name="email" value="{{old('email')}}">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="note">Ghi chú</span>
                                                    </div>
                                                    <textarea class="form-control @error('note') is-invalid @enderror" type="text" name="note" autocomplete="note">{{old('note')}}</textarea>
                                                    @error('note')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    {!! NoCaptcha::renderJs() !!}
                                                    {!! NoCaptcha::display() !!}
                                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                                        <div class="card-body text-left">
                                            <p class="card-text p-0 m-0"><label class="font-weight-bold">Sơ lược: </label> {{$currentProduct->summary}}</p>
                                            <p class="card-text p-0 m-0"><label class="font-weight-bold">Mã sản phẩm: </label> {{$currentProduct->code ?? 'Đang cập nhật'}}</p>
                                            <p class="card-text p-0 m-0"><label class="font-weight-bold">Đơn giá: </label> {{number_format($currentProduct->price) ?? 'Đang cập nhật'}}đ</p>
                                            <p class="card-text p-0 m-0"><label class="font-weight-bold">Trạng thái: </label> {{$currentProduct->active == 1 ? 'Đang hoạt động' : 'Không hoạt động'}}</p>
                                            <label class="font-weight-bold">Mô tả:</label>
                                            <div class="container">{!! $currentProduct->introduce !!}</div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <section>
                        <div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2 product-carousel" data-ride="carousel" data-interval="false">
                            <div class="controls-top my-3 ml-1">
                                <a class="btn btn-secondary btn-sm" href="#carousel-example-multi" data-slide="prev"><i class="carousel-control-prev-icon"></i></a>
                                <a class="btn btn-secondary btn-sm" href="#carousel-example-multi" data-slide="next"><i class="carousel-control-next-icon"></i></a>
                            </div>
                            <ol class="carousel-indicators">
                                <?php $no = 0; ?>
                                @foreach($list as $i => $item)
                                    <li data-target="#carousel-example-multi" data-slide-to="{{$no}}" class="{{$no == 0 ? ' active' : ''}}"></li>
                                    <?php $no++; ?>
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php $no = 0; ?>
                                @foreach($list as $i => $item)
                                    <div class="carousel-item{{$no == 0 ? ' active mx-auto' : ''}}">
                                        <div class="col-12 col-md-4 col-lg-2">
                                            <div class="card mb-2">
                                                <div class="view overlay">
                                                    @foreach($listImage as $image)
                                                        @if($image->product_id == $item->id)
                                                            <img class="card-img-top" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$item->name}}</h5>
                                                    <p class="card-text">{{$item->summary}}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <a type="button" class="btn btn-sm btn-outline-secondary card-text" href="/pf/{{$folderFather->id}}/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $no++; ?>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            @endif
        </div>
    </div>
@endsection
