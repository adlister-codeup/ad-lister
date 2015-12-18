<?php 
class DateRangeException extends Exception { }
class Input
{

    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key)
    {
        return isset($_REQUEST[$key]) ? true : false;
    }

    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null)
    {
        return self::has($key) ? $_REQUEST[$key] : $default;
    }
    public static function getString($key, $min = 0, $max = 250) 
    {
        $trimInput = trim($key);
        if (!is_string(self::get($trimInput))) {
            throw new DomainException("Please enter a valid input, letters A-Z");
        } else if (!is_numeric($min) || (!is_numeric($max))){
            throw new InvalidArgumentException("$min and $max must be numbers");
        } else if (empty(self::get($trimInput))) {
            throw new OutOfRangeException("Please enter a value");
        } else if ($key > $max || $key < $min) {
            throw new LengthException('Input is either too short or too long');
        } else {
            return self::get($trimInput);
        }
    }
    public static function getNumber($key, $min = 1, $max = 100000000) 
    {
        if (!is_numeric(self::get($key))) {
            throw new DomainException("Please enter a valid input, numbers 0-9");
        } else if (!is_numeric($min) || (!is_numeric($max))){
            throw new InvalidArgumentException("$min and $max must be numbers");
        } else if (empty(self::get($key))) {
            throw new OutOfRangeException("Please enter a value");
        } else if ($key > $max || $key < $min) {
            throw new RangeException('Input is either too short or too big');
        } else {
            return self::get($key);
        }
    }

    public static function getDate($key, $min = null , $max = null) 
    {
        try {
         $date = new DateTime(self::get($key));
        } catch (Exception $e) {
            throw new Exception("Please enter a valid date");
        }
        if (empty(self::get($key))) {
            throw new OutOfRangeException("Please enter a value");
        } else if ($date > $max || $date < $min) {
            throw new DateRangeException("Date is either too short or too big");
        } else if ($date == false) {
            throw new Exception("Please enter a valid date");
        } else {  
            return $date;
        }
       
    }

    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    ///////////////////////////////////////////////////////////////////////////
    private function __construct() {}
}