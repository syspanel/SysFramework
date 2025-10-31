<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace App\Console;

use PDO;

class MakeClientTableCommand
{
    /** @var PDO $pdo PDO database connection */
    private $pdo;

    /**
     * Constructor receives a PDO instance for database operations
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Executes the command: creates the table and inserts random clients.
     */
    public function execute()
    {
        // Create the 'clients' table if it does not exist
        $this->createTable();

        // Insert 10 random clients into the table
        $this->insertRandomClients(10);
    }

    /**
     * Creates the 'clients' table with predefined columns.
     * Columns include company, name, password, email, address, phone, notes, and timestamps.
     */
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

        // Output confirmation to CLI
        echo "Table 'clients' created successfully.\n";
    }

    /**
     * Inserts a number of random clients into the 'clients' table.
     * Uses prepared statements for security.
     *
     * @param int $count Number of clients to insert
     */
    private function insertRandomClients($count)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO clients (company, name, password, email, address, phone, notes) 
            VALUES (:company, :name, :password, :email, :address, :phone, :notes)
        ");

        for ($i = 0; $i < $count; $i++) {
            // Generate random data for each client
            $company = "Company" . rand(1, 100);
            $name = "Client" . rand(1, 100);
            $password = password_hash("password", PASSWORD_BCRYPT); // Secure hashed password
            $email = strtolower($name . "@example.com");
            $address = "Address " . rand(1, 100);
            $phone = "555-" . rand(1000, 9999);
            $notes = "Notes for " . $company;

            // Execute prepared statement
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

        // Output confirmation to CLI
        echo "$count random clients inserted successfully.\n";
    }
}
