<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysTE Template Engine</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap core CSS -->
<link href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/bootstrap5/js/app.js') }}"></script>
    <style>
        .main-container {
            margin-top: 3rem;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 1rem;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container main-container">
        <h1 class="display-4 mb-4">SysTE Template Engine</h1>
        
        <x-alert type="success">
            This is a success alert!
        </x-alert>

        <br><br>
        
        {{-- Diretiva @if --}}
        <div class="alert alert-info">
            @if ($user['is_admin'])
                <p class="mb-0">Bem-vindo, <strong>{{ $user['name'] }}</strong>!</p>
            @else
                <p class="mb-0">Olá, <strong>{{ $user['name'] }}</strong>!</p>
            @endif
        </div>

        {{-- Diretiva @foreach --}}
        <h2 class="mt-4">Itens</h2>
        <ul class="list-group">
            @foreach ($items as $item)
                <li class="list-group-item">{{ $item }}</li>
            @endforeach
        </ul>

        {{-- Diretiva @for --}}
        <h2 class="mt-4">Contagem Regressiva</h2>
        <ul class="list-group">
            @for ($i = 10; $i >= 0; $i--)
                <li class="list-group-item">{{ $i }}</li>
            @endfor
        </ul>
        
        @php $marco = "Marco Costa"; echo $marco; @endphp
        
        <br>
        
        {{ $marco }}
        
        <br>
        
        {{ MIDDLEWARES_PATH }}

<br><br><br><br>

    @php
    echo 123;
    @endphp
    
    {{-- comentario --}}

    
    @include('partials.footer')


    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>


