<?php
	require_once "../models/AdTable.php";
	if (isset($_POST["change"]))
	{
		if ($_POST["change"] == "add")
		{
			if (!empty($_FILES["images"]))
			{
				$data["images"] = $_FILES["images"];
			}
			foreach ($_POST as $key => $value) 
			{
				$data[$key] = $value;
			}
			session_start();
			unset($data["change"]);
			$data["categories"]="derp";
			$add = new AdTable();
			$add->user = $_SESSION["user"];
			$add->addAd($data);
			header('Location: http://adlister.dev');
		}
	}