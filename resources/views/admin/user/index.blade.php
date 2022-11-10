@extends('layouts.admin')

@section('title')
    <title>User</title>
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
        @include('shared.content-header', ['name' => 'User', 'key' => 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('user.create') }}"
                           class="btn btn-success float-right m-2">Add
                        </a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)

                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{route('user.edit', ['id' => $user->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a data-url="{{route('user.delete', ['id' => $user->id])}}" href=""
                                           class="btn btn-danger action-delete">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$users->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


