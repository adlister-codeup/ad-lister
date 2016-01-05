<?php
	require_once "../utils/Log.php";
	require_once "../utils/UUID.php";
	require_once '../database/private.php';

	class Image
	{
		protected function database()
		{
			$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
			$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbc;
		}
		public function saveImg($images, $adid)
		{
			$dbc = $this->database();
			$uuidGen = new UUID();
			$log = new Log("Image", "save", "logs");
			$target_dir = "uploads/";
			if (is_dir($target_dir) === false)
			{
				mkdir($target_dir);
			}
			foreach ($images["name"] as $key => $value)
			{
				$uuid = $uuidGen->uuidv4();
				$imageFileType = pathinfo(basename($images["name"][$key]), PATHINFO_EXTENSION);
				$target_file = $target_dir.$uuid.".".$imageFileType;
				$check = getimagesize($images["tmp_name"][$key]);
				if($check !== false)
				{
					$log->info("File is an image.");
					$uploadOk = 1;
				} 
				else
				{
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
					move_uploaded_file($images["tmp_name"][$key], $target_file);	
					$query = "INSERT into images (adid, imgpath) VALUES (:adid, :imgpath)";
					$stmt = $dbc->prepare($query);
					$stmt->bindValue(":adid", $adid, PDO::PARAM_STR);
					$stmt->bindValue(":imgpath", $target_file, PDO::PARAM_STR);
					$stmt->execute();
					$log->info("{$target_file} was uploaded successfully.");
				}
				else 
				{
					$log->error("file was not uploaded.");
				}
			}
			$log->info("{$paths}");
			unset($uuidGen);
			unset($log);
		}
		public function deleteImg($adid)
		{
			$log = new Log("Image", "delete", "logs");
			$dbc = $this->database();
			$pathQuery = "SELECT imgpath FROM images WHERE adid=:id";
			$pathstmt = $dbc->prepare($pathQuery);
			$pathstmt->bindValue(":id", $adid, PDO::PARAM_STR);
			$pathstmt->execute();
			$data = $pathstmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data as $key => $value)
			{
				unlink($value);
			}
			$query = "DELETE from images WHERE adid=:adid";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":adid", $adid, PDO::PARAM_STR);
			$stmt->execute();
			unset($log);
		}
		public function loadImg($adid)
		{
			$images = [];
			$log = new Log("Image", "load", "logs");
			$dbc = $this->database();
			$query = "SELECT imgpath FROM images WHERE adid=:adid";
			$stmt = $dbc->prepare($query);
			$stmt->bindValue(":adid", $adid, PDO::PARAM_STR);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if ($data)
			{
				foreach ($data as $key => $value) 
				{
					array_push($images, $value["imgpath"]);
				}
			}
			$log->varLog($images);
			unset($log);
			return $images;
		}
	}
?>