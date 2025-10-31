@extends('layouts.app')

@section('title', 'Exemplo do uso da Classe SysTE') 
@endsection

@section('content')

    <h1>Hello, {{ $name }}!</h1>
    
    
    
    @php
    echo 123;
    @endphp
    
    {{-- comentario --}}

@endsection

    
    @include('partials.footer')

