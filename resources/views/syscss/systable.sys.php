<?php

use Core\SysTables;

// Dados de exemplo
$data = [];
for ($i = 1; $i <= 30; $i++) {
    $data[] = [
        'Nome' => 'Nome ' . $i,
        'Email' => 'nome' . $i . '@exemplo.com'
    ];
}

$columns = ['Nome', 'Email'];
$table = new SysTables($data, $columns); // O número de linhas por página é definido na classe

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap5/js/app.js') }}"></script>
    <link href="{{ asset('assets/syscss/css/systables.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/syscss/js/systables.js') }}" defer></script>
    <title>Exemplo SysCSS</title>
</head>
<body>
    <div class="container mt-4">
        <header class="text-center mb-4">
            <h1>Exemplo de Uso da Class SysTables</h1>
        </header>

        <section>
            <h2 class="mb-3">Tabela de Nomes</h2>
            <div class="mb-3">
                <?php echo $table->renderSearchAndRowsPerPage(); ?>
            </div>
            <div class="table-responsive">
                <?php echo $table->renderTable(); ?>
            </div>
            <div class="mt-3">
                <?php echo $table->renderPagination(); ?>
            </div>
        </section>
    </div>

    <script src="{{ asset('assets/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
