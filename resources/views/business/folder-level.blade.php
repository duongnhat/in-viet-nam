@extends('layout')
@section('title', $folderFather->name)
@section('description', 'Danh sach cua ' . $folderFather->name)
@section('content')
    <h1 class="text-center text-uppercase mt-3">{{$folderFather->name}}</h1>
    <div class="album py-5">
        <div class="container-fluid">
            @if($listFolder->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row">
                    <div class="col-4">
                        @foreach($listFolder as $i => $item)
                            <div class="d-sm-flex justify-content-between my-1 pb-1 border-bottom">
                                <div class="media d-block d-sm-flex text-center text-sm-left">
                                    <a class="cart-item-thumb mx-auto mr-sm-4" href="/pf/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}"><img src="{{ url($item->image_path . 'thumbnail/' . $item->image_name_to_store) }}" alt="Product" width="100px"></a>
                                    <div class="media-body pt-1">
                                        <h3 class="product-card-title font-weight-semibold border-0 pb-0" style="font-size: 13px"><a href="/pf/{{$item->id}}/{{strtolower(str_replace(" ","-",$item->text_domain))}}">{{$item->name}}</a></h3>
                                        <div class="font-size-lg" style="font-size: 10px">{{$item->description}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-2">
                            {{ $listFolder->links() }}
                        </div>
                    </div>
                    <div class="col-8">

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
