@extends('layouts.admin')

@section('title')
    <title>Edit slider</title>
@endsection

@section('style_css')
    <link href="{{asset('admins/style-share/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/slider/edit/edit.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('shared.content-header', ['name' => 'Slider', 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('sliders.update', ['id' => $slider->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Enter slider name"
                                       value="{{ $slider->name }}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả slider</label>
                                <textarea name="description"
                                          class="form-control @error('description') is-invalid @enderror">
                                    {{ $slider->description }}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file"
                                       class="form-control-file @error('image_path') is-invalid @enderror"
                                       name="image_path"
                                >
                                <div class="col-md-12 container-img-slider">
                                    <div class="row">
                                        <img class="img-slider"
                                             src="{{ $slider->image_path }}" alt="">
                                    </div>
                                </div>
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@stop


