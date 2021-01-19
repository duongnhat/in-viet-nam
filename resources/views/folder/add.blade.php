@extends('layout')
@section('title', 'Tao moi thu muc')
@section('description', 'Trang tạo mới thư mục.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Tạo mới thư mục cấp {{$level}}</h3>
        <div class="card-body">
            <form method="post" action="{{ route('folder.post-tao-moi-thu-muc') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="level" value="{{$level}}">
                <div class="form-group">
                    <label>Tên thư mục</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name')}}" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @if($level != 1)
                    <div class="form-group">
                        <label>Thư mục cha cấp {{$level - 1}}</label>
                        <select class="form-control @error('folder_father_id') is-invalid @enderror" name="folder_father_id" value="{{ old('folder_father_id') }}">
                            <option value=""></option>
                            @foreach($listFolder as $i => $item)
                                <option value="{{$item->id}}" {{ old('folder_father_id') == $item->id ? 'selected' : '' }}>
                                    {{$item->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('folder_father_id')
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
                @endif
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
                    <label>Miêu tả</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" autocomplete="description">{{old('description')}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a type="button" href="/admin/folder/quan-ly-thu-muc-cap-{{$level}}" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
@endsection
