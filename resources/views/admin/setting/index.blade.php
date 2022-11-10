@extends('layouts.admin')

@section('title')
    <title>Setting</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('shared.content-header', ['name' => 'Setting', 'key' => 'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add setting
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('setting.create') . '?type=Text' }}">Text</a>
                                <a class="dropdown-item" href="{{ route('setting.create') . '?type=Textarea' }}">TextArea</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($settings as $setting)

                                <tr>
                                    <th scope="row">{{ $setting->id }}</th>
                                    <td>{{ $setting->config_key }}</td>
                                    <td>{{ $setting->config_value }}</td>
                                    <td>
                                        <a href="{{route('setting.edit', ['id' => $setting->id]) . '?type=' . $setting->type_setting}}"
                                           class="btn btn-default">Edit</a>
                                        <a href="{{route('setting.delete', ['id' => $setting->id])}}"
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$settings->links()}}
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@stop


