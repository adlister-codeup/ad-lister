<?php
	class Log
	{
		public $enableMicroseconds; 
		public $handle;
		public $subname;
		// __construct options | var = new Log(var1, var2, var3, var4, var5);
		// var1 string  | option to set a name to prevent multiple programs from logging to the same file.
		// var2 string  | option to give a name at the beggining of the log msg to help determine where the msg came from.
		// var3 string  | option to place logs in an folder and set a folder name. Set to false(any type) to not use a folder.
		// var4 boolean | option to enable microseconds in the log timestamp for better analysis.
		// var5 string  | option to set a different timezone, uses PHP timezone formating.
		function __construct($name = "default", $subname = "default", $dir = "default-logs", $enableMicroseconds = false, $timezone = "America/Chicago") 
		{
			date_default_timezone_set($timezone);
			$this->enableMicroseconds = $enableMicroseconds;
			$this->subname = $subname;
			$filename = "{$name}-log-".date("Y-m-d").".txt";
			if ($dir != false)
			{
				if (is_dir($dir) === false)
				{
					mkdir("{$dir}");
				}
				$this->handle = fopen($dir."/".$filename, "a+");
			}
			else
			{
				$this->handle = fopen($filename, "a+");
			}
		}
		function __destruct()
		{
			fclose($this->handle);
		}
		public function logMessage ($logLevel, $message)
		{
			if ($this->enableMicroseconds)
			{
				$t = microtime(true);
				$micro = sprintf("%06d",($t - floor($t)) * 1000000);
				$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
				$time = $d->format("Y-m-d H:i:s.u"); // sets the time with microseconds included 
				unset($d);
			} else 
			{
				$time = date("Y-m-d H:i:s");	
			}
			fwrite($this->handle, "[{$this->subname}] {$time} [{$logLevel}] {$message}".PHP_EOL); // write to file
		}
		public function info ($message)
		{
			$this->logMessage("INFO", $message);
		}
		public function error ($message)
		{
			$this->logMessage("ERROR", $message);
		}
	}
?>