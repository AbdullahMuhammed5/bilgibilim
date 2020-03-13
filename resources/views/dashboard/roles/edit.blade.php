@extends('layouts.dashboard')

@section('content')
    <h1>Edit {{ $role->name }}</h1>
    <hr>
    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-sm-12  col-md-6">
            <div class="form-group">
                <label>Name:</label>
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label>Description:</label>
                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-12  col-md-6">
            <div class="form-group">
                <label>Permission:</label>
                <div class="row">
                    @foreach($permissions as $key => $value)
                        <div class="i-checks col-sm-4">
                        {{ Form::checkbox('permissions[]', $key, in_array($key, $rolePermissions) ? true : false,
                        array('id'=> $value)) }}
                            <label for="{{ $value }}">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xs-12 text-center">
            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@push('icheck-css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endpush
