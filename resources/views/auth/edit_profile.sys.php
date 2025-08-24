@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Editar Perfil</h2>
        <form action="{{ route('auth.profile.edit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="firstname" class="form-label">Primeiro Nome</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $user->date_of_birth }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection
