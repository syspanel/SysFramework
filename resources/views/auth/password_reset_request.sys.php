@extends('layouts.app')

@section('title', 'Recuperação de Senha')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Recuperação de Senha</h2>
        <form action="{{ route('auth.password.reset') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Link de Redefinição</button>
        </form>
    </div>
</div>
@endsection
