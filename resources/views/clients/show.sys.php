@extends('layouts.app')


@section('title', 'Client Details') 
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="text-info">Client Details</h1>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <td>{{ $client->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $client->name }}</td>
        </tr>
        <tr>
            <th>Company</th>
            <td>{{ $client->company }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $client->address }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $client->phone }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $client->email }}</td>
        </tr>
        <tr>
            <th>Notes</th>
            <td>{{ $client->notes }}</td>
        </tr>
    </table>
    <a href="/clients/edit/{{ $client->id }}" class="btn btn-warning me-2">Edit</a>
    <a href="/clients/delete/{{ $client->id }}" class="btn btn-danger me-2" onclick="return confirm('Are you sure?')">Delete</a>
    <a href="/clients" class="btn btn-secondary">Back to List</a>
</div>
@endsection
