@extends('layout')
@section('title', 'Trang chu')
@section('description', 'Trang chủ.')
@section('content')
    <h1 class="card-header text-center bg-secondary text-light">Trang chủ</h1>
    <div class="album py-5">
        <div class="container">
            <div class="row button-print-type">
                @foreach($listFolder as $i => $item)
                    <div class="col-md-3 mb-4">
                        <div class="card button-print-type bg-light card-box-shadow border border-secondary border-radius btn">
                            <h1 class="text-shadow text-uppercase text-center font-weight-bold text-secondary m-auto">{{$item->name}}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
