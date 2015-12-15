<?php
require_once 'log.php';
class Auth 
{
	
	public static $logFail = false;
	public static $hashed_password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';
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
		$logger = self::getLog();
		if ($username == 'guest' && password_verify($password, self::$hashed_password)) 
		{
			$_SESSION['IS_LOGGED_IN'] = $username;
			var_dump($username);
			$logger->logInfo("User $username logged in");
			return true;
		} else {
			$logger->logError("User $username invalid info!");
			return false;
		}
	}
	public static function check()
	{
		if (isset($_SESSION['IS_LOGGED_IN']) && $_SESSION['IS_LOGGED_IN']) 
		{
			return true;
		} 
			return false;
	}
	public static function user() 
	{
		if (isset($_SESSION['IS_LOGGED_IN'])) 
		{
			return $_SESSION['IS_LOGGED_IN'];
		} 
	}
	public static function logOut() 
	{
		 $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
	    if (ini_get("session.use_cookies")) {
	        $params = session_get_cookie_params();
	        setcookie(session_name(), '', time() - 42000,
	            $params["path"], $params["domain"],
	            $params["secure"], $params["httponly"]
	        );
	    }
	}
}