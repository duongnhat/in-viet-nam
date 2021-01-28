<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>@yield('title') - Cty In Viet Nam</title>
    <meta name="description" content="@yield('description')"/>
    @yield('meta')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
</head>
<body style="background-image: url('{{ url('images/background.png') }}');">
<section class="page-head pt-1">
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-12 col-md-3 col-xl-2 text-md-right text-center logo-company mb-2">
                <div>
                    <h1 class="text-shadow text-center"><p>CÔNG TY</p>IN VIỆT NAM</h1>
                </div>
                <div class="mr-1">
                    <img src="{{ url('images/logo.png') }}" class="img-rounded mb-2" alt="Cty In Viet Nam" width="100" height="100">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-8">
                <div class="ba-no">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($PANO_1 as $i => $image)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner rounded" role="listbox">
                            @foreach($PANO_1 as $i => $image)
                                <div class="carousel-item {{$i == 0 ? 'active' : ''}}">
                                    <img src="{{ url($image->path . $image->name_to_store) }}" class="d-block w-100 border border-secondary" alt="">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-xl-2 logo-company">
                <div class="mt-1 float-right">
                    @if (Auth::check())
                        <p class="font-italic">Tài khoản: {{ Auth::user()->name }}</p>
                        <p class="font-italic">{{ Auth::user()->email }}</p>
                        <a onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');" class="btn btn-outline-info btn-sm mt-1" href="/logout">Logout</a>
                    @else
                        <a class="btn btn-outline-info btn-sm mt-1" href="/login">Login</a>
                    @endif
                </div>
            </div>
        </div>
        <nav class="menu navbar navbar-expand-lg navbar-light mt-1 rounded p-0 m-0">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav font-weight-bold">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Trang chủ <span class="sr-only">(current)</span></a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/product/quan-ly-san-pham">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/customer/theo-doi-thong-tin-khach-hang">Khách hàng</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thư mục
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/admin/folder/quan-ly-thu-muc-cap-1">Cấp 1</a>
                                <a class="dropdown-item" href="/admin/folder/quan-ly-thu-muc-cap-2">Cấp 2</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/registered-guest/danh-sach-dang-ky-thong-tin-san-pham">Đơn hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/pano/quan-ly-pano">Pano</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</section>
<section class="page-container my-1">
    <div class="container px-0">
        @if (session('messCommon'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('messCommon') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('errorCommon'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('errorCommon') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    @yield('content')
</section>

<footer>
    <div class="container-fluid page-footer text-center text-md-left mt-4">
        <div class="row">
            <div class="col-sm-12 col-md-3 text-md-right text-center logo-company m-auto">
                <img src="{{ url('images/logo.png') }}" class="img-rounded m-2" alt="Cty In Viet Nam" width="215">
                <h1 class="text-shadow"><p>CÔNG TY</p>IN VIỆT NAM</h1>
            </div>
            <div class="col-sm-12 col-md-5 mx-auto mb-4 mt-4">
            </div>
            <div class="col-sm-12 col-md-4 mx-auto my-4 font-weight-bold">
                <h6 class="text-uppercase font-weight-bold">Liên hệ</h6>
                <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>Địa Chỉ: 123 Nguyễn Thị Tú, F Bình Hưng Hòa, Q. Bình Tân</p>
                <p>Điện Thoại: 0909 394.512</p>
                <p>Email: invietnam@gmail.com</p>
                <p>Zalo: invietnam</p>
                <p>Website: invietnam.vip</p>
            </div>
        </div>
    </div>
    <div class="text-light footer-copyright text-center py-3">
        © 2020 Copyright: invietnam.vip
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
