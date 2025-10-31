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

namespace Core;

use PDO;

/**
 * SysORM - Simple ORM class for MySQL
 * Provides basic CRUD operations and automatic filtering of fillable fields.
 */
class SysORM
{
    protected $table;      // Table name associated with this model
    protected $fillable = []; // Fields allowed for mass assignment
    protected $hidden = [];   // Fields hidden in array or JSON output
    protected $attributes = []; // Holds model data as key-value pairs

    protected static $pdo; // PDO database connection instance

    /**
     * Establish or return existing PDO connection
     * 
     * @return PDO
     */
    protected static function connect()
    {
        if (self::$pdo === null) {
            // Create new PDO connection if none exists
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

    /**
     * Get the last inserted ID from PDO
     * 
     * @return string
     */
    public static function lastInsertId()
    {
        return self::connect()->lastInsertId();
    }

    /**
     * Filter array to include only fillable fields
     * 
     * @param array $data Input data array
     * @return array Filtered array with only fillable keys
     */
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

    /**
     * Get all records from the table
     * 
     * @return array Array of model instances
     */
    public static function all()
    {
        $instance = new static;
        $query = "SELECT * FROM {$instance->table}";
        $stmt = self::connect()->query($query);

        // Fetch all results as instances of the calling class
        return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }

    /**
     * Find a record by ID
     * 
     * @param mixed $id Record ID
     * @return static|null Model instance or null if not found
     */
    public static function find($id)
    {
        $instance = new static;
        $query = "SELECT * FROM {$instance->table} WHERE id = :id LIMIT 1";
        $stmt = self::connect()->prepare($query);
        $stmt->execute(['id' => $id]);

        $result = $stmt->fetchObject(get_called_class());
        if ($result) {
            // Ensure ID is set in attributes
            $result->attributes['id'] = $id;
        }

        return $result;
    }

    /**
     * Create a new record in the table
     * 
     * @param array $data Key-value pairs for insert
     * @return static Newly created model instance
     */
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

    /**
     * Update the current record
     * 
     * @param array $data Key-value pairs for update
     */
    public function update(array $data)
    {
        $data = $this->filterFillable($data);

        $set = implode(', ', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($data)));

        $query = "UPDATE {$this->table} SET $set WHERE id = :id";
        $stmt = self::connect()->prepare($query);
        $data['id'] = $this->attributes['id']; // Set ID for update condition
        $stmt->execute($data);
    }

    /**
     * Delete a record by ID
     * 
     * @param mixed $id Record ID
     */
    public static function destroy($id)
    {
        $instance = new static;
        $query = "DELETE FROM {$instance->table} WHERE id = :id";
        $stmt = self::connect()->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    /**
     * Convert model attributes to array
     * Escapes string values for safe HTML output
     * 
     * @return array
     */
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

    /**
     * Magic getter to access attributes
     * 
     * @param string $name Attribute name
     * @return mixed|null Attribute value or null if not set
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Magic setter to assign attributes
     * 
     * @param string $name Attribute name
     * @param mixed $value Value to assign
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
