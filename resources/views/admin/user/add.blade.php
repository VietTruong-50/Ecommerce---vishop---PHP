@extends('layouts.admin')

@section('title')
    <title>Add user</title>
@endsection

@section('style_css')
    <link href="{{asset('vendor/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{asset('admins/style-share/style.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/js-share/tinymce.min.js') }}"></script>
    <script src="{{ asset('admins/add.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'User', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nhập tên</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Enter name"
                                >
                            </div>
                            <div class="form-group">
                                <label>Nhập email</label>
                                <input type="text"
                                       class="form-control"
                                       name="email"
                                       placeholder="Enter email"
                                >
                            </div>
                            <div class="form-group">
                                <label>Nhập password</label>
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Enter password"
                                >
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select class="form-control tags_select_choose" name="role_ids[]" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


