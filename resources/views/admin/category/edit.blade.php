@extends('layouts.admin')

@section('title')
    <title>Edit category</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('shared.content-header', ['name' => 'Category', 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('categories.update', ['id' => $category->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="{{ $category->name }}"
                                       placeholder="Enter category"

                                >
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục sản phẩm</option>
                                    {!!$htmlOption!!}
                                </select>
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


