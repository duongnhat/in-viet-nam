@extends('layout')
@section('title', 'Đăng ký thông tin sản phẩm')
@section('description', 'Trang đăng ký thông tin sản phẩm.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Đăng ký thông tin sản phẩm</h3>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm: <strong>{{$product->name}}</strong></label>
                    <input class="form-control" type="hidden" name="product_id" value="{{$product->id}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Default</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control @error('qty') is-invalid @enderror" type="text" name="qty" value="{{old('qty')}}" autocomplete="qty" autofocus>
                    @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Quy cách</label>
                    <input class="form-control @error('specification') is-invalid @enderror" type="text" name="specification" value="{{old('specification')}}" autocomplete="specification">
                    @error('specification')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số phone</label>
                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{old('phone')}}" autocomplete="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{old('email')}}" autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" type="text" name="note" autocomplete="note">{{old('note')}}</textarea>
                    @error('note')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
                <a type="button" href="/admin/product/quan-ly-san-pham" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
@endsection
