@extends('layouts.app')

@section('title', 'Registro Completo')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Obrigado pelo registro, {{ $firstname }}!</h2>
        <br>
        <p>Um email de confirmação foi enviado para {{ $email }}. </p>
        <p>Por favor, verifique sua caixa de entrada e clique no link para confirmar seu registro.</p>
        <p>Se você não receber o email, verifique sua pasta de spam.</p>
    </div>
</div>
@endsection

