<?php

namespace App\Models;

use Core\SysORM;

class Auth extends SysORM
{
    protected $table = 'users'; 

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'date_of_birth',
        'verification_token',
        'is_active',
        'reset_token',
        'reset_expires',
    ];

    protected $hidden = [
        'password',
        'verification_token',
        'reset_token',
    ];

public function saveConfirmationToken($userId, $token)
{
    $query = "UPDATE " . $this->table . " SET verification_token = :token WHERE id = :id";
    $stmt = $this->connect()->prepare($query);
    $stmt->execute([':token' => $token, ':id' => $userId]);

    return $stmt->rowCount() > 0;
}

    public static function verifyToken($userId, $token)
    {
        $instance = new static();
        $query = "SELECT * FROM " . $instance->table . " WHERE id = :id AND verification_token = :token";
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([':id' => $userId, ':token' => $token]);

        return $stmt->fetch() !== false;
    }

    public static function confirmUser($userId)
    {
        $instance = new static();
        $query = "UPDATE " . $instance->table . " SET confirmed_at = NOW(), verification_token = NULL WHERE id = :id";
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([':id' => $userId]);

        return $stmt->rowCount() > 0; 
    }

    public static function where($column, $value)
    {
        $instance = new static();
        $query = "SELECT * FROM " . $instance->table . " WHERE {$column} = :value";
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([':value' => $value]);
        return $stmt->fetchAll();
    }

   public static function create($data)
    {
        $instance = new static();

        $query = "INSERT INTO " . $instance->table . " (firstname, lastname, email, password, date_of_birth) VALUES (:firstname, :lastname, :email, :password, :date_of_birth)";
        
        $stmt = $instance->connect()->prepare($query);
        $stmt->execute([
            ':firstname' => $data['firstname'],
            ':lastname' => $data['lastname'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':date_of_birth' => $data['date_of_birth'],
        ]);

        
        return $instance->lastInsertId();
    }
    
    
    
public static function saveResetToken($userId, $token)
{
    $instance = new static();
    $query = "UPDATE " . $instance->table . " SET reset_token = :token, reset_expires = NOW() + INTERVAL 1 HOUR WHERE id = :id";
    $stmt = $instance->connect()->prepare($query);
    $stmt->execute([':token' => $token, ':id' => $userId]);

    return $stmt->rowCount() > 0;
}




public static function verifyResetToken($userId, $token)
{
    $instance = new static();
    $query = "SELECT * FROM " . $instance->table . " WHERE id = :id AND reset_token = :token AND reset_expires > NOW()";
    $stmt = $instance->connect()->prepare($query);
    $stmt->execute([':id' => $userId, ':token' => $token]);

    return $stmt->fetch() !== false;
}





public static function updatePassword($userId, $newPassword)
{
    $instance = new static();
    $query = "UPDATE " . $instance->table . " SET password = :password, reset_token = NULL, reset_expires = NULL WHERE id = :id";
    $stmt = $instance->connect()->prepare($query);
    $stmt->execute([':password' => $newPassword, ':id' => $userId]);
}





}
