@extends('layout')
@section('title', 'chinh sua thu muc')
@section('description', 'Trang chỉnh sửa thư mục.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light">Chỉnh sửa thư mục</h3>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Tên thư mục</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name', $folder->name)}}" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Thư mục cha</label>
                    <select class="form-control @error('folder_father_id') is-invalid @enderror" name="folder_father_id" value="{{old('folder_father_id', $folder->folder_father_id)}}">
                        <option value=""></option>
                        @foreach($listFolder as $i => $item)
                            <option value="{{$item->id}}" {{ old('folder_father_id', $folder->folder_father_id) == $item->id ? 'selected' : '' }}>
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
                    <label>Miêu tả</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" autocomplete="description">{{old('description', $folder->description)}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a type="button" href="/admin/folder/quan-ly-thu-muc" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
@endsection
