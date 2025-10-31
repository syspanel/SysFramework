@extends('layouts.app')

@section('title', 'Esqueci minha senha')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Esqueci minha senha</h2>
        
        @if ($message != '')
        <div class="alert alert-warning" role="alert">
            {{ $message }}
        </div>   
        @endif
        
        <form action="{{ route('auth.send_resetlink') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar link de redefinição</button>
        </form>
    </div>
</div>
@endsection
