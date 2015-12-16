<?php
	require_once "../../utils/Log.php";
	require_once "../../utils/UUID.php";
	class SaveImage
	{
		protected $source = [];
		protected $paths;
		function save($images)
		{
			$uuidGen = new UUID();
			$log = new Log("SaveImage", "save", "logs");
			$target_dir = "uploads/";
			if (is_dir("../".$target_dir) === false)
			{
				mkdir("../{$target_dir}");
			}
			foreach ($images["name"] as $key => $value)
			{
				$log->info("test");
				$uuid = $uuidGen->uuidv4();
				$imageFileType = pathinfo(basename($images["name"][$key]), PATHINFO_EXTENSION);
				$target_file = $target_dir.$uuid.".".$imageFileType;
				$check = getimagesize($images["tmp_name"][$key]);
				if($check !== false) {
					$log->info("File is an image.");
					$uploadOk = 1;
				} else {
					$log->error("File is not an image.");
					$uploadOk = 0;
				}
				if ($images["size"][$key] > 1000000) {
    				$log->error("Sorry, your file is too large.");
    				$uploadOk = 0;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
				{
					$log->error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
					$uploadOk = 0;
				}
				if ($uploadOk == 1)
				{
					move_uploaded_file($images["tmp_name"][$key], "../".$target_file);
					array_push($this->source, $target_file);	
					$log->info("{$target_file} was uploaded successfully.");
				} else 
				{
					$log->error("file was not uploaded.");
				}
			}
			$paths = implode("|", $this->source);
			$log->info("{$paths}");
			unset($uuidGen);
			unset($log);
			return $paths;
		}
	}
?>