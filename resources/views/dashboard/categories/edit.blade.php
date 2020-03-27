@extends('layouts.dashboard')

@section('content')
    <h1>{{$category->name}}</h1>
    <hr>
    {!! Form::model($category, ['method' => 'PATCH','route' => ['categories.update', $category->id]]) !!}
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <strong>Description:</strong>
                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-12 text-center">
            {!! Form::submit('Save Changes!', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection
