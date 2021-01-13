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
                    <textarea id="additional" class="form-control @error('additional') is-invalid @enderror" type="text" name="additional" autocomplete="additional" rows="6">{{old('additional')}}</textarea>
                    @error('additional')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Access token</label>
                    <div class="input-group">
                        <input id="access-token" class="form-control" type="text" name="access_token" value="{{old('access_token', \Illuminate\Support\Facades\Session::get('access_token'))}}" autocomplete="access_token" required>
                        <div class="input-group-append">
                            <a href="https://developers.facebook.com/tools/explorer/" class="btn btn-outline-secondary" type="button" target="_blank">Lấy mã mới</a>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="postStatusToPageFacebook()" class="btn btn-primary">Đăng</button>
                {{--                <button type="button" onclick="toPostPhotoToPageFacebook('http://testlaravel.ap-southeast-1.elasticbeanstalk.com/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}')" class="btn btn-primary">Đăng</button>--}}
                <a type="button" href="/admin/product/quan-ly-san-pham" class="btn btn-danger">Hủy</a>
                <a type="button" class="btn btn-warning" href="/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}">Trang chi tiết</a>
            </form>
        </div>
    </div>

    <script lang="js">

        function postStatusToPageFacebook() {
            let access_token = $("#access-token").val();
            let message = $("#additional").val();
            let link = 'https://vnexpress.net/vo-la-lach-va-than-sau-tai-nan-giao-thong-4219693.html';

            $.post("https://graph.facebook.com/103693188334656/feed",
                {
                    message: message,
                    link: link,
                    access_token: access_token
                })
                .done(function (data) {
                    let post_id = data.id.substr((data.id.indexOf("_") + 1))
                    postLogFacebook(post_id);
                    alert('Đăng thành công');
                })
                .fail(function (err) {
                    alert(JSON.parse(err.responseText).error.message);
                });
        }

        function postLogFacebook(post_id) {
            let access_token = $("#access-token").val();
            $.post("{{ config('app.url')}}/admin/facebook/luu-log-bai-post",
                {
                    _token: "{{ csrf_token() }}",
                    access_token: access_token,
                    product_id: {{$product->id}},
                    page_id: 103693188334656,
                    post_id: parseInt(post_id)
                })
                .done(function (data) {
                    console.log(data);
                });
        }
    </script>
@endsection
