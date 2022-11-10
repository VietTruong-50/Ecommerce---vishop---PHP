@extends('layouts.admin')

@section('title')
    <title>Add menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Menus', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('menus.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên menu</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Enter menu"

                                >
                            </div>
                            <div class="form-group">
                                <label>Chọn menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn menu</option>
                                    {!! $optionSelect !!}
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


