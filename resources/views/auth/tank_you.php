<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrigado!</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Adicione o link para o Bootstrap -->
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Obrigado pela sua confirmação!</h1>
        <div class="alert alert-success">
            <?php
            // Exibe a mensagem de agradecimento se existir
            if (isset($_SESSION['alert'])) {
                echo $_SESSION['alert'];
                unset($_SESSION['alert']); // Remove a mensagem após exibir
            }
            ?>
        </div>
        <a href="/login" class="btn btn-primary">Ir para o Login</a>
    </div>
</body>
</html>
