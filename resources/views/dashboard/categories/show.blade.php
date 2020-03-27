@extends('layouts.dashboard')

@section('content')

    <table class="table table-striped table-bordered table-hover" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            @canany(['category-edit', 'category-delete'])
                <th>Options</th>
            @endcanany
        </tr>
        </thead>
        <tbody>
            <tr class="gradeX">
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                @canany(['category-edit', 'category-delete'])
                    <td>
                        @can('category-edit')
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">edit</a>
                        @endcan
                        @can('category-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                @endcanany
            </tr>
        </tbody>
    </table>

@stop
