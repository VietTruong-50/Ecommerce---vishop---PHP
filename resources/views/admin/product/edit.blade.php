@extends('layouts.admin')

@section('title')
    <title>Edit product</title>
@endsection

@section('style_css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/style-share/style.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">

        @include('shared.content-header', ['name' => 'Product', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('products.update',  ['id' => $product->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Enter product"
                                       value="{{ $product->name }}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text"
                                       class="form-control"
                                       name="price"
                                       placeholder="Enter price"
                                       value="{{ $product->price }}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="feature_img_path"
                                >
                                <div class="col-md-12 container-feature-img">
                                    <div class="row">
                                        <img class="feature-img" src="{{ $product->feature_img_path }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết sản phẩm</label>
                                <input type="file"
                                       multiple
                                       class="form-control-file"
                                       name="image_path[]"
                                >
                                <div class="col-md-12 container-img-details">
                                    <div class="row">
                                        @foreach($product->images as $productImageItem)
                                            <div class="col-md-5">
                                                <img class="img-product-detail"
                                                     src="{{ $productImageItem->image_path }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="0">Chọn danh mục sản phẩm</option>
                                    {!!$htmlOption!!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tag sản phẩm</label>
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                        <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea rows="3" name="contents"
                                          class="form-control my-editor"
                                >{{ $product->content  }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('js')
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="{{ asset('admins/js-share/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{asset('admins/add.js')}}"></script>
@endsection

