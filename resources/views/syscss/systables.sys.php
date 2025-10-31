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

<link href="/assets/syscss/css/systables.css" rel="stylesheet">
<script src="/assets/syscss/js/systables.js" defer></script>

@extends('layouts.app')

@section('title', 'Exemplo do uso da Classe SysTables') 
@endsection

@section('content')

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

@endsection
