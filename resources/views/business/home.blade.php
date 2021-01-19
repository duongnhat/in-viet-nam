@extends('layout')
@section('title', 'Trang chu')
@section('description', 'Trang chủ.')
@section('content')
    <h1 class="text-center text-uppercase mt-3 h1-header">Trang chủ</h1>
    <div class="album py-5">
        <div class="container">
            @if($listFolder->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row button-print-type">
                    @foreach($listFolder as $i => $item)
                        <div class="col-lg-2 col-md-3 col-4 mb-4">
                            <a href="/f/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">
                                <div class="card button-print-type bg-light card-box-shadow border border-secondary rounded text-break">
                                    <h1 class="text-uppercase text-center font-weight-bold text-secondary m-auto" style="font-size: 12px">{{$item->name}}</h1>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
