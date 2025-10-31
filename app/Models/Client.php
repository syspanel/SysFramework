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

namespace App\Models;

use Core\SysORM;

class Client extends SysORM
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'password',
        'company',
        'address',
        'phone',
        'email',
        'notes'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Creates a new client with hashed password.
     *
     * @param array $data
     * @return int Inserted client ID
     */
    public static function createClient(array $data)
    {
        $instance = new static();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $query = "INSERT INTO {$instance->table} 
                  (name, password, company, address, phone, email, notes) 
                  VALUES (:name, :password, :company, :address, :phone, :email, :notes)";
        
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([
            ':name' => $data['name'],
            ':password' => $data['password'],
            ':company' => $data['company'],
            ':address' => $data['address'],
            ':phone' => $data['phone'],
            ':email' => $data['email'],
            ':notes' => $data['notes'] ?? null,
        ]);

        return $instance->lastInsertId();
    }

    /**
     * Finds a client by email.
     *
     * @param string $email
     * @return array|false
     */
    public static function findByEmail(string $email)
    {
        $instance = new static();
        $query = "SELECT * FROM {$instance->table} WHERE email = :email";
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Updates the password of a client.
     *
     * @param int $clientId
     * @param string $newPassword
     * @return bool
     */
    public static function updatePassword(int $clientId, string $newPassword)
    {
        $instance = new static();
        $query = "UPDATE {$instance->table} 
                  SET password = :password 
                  WHERE id = :id";
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_BCRYPT),
            ':id' => $clientId
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Inserts random clients for testing purposes.
     *
     * @param int $count
     * @return void
     */
    public static function createRandomClients(int $count = 10)
    {
        for ($i = 0; $i < $count; $i++) {
            self::createClient([
                'name' => "Client" . rand(1, 1000),
                'password' => 'password',
                'company' => "Company" . rand(1, 1000),
                'address' => "Address " . rand(1, 1000),
                'phone' => "555-" . rand(1000, 9999),
                'email' => "client" . rand(1, 10000) . "@example.com",
                'notes' => "Random notes"
            ]);
        }
    }
}
