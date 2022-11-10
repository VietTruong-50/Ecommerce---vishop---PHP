@extends('layouts.admin')

@section('title')
    <title>Add product</title>
@endsection

@section('style_css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/style-share/style.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Products', 'key' => 'Add'])

        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Enter product"
                                       value="{{ old('name') }}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text"
                                       class="form-control @error('price') is-invalid @enderror"
                                       name="price"
                                       placeholder="Enter price"
                                       value="{{ old('price') }}"
                                >
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="feature_img_path"
                                >
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết sản phẩm</label>
                                <input type="file"
                                       multiple
                                       class="form-control-file"
                                       name="image_path[]"
                                >
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Chọn danh mục sản phẩm</option>
                                    {!!$htmlOption!!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập tag sản phẩm</label>
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea rows="3" name="contents"
                                          class="form-control my-editor @error('content') is-invalid @enderror"
                                >{{ old('contents') }}</textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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

