@extends('layouts.app')

@section('title', 'Redefinir senha')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Redefinir senha</h2>
        
        <br>
        
        <form action="{{ route('auth.goreset_password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $_GET['token'] }}">
            <input type="hidden" name="user_id" value="{{ $_GET['user_id'] }}">
            <div class="mb-3">
                <label for="password" class="form-label">Nova senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Redefinir senha</button>
        </form>
    </div>
</div>
@endsection
