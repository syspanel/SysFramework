@extends('layouts.app')

@section('title', 'Perfil de Usuário')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Perfil de Usuário</h2>
        <p><strong>Primeiro Nome:</strong> {{ $user->firstname }}</p>
        <p><strong>Sobrenome:</strong> {{ $user->lastname }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Data de Nascimento:</strong> {{ $user->date_of_birth }}</p>
        
        <a href="/users/profile/edit" class="btn btn-warning">Editar Perfil</a>
    </div>
</div>
@endsection

