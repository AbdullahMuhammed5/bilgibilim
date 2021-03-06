@extends('layouts.dashboard')

@section('content')
    {!! Form::model($footerLink, ['method' => 'PATCH','route' => ['footer-links.update', $footerLink->id]]) !!}
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Text:</label>
                {!! Form::text('text', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group">
                <label>Text:</label>
                {!! Form::text('url', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 text-center">
            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
