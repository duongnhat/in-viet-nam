@extends('layout')
@section('title', 'Đăng tin tức')
@section('description', 'Trang đăng tin tức lên mạng xã hội.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Đăng bài sản phẩm cho {{$product->name}}</h3>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Bài giới thiệu thêm</label>
                    <textarea id="additional" class="form-control @error('additional') is-invalid @enderror" type="text" name="additional" autocomplete="additional">{{old('additional')}}</textarea>
                    @error('additional')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="button" onclick="toPostPhotoToPageFacebook('http://testlaravel.ap-southeast-1.elasticbeanstalk.com/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}')" class="btn btn-primary">Đăng</button>
                <a type="button" href="/admin/product/quan-ly-san-pham" class="btn btn-danger">Hủy</a>
                <a type="button" class="btn btn-warning" href="/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}">Trang chi tiết</a>
            </form>
        </div>
    </div>
@endsection
