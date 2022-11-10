@extends('layouts.admin')

@section('title')
    <title>Category</title>
@endsection

@section('js')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('admins/js-share/delete.js') }}"></script>
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('shared.content-header', ['name' => 'Category', 'key' => 'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('categories.create') }}"
                           class="btn btn-success float-right m-2">Add
                        </a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)

                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a href="{{route('categories.edit', ['id' => $category->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{ route('categories.delete', ['id' => $category->id]) }}"
                                           class="btn btn-danger action-delete">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$categories->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


