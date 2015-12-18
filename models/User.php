<?php 
require_once 'BaseModel.php';
class User extends Model
{
    protected static $table = 'users';
    public static function checkUsername($userName) 
    { 
    	self::dbConnect();
    	$query = "SELECT username FROM users WHERE username = :username";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username', $userName, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    	return $count;
    }
    public static function checkEmail($email) 
    { 
    	self::dbConnect();
    	$query = "SELECT email FROM users WHERE email = :email";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    	return $count;
    }
    public static function checkUser($username) 
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = self::$dbc->prepare($query);
        $stmt->bindValue(':username',$username, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data;
        } else {
            throw new Exception("Username or Password was invalid");
        }
    }
}
