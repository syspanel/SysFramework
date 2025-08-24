@extends('layouts.app')

@section('title', 'Reenviar confirmação de email')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Reenviar confirmação de email</h2>
        
        <br>
        
        @if ($message != '')
        <div class="alert alert-info" role="alert">
            {{ $message }}
        </div>   
        @endif
        
        <br><br>
        
        <form action="{{ route('auth.goresend_confirmation') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Reenviar confirmação</button>
        </form>
    </div>
</div>
@endsection
