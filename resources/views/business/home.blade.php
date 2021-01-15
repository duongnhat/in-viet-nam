@extends('layout')
@section('title', 'Trang chu')
@section('description', 'Trang chủ.')
@section('content')
    <h1 class="card-header text-center bg-secondary text-light text-uppercase">Trang chủ</h1>
    <div class="album py-5">
        <div class="container max-width-960">
            @if($listFolder->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row button-print-type">
                    @foreach($listFolder as $i => $item)
                        <div class="col-lg-3 col-md-4 col-6 mb-4">
                            <a href="/f/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">
                                <div class="card button-print-type bg-light card-box-shadow border border-secondary border-radius text-break">
                                    <h1 class="text-shadow text-uppercase text-center font-weight-bold text-secondary m-auto">{{$item->name}}</h1>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
