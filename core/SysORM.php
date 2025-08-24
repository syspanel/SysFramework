<?php

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa marcocosta@gmx.com                           */
/*                                                                      */
/* https://sysframework.com                                             */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: marcocosta@gmx.com                            */
/************************************************************************/

namespace Core;

use PDO;

class SysORM
{
    protected $table;
    protected $fillable = [];
    protected $hidden = [];
    protected $attributes = [];

    protected static $pdo;

    protected static function connect()
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        }

        return self::$pdo;
    }

    public static function lastInsertId()
    {
        return self::connect()->lastInsertId();
    }







    private function filterFillable(array $data)
    {
        return array_filter(
            $data,
            function ($key) {
                return in_array($key, $this->fillable);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    public static function all()
    {
        $instance = new static;
        $query = "SELECT * FROM {$instance->table}";
        $stmt = self::connect()->query($query);

        return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }

    public static function find($id)
    {
        $instance = new static;
        $query = "SELECT * FROM {$instance->table} WHERE id = :id LIMIT 1";
        $stmt = self::connect()->prepare($query);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetchObject(get_called_class());
        if ($result) {
            $result->attributes['id'] = $id;
        }

        return $result;
    }

    public static function create(array $data)
    {
        $instance = new static;
        $data = $instance->filterFillable($data);

        $columns = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));

        $query = "INSERT INTO {$instance->table} ($columns) VALUES ($values)";
        $stmt = self::connect()->prepare($query);
        $stmt->execute($data);

        return self::find(self::connect()->lastInsertId());
    }

    public function update(array $data)
    {
        $data = $this->filterFillable($data);

        $set = implode(', ', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($data)));

        $query = "UPDATE {$this->table} SET $set WHERE id = :id";
        $stmt = self::connect()->prepare($query);
        $data['id'] = $this->attributes['id']; // Define o ID para a atualização
        $stmt->execute($data);
    }

    public static function destroy($id)
    {
        $instance = new static;
        $query = "DELETE FROM {$instance->table} WHERE id = :id";
        $stmt = self::connect()->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function toArray()
    {
        $array = $this->attributes;
        foreach ($this->hidden as $hiddenField) {
            unset($array[$hiddenField]);
        }

        return array_map(function ($value) {
            return is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
        }, $array);
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
