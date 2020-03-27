@extends('layouts.dashboard')

@section('content')
    <h1>Create new category</h1>
    <hr>
    {!! Form::open(array('route' => 'categories.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Category Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <strong>Description:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-12 text-center">
            {!! Form::submit('Submit!', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
