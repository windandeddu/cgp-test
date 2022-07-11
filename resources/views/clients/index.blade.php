@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="text-black-50">Clients</h1>
        <div class="float-right mr-3 mb-3"><a class="btn btn-success" href="{{ route('clients.create') }}">Create New Client</a></div>
        <table class="table table-striped table-sm">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action 1</th>
                <th>Action 2</th>
            </tr>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td><a class="btn btn-outline-primary btn-sm" href="{{ route('clients.edit', ['client' => $client->id]) }}">{{ __('edit')}}</a></td>
                <td>
                    <form method="POST" action="{{ route('clients.destroy', ['client' => $client->id]) }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?');">{{ __('delete')}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="p-3">
            @include('vendor.pagination.simple-bootstrap-4', ['paginator' => $clients])
        </div>
    </div>

@endsection
