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
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="facebook">
                        <label class="form-check-label" for="facebook">Facebook</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="zalo">
                        <label class="form-check-label" for="zalo">Zalo</label>
                    </div>
                </div>
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
                    <label>Access token Facebook</label>
                    <div class="input-group">
                        <input id="access-token-facebook" class="form-control" type="text" name="access_token_facebook" value="{{old('access_token_facebook', \Illuminate\Support\Facades\Session::get('access_token_facebook'))}}" autocomplete="access_token_facebook" required>
                        <div class="input-group-append">
                            <a href="https://developers.facebook.com/tools/explorer/" class="btn btn-outline-secondary" type="button" target="_blank">Lấy mã mới</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Access token Zalo</label>
                    <div class="input-group">
                        <input id="access-token-zalo" class="form-control" type="text" name="access_token_zalo" value="{{old('access_token_zalo', \Illuminate\Support\Facades\Session::get('access_token_zalo'))}}" autocomplete="access_token_zalo" required>
                        <div class="input-group-append">
                            <a href="https://developers.zalo.com/tools/explorer/" class="btn btn-outline-secondary" type="button" target="_blank">Lấy mã mới</a>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="checkAndPostStatus()" class="btn btn-primary" id="post-status">Đăng</button>
                {{--                <button type="button" onclick="toPostPhotoToPageFacebook('http://testlaravel.ap-southeast-1.elasticbeanstalk.com/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}')" class="btn btn-primary">Đăng</button>--}}
                <a type="button" href="/admin/product/quan-ly-san-pham" class="btn btn-danger">Hủy</a>
                <a type="button" class="btn btn-warning" href="/p/{{$product->id}}/{{strtolower(str_replace(" ","-",$product->text_domain))}}">Trang chi tiết</a>
            </form>
        </div>
    </div>

    <script lang="js">

        function checkAndPostStatus() {

            let has = false;

            if ($("#facebook").is(":checked")) {
                has = true;
                postStatusToPageFacebook();
            }

            if ($("#zalo").is(":checked")) {
                has = true;
                postStatusToPageZalo();
            }

            if (!has) {
                alert('Chưa chọn kênh đăng tin!');
            } else {
                $("#post-status").prop('disabled', true);
            }
        }

        function postStatusToPageFacebook() {
            let access_token_facebook = $("#access-token-facebook").val();
            let message = $("#additional").val();
            let link = 'https://vnexpress.net/vo-la-lach-va-than-sau-tai-nan-giao-thong-4219693.html';

            $.post("https://graph.facebook.com/103693188334656/feed",
                {
                    message: message,
                    link: link,
                    access_token: access_token_facebook
                })
                .done(function (data) {
                    let post_id = data.id.substr((data.id.indexOf("_") + 1))
                    postLogFacebook(post_id);
                    alert('Đăng Facebook thành công');
                })
                .fail(function (err) {
                    alert(JSON.parse(err.responseText).error.message);
                    $("#post-status").prop('disabled', false);
                });
        }

        function postStatusToPageZalo() {
            let access_token_zalo = $("#access-token-zalo").val();
            let message = $("#additional").val();
            let link = 'https://vnexpress.net/vo-la-lach-va-than-sau-tai-nan-giao-thong-4219693.html';

            $.post("https://graph.zalo.me/v2.0/me/feed",
                {
                    message: message,
                    link: link,
                    access_token: access_token_zalo
                })
                .done(function (data) {
                    let post_id = data.id.substr((data.id.indexOf("_") + 1))
                    postLogZalo(post_id);
                    alert('Đăng Zalo thành công');
                })
                .fail(function (err) {
                    alert(JSON.parse(err.responseText).error.message);
                    $("#post-status").prop('disabled', false);
                });
        }

        function postLogFacebook(post_id) {
            let access_token_facebook = $("#access-token-facebook").val();
            $.post("{{ config('app.url')}}/admin/advertisement/luu-log-bai-post-facebook",
                {
                    _token: "{{ csrf_token() }}",
                    access_token_facebook: access_token_facebook,
                    product_id: {{$product->id}},
                    page_id: 103693188334656,
                    post_id: parseInt(post_id)
                })
                .done(function (data) {
                    console.log(data);
                });
        }

        function postLogZalo(post_id) {
            let access_token_zalo = $("#access-token-zalo").val();
            $.post("{{ config('app.url')}}/admin/advertisement/luu-log-bai-post-zalo",
                {
                    _token: "{{ csrf_token() }}",
                    access_token_zalo: access_token_zalo,
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
