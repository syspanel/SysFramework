@extends('layouts.app')

@section('title', 'Delete Client')

@section('content')
<div class="container mt-5">
    <h1 class="text-danger">Delete Client</h1>
    <form action="/clients/delete/{id}" method="POST">

        <input type="hidden" name="_method" value="DELETE">
        <div class="alert alert-warning">
            Are you sure you want to delete client {{ $client->name }}?
        </div>
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="/clients" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection


