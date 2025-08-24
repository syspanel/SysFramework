<?php

namespace App\Console;

use PDO;
use Exception;

class MakeUserTableCommand
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function execute()
    {
        try {
            $this->createTable();
            $this->insertRandomUsers(10);
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage() . "\n";
        }
    }

    private function createTable()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            date_of_birth DATE NOT NULL,
            notes TEXT DEFAULT NULL,
            is_active BOOLEAN DEFAULT TRUE,
            role VARCHAR(20) DEFAULT 'user',
            verification_token VARCHAR(255) DEFAULT NULL,
            reset_token VARCHAR(255) DEFAULT NULL,
            reset_expires TIMESTAMP DEFAULT NULL,
            confirmed_at TIMESTAMP DEFAULT NULL,  -- Data de confirmação do e-mail
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );";

        $this->pdo->exec($sql);
        echo "Tabela 'users' criada com sucesso.\n";
    }

    private function insertRandomUsers($count)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (firstname, lastname, password, email, date_of_birth, verification_token, confirmed_at) 
            VALUES (:firstname, :lastname, :password, :email, :date_of_birth, :verification_token, :confirmed_at)
        ");

        for ($i = 0; $i < $count; $i++) {
            $firstname = "First" . rand(1, 100);
            $lastname = "Last" . rand(1, 100);
            $password = password_hash("password", PASSWORD_BCRYPT);
            $email = strtolower($firstname . "." . $lastname . "@example.com");
            $date_of_birth = date('Y-m-d', strtotime('-' . rand(18, 40) . ' years'));
            $verification_token = bin2hex(random_bytes(16)); // Gera um token aleatório
            $confirmed_at = null; // Não confirmados inicialmente

            try {
                $stmt->execute([
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':password' => $password,
                    ':email' => $email,
                    ':date_of_birth' => $date_of_birth,
                    ':verification_token' => $verification_token,
                    ':confirmed_at' => $confirmed_at,
                ]);
            } catch (Exception $e) {
                echo "Erro ao inserir usuário: " . $e->getMessage() . "\n";
            }
        }

        echo "$count usuários aleatórios inseridos com sucesso.\n";
    }
}
