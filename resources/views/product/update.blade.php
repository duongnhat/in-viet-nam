@extends('layout')
@section('title', 'Chỉnh sửa sản phẩm')
@section('description', 'Trang chỉnh sửa sản phẩm.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Chỉnh sửa sản phẩm</h3>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name', $product->name)}}" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Thuộc thư mục cấp 3</label>
                    <select class="form-control @error('folder_id') is-invalid @enderror" name="folder_id" value="{{ old('folder_id', $product->folder_id) }}">
                        <option value=""></option>
                        @foreach($listFolderLevel3 as $i => $item)
                            <option value="{{$item->id}}" {{ old('folder_id', $product->folder_id) == $item->id ? 'selected' : '' }}>
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
                    <input class="form-control @error('summary') is-invalid @enderror" type="text" name="summary" value="{{old('summary', $product->summary)}}" autocomplete="summary">
                    @error('summary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Đơn giá</label>
                    <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{old('price', $product->price)}}" autocomplete="price">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Code</label>
                    <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" value="{{old('code', $product->code)}}" autocomplete="code">
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Text domain</label>
                    <p class="text-warning font-italic font-weight-bold">Kiểu a-b-c-d không dấu tốt nhất cho SEO</p>
                    <input class="form-control @error('text_domain') is-invalid @enderror" type="text" name="text_domain" value="{{old('text_domain', $product->text_domain)}}" autocomplete="text_domain">
                    @error('text_domain')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control @error('qty') is-invalid @enderror" type="text" name="qty" value="{{old('qty', $product->qty)}}" autocomplete="qty">
                    @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Bài giới thiệu</label>
                    <textarea id="introduce" class="form-control @error('introduce') is-invalid @enderror" type="text" name="introduce" autocomplete="introduce">{{old('introduce', $product->introduce)}}</textarea>
                    @error('introduce')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#introduce'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                </div>
                <div class="form-group">
                    <label>Youtube id</label>
                    <input class="form-control @error('youtube') is-invalid @enderror" type="text" name="youtube" value="{{old('youtube', $product->youtube)}}" autocomplete="youtube">
                    @error('youtube')
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
                    <textarea class="form-control @error('note') is-invalid @enderror" type="text" name="note" autocomplete="note">{{old('note', $product->note)}}</textarea>
                    @error('note')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="defaultCheck1" name="active" {{ $product->active == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="defaultCheck1">
                        Active
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a type="button" href="/admin/product/quan-ly-san-pham" class="btn btn-danger">Hủy</a>
                <a type="button" class="btn btn-warning" href="/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}">Trang chi tiết</a>
            </form>
        </div>
    </div>
@endsection
