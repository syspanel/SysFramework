<?php

namespace App\Console;

use PDO;

class MakeClientTableCommand
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function execute()
    {
        $this->createTable();
        $this->insertRandomClients(10); // Atualizando o nome do método
    }

    private function createTable()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            company VARCHAR(50) NOT NULL,
            name VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            address VARCHAR(50) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            notes TEXT DEFAULT NULL, 
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );";

        $this->pdo->exec($sql);
        echo "Tabela 'clients' criada com sucesso.\n";
    }

    private function insertRandomClients($count)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO clients (company, name, password, email, address, phone, notes) 
            VALUES (:company, :name, :password, :email, :address, :phone, :notes)
        ");

        for ($i = 0; $i < $count; $i++) {
            $company = "Company" . rand(1, 100);
            $name = "Client" . rand(1, 100);
            $password = password_hash("password", PASSWORD_BCRYPT);
            $email = strtolower($name . "@example.com");
            $address = "Address " . rand(1, 100);
            $phone = "555-" . rand(1000, 9999);
            $notes = "Notes for " . $company;

            $stmt->execute([
                ':company' => $company,
                ':name' => $name,
                ':password' => $password,
                ':email' => $email,
                ':address' => $address,
                ':phone' => $phone,
                ':notes' => $notes,
            ]);
        }

        echo "$count clientes aleatórios inseridos com sucesso.\n";
    }
}
