<?php
require_once 'Log.php';
require_once '../models/User.php';
class Auth 
{
	
	public static $logFail = false;
	public static $logger;

	public static function getLog() 
	{
		if (!isset(self::$logger)) { 
			self::$logger = new Log();
		}
		return self::$logger;
	}
	public static function attempt($username, $password) 
	{
		$errors = [];
		$user = new User;
		try{ 
			$data = $user->checkUser($username);
		} catch (Exception $e) {
			$errors[] = $e->getMessage();
		}
		$logger = self::getLog();
		if (empty($errors)) {
			if (password_verify($password, $data['hash'])) 
			{
				session_start();
				$_SESSION['user'] = $username;
				var_dump($username);
				return true;
			} else {
				return false;
			}
		}
	}
	public static function check()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']) 
		{
			return true;
		} 
			return false;
	}
	public static function user() 
	{
		if (isset($_SESSION['user'])) 
		{
			return $_SESSION['user'];
		} 
	}
	public static function logOut() 
	{
		 $_SESSION = array();

	    if (ini_get("session.use_cookies")) {
	        $params = session_get_cookie_params();
	        setcookie(session_name(), '', time() - 42000,
	            $params["path"], $params["domain"],
	            $params["secure"], $params["httponly"]
	        );
	    }
	}
}