@extends('layout')
@section('title', 'Đăng ký thông tin sản phẩm')
@section('description', 'Trang đăng ký thông tin sản phẩm.')
@section('content')
    <div class="card container max-width border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Đăng ký thông tin sản phẩm</h3>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm:&nbsp;</label><label><h1 class="font-weight-bold" style="font-size: larger">{{$product->name}}</h1></label>
                    <input class="form-control" type="hidden" name="product_id" value="{{$product->id}}">
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
                <a type="button" class="btn btn-danger" href="/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}">Hủy</a>
            </form>
        </div>
    </div>
@endsection
