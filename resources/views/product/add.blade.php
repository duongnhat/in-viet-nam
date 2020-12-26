@extends('layout')
@section('title', 'Tao moi san pham')
@section('description', 'Trang Tạo mới sản phẩm.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Tạo mới sản phẩm</h3>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name')}}" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Thuộc thư mục cấp 3</label>
                    <select class="form-control @error('folder_id') is-invalid @enderror" name="folder_id" value="{{ old('folder_id') }}">
                        <option value=""></option>
                        @foreach($listFolderLevel3 as $i => $item)
                            <option value="{{$item->id}}" {{ old('folder_id') == $item->id ? 'selected' : '' }}>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('folder_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Giới thiệu tóm tắt</label>
                    <input class="form-control @error('summary') is-invalid @enderror" type="text" name="summary" value="{{old('summary')}}" autocomplete="summary">
                    @error('summary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Đơn giá</label>
                    <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{old('price')}}" autocomplete="price">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Code</label>
                    <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" value="{{old('code')}}" autocomplete="code">
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Text domain</label>
                    <p class="text-warning font-italic font-weight-bold">Kiểu a-b-c-d không dấu tốt nhất cho SEO</p>
                    <input class="form-control @error('text_domain') is-invalid @enderror" type="text" name="text_domain" value="{{old('text_domain')}}" autocomplete="text_domain">
                    @error('text_domain')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control @error('qty') is-invalid @enderror" type="text" name="qty" value="{{old('qty')}}" autocomplete="qty">
                    @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Bài giới thiệu</label>
                    <textarea class="form-control @error('introduce') is-invalid @enderror" type="text" name="introduce" autocomplete="introduce">{{old('introduce')}}</textarea>
                    @error('introduce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Hình ảnh</label>
                    <input class="form-control-file @error('image') is-invalid @enderror @error('image.*') is-invalid @enderror" type="file" name="image[]" id="exampleInputFile" multiple accept='image/*'/>
                    @error('image.*')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    @error('image')
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
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="defaultCheck1" name="active" checked>
                    <label class="form-check-label" for="defaultCheck1">
                        Active
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a type="button" href="/admin/product/quan-ly-san-pham" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
@endsection
