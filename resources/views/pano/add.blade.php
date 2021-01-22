@extends('layout')
@section('title', 'Thêm pano')
@section('description', 'Trang thêm mới pano.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Thêm pano</h3>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Chọn pano</label>
                    <select class="form-control @error('pano_id') is-invalid @enderror" name="pano_id" value="{{ old('pano_id') }}">
                        <option value=""></option>
                        <option value="1" {{ old('pano_id') == 1 ? 'selected' : '' }}>Pano 1</option>
                        <option value="2" {{ old('pano_id') == 2 ? 'selected' : '' }}>Pano 2</option>
                        <option value="3" {{ old('pano_id') == 3 ? 'selected' : '' }}>Pano 3</option>
                    </select>
                    @error('pano_id')
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
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a type="button" href="/admin/pano/quan-ly-pano" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
@endsection
