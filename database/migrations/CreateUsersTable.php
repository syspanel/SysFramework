<?php

namespace Database\Migrations;

class CreateUsersTable
{
    public function up($conn)
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            group_name VARCHAR(255),
            birth_date DATE,
            email VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            notes TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'users' created successfully.\n";
        } else {
            echo "Error creating table: " . $conn->error . "\n";
        }
    }
}
