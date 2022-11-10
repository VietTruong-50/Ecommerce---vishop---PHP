@extends('layouts.admin')

@section('title')
    <title>Add Permission</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Permission', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Chọn tên module</label>
                                <select class="form-control" name="module_parent">
                                    <option>Chọn tên module</option>
                                    @foreach(config('permissions.table-module') as $moduleItem)
                                        <option value="{{ $moduleItem }}">{{ '-'. $moduleItem }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">

                                <div class="row">
                                    @foreach(config('permissions.module-children') as $moduleChildrenItem)
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" value="{{$moduleChildrenItem}}" name="module_child[]">
                                                {{ $moduleChildrenItem }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


