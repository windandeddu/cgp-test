@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Companies</h1>
        <div class="float-right mr-3 mb-3"><a class="btn btn-success" href="{{ route('companies.create') }}">Create New Company</a></div>
        <table class="table table-striped table-sm">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Action 1</th>
                <th>Action 2</th>
            </tr>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->address }}</td>
                <td>{{ $company->phone }}</td>
                <td><a class="btn btn-outline-primary btn-sm" href="{{ route('companies.edit', ['company' => $company->id]) }}">{{ __('edit')}}</a></td>
                <td>
                    <form method="POST" action="{{ route('companies.destroy', ['company' => $company->id]) }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?');">{{ __('delete')}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="p-3">
            @include('vendor.pagination.simple-bootstrap-4', ['paginator' => $companies])
        </div>
    </div>

@endsection
