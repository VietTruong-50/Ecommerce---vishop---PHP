@extends('layouts.admin')

@section('title')
    <title>Edit role</title>
@endsection

@section('style_css')
    <link href="{{asset('admins/style-share/style.css') }}" rel="stylesheet"/>
    <link href="{{asset('admins/role/add/add.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Role', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('roles.update', ['id' => $role->id]) }}" method="post">
                            @csrf

                            <div>
                                <div class="form-group">
                                    <label>Nhập vai trò</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           placeholder="Enter name"
                                           value="{{ $role->name }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea rows="3" name="display_name"
                                              class="form-control my-editor"
                                    >{{ $role->display_name }}</textarea>
                                </div>
                            </div>

                            <div class="card-body text-primary col-md-3">
                                <label>
                                    <input type="checkbox" class="checkboxAll">
                                    Check all
                                </label>
                            </div>
                            @foreach($permissionParents as $permissionItem)
                                <div class="row col-md-12">
                                    <div class="card border-primary mb-3 w-100">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" class="checkbox-wrapper">
                                            </label>
                                            Module {{ $permissionItem->display_name }}
                                        </div>
                                        <div class="row">
                                            @foreach($permissionItem->permissionChildren as $permissionChildrenItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <label>
                                                        <input type="checkbox" name="permission_id[]"
                                                               class="checkbox-children"
                                                               {{ $permissionChecked->contains('id', $permissionChildrenItem->id) ? 'checked' : '' }}
                                                               value="{{ $permissionChildrenItem->id }}">
                                                    </label>
                                                    {{ $permissionChildrenItem->name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


