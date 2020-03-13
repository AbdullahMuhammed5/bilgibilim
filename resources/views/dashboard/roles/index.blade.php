@extends('layouts.dashboard')

@section('content')

    <table class="table table-striped table-bordered table-hover data-table" style="width: 100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th style="width: 400px">Permissions</th>
            @canany(['role-edit', 'role-delete', 'role-list'])
            <th>Options</th>
            @endcanany
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@stop

@push('datatable-css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('datatable')
    @include('includes/datatable')
@endpush

