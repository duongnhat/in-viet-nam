@extends('layout')
@section('title', $folderFather->name)
@section('description', 'Danh sach cua ' . $folderFather->name)
@section('content')
    <h1 class="text-center text-uppercase mt-3 h1-header">{{$folderFather->name}}</h1>
    <div class="album py-1">
        <div class="container-fluid">
            @if($listFolder->count() == 0)
                <div class="alert alert-warning">
                    <strong>Sorry!</strong> Chưa có dữ liệu.
                </div>
            @else
                <div class="row m-1">
                    <div class="col-6">
                        <div class="row">
                            @foreach($listFolder as $i => $item)
                                <div class="col-6 d-sm-flex justify-content-between my-1 pb-1 border-bottom">
                                    <div class="media d-block d-sm-flex text-center text-sm-left">
                                        <a class="cart-item-thumb mx-auto mr-sm-4 card-hover" href="/pf/{{$item->id}}/0/{{strtolower(str_replace(" ","-",$item->text_domain))}}"><img src="{{ url($item->image_path != null ? ($item->image_path . 'thumbnail/' . $item->image_name_to_store) : 'images/logo.png') }}" alt="Product" width="100px"></a>
                                        <div class="media-body pt-1">
                                            <h3 class="product-card-title font-weight-semibold border-0 pb-0" style="font-size: 15px"><a href="/pf/{{$item->id}}/0/{{strtolower(str_replace(" ","-",$item->text_domain))}}">{{$item->name}}</a></h3>
                                            <div class="font-size-lg" style="font-size: 11px">{{$item->description}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mx-auto iframe-youtube">
                            <iframe src="https://www.youtube.com/embed/XKu_SEDAykw"></iframe>
                        </div>
                    </div>
                </div>
                <div class="ml-5 mt-2">
                    {{ $listFolder->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
