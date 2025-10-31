@extends('layouts.app')

@section('title', 'Login')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Login</h2>
        
        @if ($message != '')
        <div class="alert alert-info" role="alert">
            {{ $message }}
        </div>   
        @endif
        
        <form action="{{ route('auth.gologin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <br><br>
        <a href="/register">Registrar</a>
        <br>
        <a href="/forgot_password">Esqueci minha senha</a>
        <br>
        <a href="/resend_confirmation">Reenviar confirmação de email</a>
        
        
    </div>
</div>
@endsection

