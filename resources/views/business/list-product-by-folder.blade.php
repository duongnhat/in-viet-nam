@extends('layout')
@section('title', $folderFather->name)
@section('description', 'Danh sach cua ' . $folderFather->name)
@section('content')
    <h1 class="card-header text-center bg-secondary text-light text-uppercase">Sản phẩm của {{$folderFather->name}}</h1>
    <div class="album py-5">
        <div class="container">
            @if($list->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row">
                    @foreach($list as $i => $item)
                        <h1>{{$item->name}}</h1>-----------
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
