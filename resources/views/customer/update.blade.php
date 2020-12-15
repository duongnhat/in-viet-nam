@extends('layout')
@section('title', 'Dang ky thong tin khach hang')
@section('description', 'Trang đăng ký thông tin khách hàng.')
@section('content')
    <div class="card container border bg-light px-0">
        <h3 class="card-header text-center bg-secondary text-light">Thay đổi thông tin khách hàng</h3>
        <div class="card-body">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Ngày/Tháng</label>
                    <input class="form-control @error('day_month') is-invalid @enderror" type="text" name="day_month" value="{{old('day_month', $customer->day_month)}}" autocomplete="day_month">
                    @error('day_month')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tên khách</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name', $customer->name)}}" autocomplete="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{old('phone', $customer->phone)}}" autocomplete="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{old('address', $customer->address)}}" autocomplete="address">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{old('email', $customer->email)}}" autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Thông tin liên hệ</label>
                    <input class="form-control @error('info_contact') is-invalid @enderror" type="text" name="info_contact" value="{{old('info_contact', $customer->info_contact)}}" autocomplete="info_contact">
                    @error('info_contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" type="text" name="note" autocomplete="note">{{old('note', $customer->note)}}</textarea>
                    @error('note')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a type="button" href="/admin/customer/theo-doi-thong-tin-khach-hang" class="btn btn-danger">Hủy</a>
            </form>
        </div>
    </div>
@endsection
