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
                        <div class="card border bg-light p-0" style="height: 450px">
                            <div>
                                <ul class="nav nav-tabs" id="image-video-product" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="true">Đăng ký thông tin sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">Thông tin kỹ thuật</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body overflow-auto my-2">
                                <div class="tab-content" id="image-video-productContent">
                                    <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="image-tab">
                                        <div class="card-body">
                                            image
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                        <div class="card-body">
                                            video
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border bg-light p-0" style="height: 450px">
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
                <div>
                    <div class="card-group mt-5 row">
                        @foreach($list as $i => $item)
                            <div class="card col-2 card-hover">
                                @foreach($listImage as $image)
                                    @if($image->product_id == $item->id)
                                        <img class="card-img-top" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                                        @break
                                    @endif
                                @endforeach
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->name}}</h5>
                                    <p class="card-text">{{$item->summary}}</p>
                                </div>
                                <div class="card-footer">
                                    <a type="button" class="btn btn-sm btn-outline-secondary card-text" href="/pf/{{$folderFather->id}}/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">Xem chi tiết</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
