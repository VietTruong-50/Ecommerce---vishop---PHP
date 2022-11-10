@extends('layouts.admin')

@section('title')
    <title>Slider</title>
@endsection

@section('style_css')
    <link rel="stylesheet" href="{{ asset('admins/style-share/style.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('admins/product/index/list.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Slider', 'key' => 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('sliders.create') }}"
                           class="btn btn-success float-right m-2">Add
                        </a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sliders as $slider)

                                <tr>
                                    <th scope="row">{{ $slider->id }}</th>
                                    <td>{{ $slider->name }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td><img class="product_img_150_100" src="{{ $slider->image_path }}" alt=""></td>
                                    <td>
                                        <a href="{{route('sliders.edit', ['id' => $slider->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a data-url="{{route('sliders.delete', ['id' => $slider->id])}}" href=""
                                           class="btn btn-danger action-delete">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$sliders->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


