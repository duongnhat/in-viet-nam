@extends('layout')
@section('title', 'Quan ly san pham')
@section('description', 'Trang quản lý sản phẩm.')
@section('content')
    <div class="container-fluid">
        <a type="button" href="/admin/product/dang-ky-san-pham" class="btn btn-success mb-3">Tạo mới</a>
        <h3 class="card-header text-center bg-secondary text-light text-uppercase">Quản lý sản phẩm</h3>
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
                        <th scope="col">Tên</th>
                        <th scope="col">Thư mục</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Tóm tắt</th>
                        <th scope="col">Code</th>
                        <th scope="col">Text domain</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $i => $product)
                        <tr>
                            <th scope="row">{{($list->currentPage() - 1) * $list->perPage() + ($i + 1)}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->folder_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->summary}}</td>
                            <td>{{$product->code}}</td>
                            <td>{{$product->text_domain}}</td>
                            <td>{{$product->qty}}</td>
                            <td>{{$product->note}}</td>
                            <td>{{$product->active == 1 ? 'Hoạt động' : 'Ẩn'}}</td>
                            <td>{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                            <td class="text-center">
                                <a href="/admin/product/thay-doi-san-pham/{{$product->id}}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?');" href="/admin/product/delete/{{$product->id}}">
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
