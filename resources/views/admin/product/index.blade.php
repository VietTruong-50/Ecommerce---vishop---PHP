@extends('layouts.admin')

@section('title')
    <title>List product</title>
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
        @include('shared.content-header', ['name' => 'Product', 'key' => 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('products.create') }}"
                           class="btn btn-success float-right m-2">Add
                        </a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($products as $product)

                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <img class="product_img_150_100" src="{{ $product->feature_img_path }}" alt="">
                                    </td>
                                    <td>{{ optional($product->category)->name }}</td>
                                    <td>
                                        <a
                                            class="btn btn-default"
                                            href="{{ route('products.edit', ['id'=>$product->id]) }}">Edit</a>
                                        <a
                                            href=""
                                            data-url="{{ route('products.delete', ['id' => $product->id])  }}"
                                            class="btn btn-danger action-delete">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@stop



