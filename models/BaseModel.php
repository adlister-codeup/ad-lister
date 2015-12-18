<?php

require_once '../database/private.php';

class Model {

    protected static $dbc;
    protected static $table;
    public $attributes = [];

    public function __construct()
    {
        self::dbConnect();
    }

    protected static function dbConnect()
    {
        if (!self::$dbc)
        {
           require_once '../database/db_connect.php';
           self::$dbc = $dbc;
        }
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
    public function __get($name)
    {
       if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
        return null;
    }
    protected function bindQuery($query) 
    {
        $stmt = self::$dbc->prepare($query);
            foreach($this->attributes as $keys => $values) 
            {
                $stmt->bindValue(':' . $keys, $values, PDO::PARAM_STR);
            }
            $stmt->execute();
    }
    protected function insert() 
    {
        $keysArray = [];
        $valuesArray = [];
        foreach($this->attributes as $keys => $values) {
            array_push($keysArray, $keys);
            array_push($valuesArray, ':' . $keys);
        }
            $keysString = implode(', ', $keysArray);
            $valuesString = implode(', ', $valuesArray);
            $query = 'INSERT INTO '  . static::$table .  ' (' . $keysString . ') 
            VALUES (' .  $valuesString . ')';
            $this->bindQuery($query);
    }

    protected function update() 
    {
        $updatedArray = [];
        foreach($this->attributes as $keys => $values) {
            $originalValues = $keys . ' = :' . $keys;
            array_push($updatedArray, $originalValues);
        }
            $updatedString = implode(', ', $updatedArray);
            $query = 'UPDATE '  . static::$table .
                ' SET ' . $updatedString . 
                ' WHERE id = :id';
            $stmt = self::$dbc->prepare($query);
            $this->bindQuery($query);
    }
    
    public function save()
    {
        if (!empty($this->attributes['id']) && 
            isset($this->attributes['id'])) {
                $this->update($this->attributes['id']);
        } else {
            $this->insert();
        }
    }

    public function delete($id) 
    {

        $query = "
            DELETE  
            FROM " . static::$table . "
            WHERE id = :id;
            ";
            $stmt = self::$dbc->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
    }

    public static function find($id)
    {
        // Get connection to the database
        self::dbConnect();
        
        $query = "
            SELECT * 
            FROM `contacts`
            WHERE  id = :id;
        ";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $instance = null;
        if ($result)
        {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }

    /*
     * Find all records in a table
     */
    public static function all()
    {
        self::dbConnect();
        $query = "
            SELECT * 
            FROM `contacts`
        ";
        $stmt = self::$dbc->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $instance = null;
        if ($result)
        {
            $instance = new static;
            $instance->attributes = $result;
        }
        return $instance;
    }
        // @TODO: Learning from the previous method, return all the matching records
}