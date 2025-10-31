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
use Exception;

class MakeUserTableCommand
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
     * Executes the command: creates the 'users' table and inserts random users.
     */
    public function execute()
    {
        try {
            // Create 'users' table if not exists
            $this->createTable();

            // Insert 10 random users
            $this->insertRandomUsers(10);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    /**
     * Creates the 'users' table with all necessary columns and constraints.
     */
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
            confirmed_at TIMESTAMP DEFAULT NULL,  -- Email confirmation date
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );";

        $this->pdo->exec($sql);

        // Output confirmation to CLI
        echo "Table 'users' created successfully.\n";
    }

    /**
     * Inserts a given number of random users into the 'users' table.
     * Uses prepared statements for security and unique random tokens for email verification.
     *
     * @param int $count Number of users to insert
     */
    private function insertRandomUsers($count)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (firstname, lastname, password, email, date_of_birth, verification_token, confirmed_at) 
            VALUES (:firstname, :lastname, :password, :email, :date_of_birth, :verification_token, :confirmed_at)
        ");

        for ($i = 0; $i < $count; $i++) {
            // Generate random user data
            $firstname = "First" . rand(1, 100);
            $lastname = "Last" . rand(1, 100);
            $password = password_hash("password", PASSWORD_BCRYPT); // Secure hashed password
            $email = strtolower($firstname . "." . $lastname . "@example.com");
            $date_of_birth = date('Y-m-d', strtotime('-' . rand(18, 40) . ' years'));
            $verification_token = bin2hex(random_bytes(16)); // Random verification token
            $confirmed_at = null; // Not confirmed initially

            try {
                // Execute prepared statement
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
                echo "Error inserting user: " . $e->getMessage() . "\n";
            }
        }

        // Output confirmation to CLI
        echo "$count random users inserted successfully.\n";
    }
}
