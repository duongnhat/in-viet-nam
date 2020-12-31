@extends('layout')
@section('title', $folderFather->name)
@section('description', $folderFather->description)
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
                                        <img class="card-img-top" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                                        @break
                                    @endif
                                @endforeach
                                <div class="card-body">
                                    <h2 class="card-title">{{$item->name}}</h2>
                                    <p class="card-text">{{$item->summary}}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center m-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".bd-example-modal-xl{{$item->id}}">Xem nhanh</button>
                                        <a type="button" class="btn btn-sm btn-outline-secondary" href="/p/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">Xem chi tiết</a>
                                    </div>
{{--                                    <small class="text-muted">9 mins</small>--}}
                                </div>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-xl{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content bg-light">
                                    <div class="modal-header">
                                        <strong class="modal-title pl-4">{{$item->name}}</strong>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="container p-1">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
