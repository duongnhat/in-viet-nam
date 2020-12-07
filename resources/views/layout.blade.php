<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Cty In Viet Nam</title>
    <meta name="description" content=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<section class="page-head pt-2">
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 text-right">
                <img src="{{ URL::to('/') }}/images/logo.jpg" class="img-rounded mb-2" alt="Cinque Terre" width="215">
                <h1><p>CÔNG TY</p>IN VIỆT NAM</h1>
                <p>Tài khoản: Admin</p>
                <p>Taylor Swift</p>
            </div>
            <div class="col-sm-9">
                <div class="ba-no"></div>
            </div>
        </div>
    </div>
</section>
<hr>
<section class="page-container">
    <div class="container-fluid">
        <div id="box-error">
            @if (isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endif
        </div>
        <div id="box-success">
            @if (isset($mess))
                <div class="alert alert-success">
                    {{ $mess }}
                </div>
            @endif
        </div>
        @yield('content')
    </div>
</section>

<footer class="container-fluid jumbotron">
    <p>Footer Text</p>
</footer>
<div class="copyright text-center">
    <div class="container">
        <small>Copyright © invietnam.com 2020</small>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
