@extends('layout')
@section('title', 'Danh sách đăng ký thông tin sản phẩm')
@section('description', 'Trang danh sách đăng ký thông tin sản phẩm.')
@section('content')
    <div class="container-fluid">
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Danh sách đăng ký thông tin sản phẩm</h3>
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
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Quy cách</th>
                        <th scope="col">Số phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col" style="min-width: 130px">Trạng thái</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $i => $registeredGuest)
                        <tr>
                            <th scope="row">{{($list->currentPage() - 1) * $list->perPage() + ($i + 1)}}</th>
                            <td><a href="/p/{{$registeredGuest->product_id}}/{{strtolower(str_replace(" ","-",$registeredGuest->product_text_domain))}}">{{$registeredGuest->product_name}}</a></td>
                            <td>{{$registeredGuest->qty}}</td>
                            <td>{{$registeredGuest->specification}}</td>
                            <td>{{$registeredGuest->phone}}</td>
                            <td>{{$registeredGuest->email}}</td>
                            <td>{{$registeredGuest->note}}</td>
                            <td>
                                <select class="custom-select custom-select-sm text-white {!!$registeredGuest->status == 0 ? 'bg-success' : ($registeredGuest->status == 1 ? 'bg-warning' : 'bg-danger')!!}" onchange="location = this.value;">
                                    <option value="/admin/registered-guest/change-status/{{$registeredGuest->id}}/0" {!!$registeredGuest->status == 0 ? 'selected' : ''!!}>Mới</option>
                                    <option value="/admin/registered-guest/change-status/{{$registeredGuest->id}}/1" {!!$registeredGuest->status == 1 ? 'selected' : ''!!}>Đang xử lý</option>
                                    <option value="/admin/registered-guest/change-status/{{$registeredGuest->id}}/2" {!!$registeredGuest->status == 2 ? 'selected' : ''!!}>Hoàn tất</option>
                                </select>
                            </td>
                            <td>{{\Carbon\Carbon::parse($registeredGuest->created_at)->format('d/m/Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($registeredGuest->updated_at)->format('d/m/Y')}}</td>
                            <td class="text-center">
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?');" href="/admin/registered-guest/delete/{{$registeredGuest->id}}">
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
