@extends('layout')
@section('title', $folderFather->name)
@section('description', $folderFather->description)
@section('content')
    <h1 class="text-center text-uppercase mt-3 h1-header">Sản phẩm của {{$folderFather->name}}</h1>
    <div class="album py-2">
        <div class="container-fluid">
            <div class="row mx-1">
                <div class="col-6">

                </div>
                <div class="card col-6 border bg-light overflow-auto p-0" style="height: 450px">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Đăng ký thông tin sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thông tin kỹ thuật</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Nhận tư vấn</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <form method="post" action="/rg/{{$list[0]->id}}/dang-ky-thong-tin-san-pham">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên sản phẩm:&nbsp;</label><label><h1 class="font-weight-bold" style="font-size: larger">{{$list[0]->name}}</h1></label>
                                            <input class="form-control" type="hidden" name="product_id" value="{{$list[0]->id}}">
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
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-body text-left">
                                    <p class="card-text p-0 m-0"><label class="font-weight-bold">Sơ lược: </label> {{$list[0]->summary}}</p>
                                    <p class="card-text p-0 m-0"><label class="font-weight-bold">Mã sản phẩm: </label> {{$list[0]->code ?? 'Đang cập nhật'}}</p>
                                    <p class="card-text p-0 m-0"><label class="font-weight-bold">Đơn giá: </label> {{number_format($list[0]->price) ?? 'Đang cập nhật'}}đ</p>
                                    <p class="card-text p-0 m-0"><label class="font-weight-bold">Trạng thái: </label> {{$list[0]->active == 1 ? 'Đang hoạt động' : 'Không hoạt động'}}</p>
                                    <label class="font-weight-bold">Mô tả:</label>
                                    <div class="container">{!! $list[0]->introduce !!}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
            @if($list->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row text-center">
                    @foreach($list as $i => $item)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100 card-hover">
                                @foreach($listImage as $image)
                                    @if($image->product_id == $item->id)
                                        <img class="card-img-top" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                                        @break
                                    @endif
                                @endforeach
                                <div class="card-body">
                                    <h2 class="card-title">{{$item->name}}</h2>
                                    <p class="card-text p-0 m-0">{{$item->summary}}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center m-2">
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-sm btn-outline-secondary" href="/rg/{{$item->id}}/dang-ky-thong-tin-san-pham">Đăng ký</a>
                                        <a type="button" class="btn btn-sm btn-outline-secondary" href="/p/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
