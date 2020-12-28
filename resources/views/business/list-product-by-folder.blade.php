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
                <div class="row text-center">
                    @foreach($list as $i => $item)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100">
                                @foreach($listImage as $image)
                                    @if($image->product_id == $item->id)
                                        <img class="card-img-top" src="{{ url($image->path . '/thumbnail/' . $image->name_to_store) }}" alt="">
                                        @break
                                    @endif
                                @endforeach
                                <div class="card-body">
                                    <h4 class="card-title">{{$item->name}}</h4>
                                    <p class="card-text">{{$item->summary}}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center m-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".bd-example-modal-xl{{$item->id}}">Xem nhanh</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".bd-example-modal-xl{{$item->id}}">Xem chi tiết</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-xl{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach($listImage as $image)
                                                @php
                                                    $no = 0;
                                                @endphp
                                                @if($image->product_id == $item->id)
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                @endif
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">

                                            @foreach($listImage as $image)
                                                @if($image->product_id == $item->id)
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="{{ url($image->path . $image->name_to_store) }}" alt="">
                                                    </div>
                                                @endif
                                            @endforeach

                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="..." alt="Third slide">
                                            </div>
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
                        </div>
                        @break
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
