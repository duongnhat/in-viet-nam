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
                                        <div class="custom-modal-content">
                                            <div class="col-12">
                                                <label class="font-weight-bold">Một số hình ảnh của sản phẩm:</label>
                                                <ol class="carousel-indicators carousel-indicators-custom mx-0">
                                                    <?php $no = 0; ?>
                                                    @foreach($listImage as $image)
                                                        <li data-target="#carouselExampleIndicators{{$item->id}}" data-slide-to="{{$no}}" class="active">
                                                            <img class="rounded d-block w-100" src="{{ url($image->path . 'thumbnail/' . $image->name_to_store) }}" alt="">
                                                        </li>
                                                        <?php $no++; ?>
                                                    @endforeach
                                                </ol>
                                                <div id="carouselExampleIndicators{{$item->id}}" class="carousel slide" data-interval="false">
                                                    <div class="carousel-inner">
                                                        <?php $no = 0; ?>
                                                        @foreach($listImage as $image)
                                                            <div class="carousel-item{{$no == 0 ? ' active' : ''}}">
                                                                <img class="rounded d-block w-100 border border-secondary" src="{{ url($image->path . $image->name_to_store) }}" alt="">
                                                            </div>
                                                            <?php $no++; ?>
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleIndicators{{$item->id}}" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleIndicators{{$item->id}}" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-10 mx-auto my-3">
                                                <iframe width="885" height="500" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                                            </div>
                                            <div class="col-12">
                                                <div class="card-body text-left">
                                                    <p class="card-text"><label class="font-weight-bold">Sơ lược: </label> {{$item->summary}}</p>
                                                    <p class="card-text"><label class="font-weight-bold">Mã sản phẩm: </label> {{$item->code ?? 'Đang cập nhật'}}</p>
                                                    <p class="card-text"><label class="font-weight-bold">Đơn giá: </label> {{number_format($item->price) ?? 'Đang cập nhật'}}đ</p>
                                                    <p class="card-text"><label class="font-weight-bold">Trạng thái: </label> {{$item->active == 1 ? 'Đang hoạt động' : 'Không hoạt động'}}</p>
                                                    <label class="font-weight-bold">Mô tả:</label>
                                                    <div class="container">{!! $item->introduce !!}</div>
                                                </div>
                                            </div>
                                        </div>
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
