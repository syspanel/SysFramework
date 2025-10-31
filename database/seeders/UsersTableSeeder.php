<?php

namespace Database\Seeders;

class UsersTableSeeder
{
    public function run($conn)
    {
        $sql = "INSERT INTO users (first_name, last_name, group_name, birth_date, email, password, notes)
                VALUES
                ('John', 'Doe', 'Admin', '1980-01-01', 'john.doe@example.com', '" . password_hash('password123', PASSWORD_BCRYPT) . "', 'Initial user'),
                ('Jane', 'Smith', 'User', '1990-02-15', 'jane.smith@example.com', '" . password_hash('password456', PASSWORD_BCRYPT) . "', 'Another user')";

        if ($conn->query($sql) === TRUE) {
            echo "Seed data inserted successfully.\n";
        } else {
            echo "Error inserting data: " . $conn->error . "\n";
        }
    }
}
