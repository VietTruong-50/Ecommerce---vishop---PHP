@extends('layouts.admin')

@section('title')
    <title>Role</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Role', 'key' => 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('roles.create') }}"
                           class="btn btn-success float-right m-2">Add
                        </a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Display name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)

                                <tr>
                                    <th scope="row"> {{ $role->id }}</th>
                                    <td>{{  $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>
                                        <a href="{{route('roles.edit', ['id' => $role->id])}}"
                                           class="btn btn-default">Edit</a>
                                        {{--                                        <a href="{{route('setting.delete', ['id' => $setting->id])}}"--}}
                                        {{--                                           class="btn btn-danger">Delete</a>--}}
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$roles->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


