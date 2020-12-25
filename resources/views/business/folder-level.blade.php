@extends('layout')
@section('title', $folderFather->name)
@section('description', 'Danh sach cua ' . $folderFather->name)
@section('content')
    <h1 class="card-header text-center bg-secondary text-light text-uppercase">{{$folderFather->name}}</h1>
    <div class="album py-5">
        <div class="container">
            @if($listFolder->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row button-print-type">
                    @foreach($listFolder as $i => $item)
                        <div class="col-md-3 mb-4">
                            @if($item->level == 3)
                                <a href="/p/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">
                                    <div class="card button-print-type bg-light card-box-shadow border border-secondary border-radius text-break">
                                        <h1 class="text-shadow text-uppercase text-center font-weight-bold text-secondary m-auto">{{$item->name}}</h1>
                                    </div>
                                </a>
                            @else
                                <a href="/f/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">
                                    <div class="card button-print-type bg-light card-box-shadow border border-secondary border-radius text-break">
                                        <h1 class="text-shadow text-uppercase text-center font-weight-bold text-secondary m-auto">{{$item->name}}</h1>
                                    </div>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
