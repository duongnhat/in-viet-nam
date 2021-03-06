@extends('layout')
@section('title', 'Quản lý pano')
@section('description', 'Trang quản lý pano.')
@section('content')
    <div class="container-fluid">
        <a type="button" href="/admin/pano/them-pano" class="btn btn-success my-3">Tạo mới</a>
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Quản lý pano</h3>
        @if($list->count() == 0)
            <div class="alert alert-warning">
                <strong>Sorry!</strong> Chưa có dữ liệu.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped bg-light">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Pano</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $i => $image)
                        <tr>
                            <th scope="row">{{($list->currentPage() - 1) * $list->perPage() + ($i + 1)}}</th>
                            <td>{{$image->pano_id}}</td>
                            <td class="p-1"><a href="{{ url($image->path . $image->name_to_store) }}" target="_blank"><img class="card-img-top" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="" style="width: 80px"></a></td>
                            <td>{{\Carbon\Carbon::parse($image->created_at)->format('d/m/Y')}}</td>
                            <td class="text-center">
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?');" href="/admin/pano/delete/{{$image->id}}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $list->links() }}
            </div>
        @endif
    </div>
@endsection
