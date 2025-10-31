@extends('layouts.app')

@section('title', 'Redefinir Senha')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Redefinir Senha</h2>
        <form action="{{ route('auth.password.update', ['token' => $token]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Redefinir Senha</button>
        </form>
    </div>
</div>
@endsection
