@extends('layouts.admin')

@section('title')
    <title>Add setting</title>
@endsection

@section('style_css')
    <link href="{{asset('admins/style-share/style.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('shared.content-header', ['name' => 'Setting', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('setting.store') . '?type=' . request()->type}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config key</label>
                                <input type="text"
                                       class="form-control @error('config_key') is-invalid @enderror"
                                       name="config_key"
                                       value="{{ old('config_key') }}"
                                       placeholder="Enter config key"
                                >
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label>Config value</label>
                                    <input type="text"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           name="config_value"
                                           value="{{ old('config_value') }}"
                                           placeholder="Enter config value"
                                    >
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <textarea type="text" class="form-control" name="config_value"
                                          placeholder="Enter config value" rows="5" cols="4">{{ old('config_value') }}</textarea>
                                @error('config_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


