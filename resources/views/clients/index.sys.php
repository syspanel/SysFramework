@extends('layouts.app')

@section('title', 'Clients List') 
@endsection

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4 text-primary">Clients List</h1>
        <a href="/clients/create" class="btn btn-success btn-lg">Add New Client</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td> <!-- Corrigido para sintaxe de objeto -->
                        <td>{{ $client->name }}</td> <!-- Corrigido para sintaxe de objeto -->
                        <td>{{ $client->company }}</td> <!-- Corrigido para sintaxe de objeto -->
                        <td>
                            <a href="/clients/show/{{ $client->id }}" class="btn btn-info btn-sm me-2">View</a> <!-- Sintaxe de objeto -->
                            <a href="/clients/edit/{{ $client->id }}" class="btn btn-warning btn-sm me-2">Edit</a> <!-- Sintaxe de objeto -->
                            <a href="/clients/delete/{{ $client->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a> <!-- Sintaxe de objeto -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
