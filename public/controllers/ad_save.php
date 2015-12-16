<?php
	require_once "../../models/AdTable.php";
	require_once "../../models/SaveImage.php";
	if (isset($_POST["change"]))
	{
		if ($_POST["change"] == "add")
		{
			if (isset($_FILES["images"]))
			{
				$images = $_FILES["images"];
				$saveImage = new SaveImage();
				$paths = $saveImage->save($images);
				echo $paths;
			}
			foreach ($_POST as $key => $value) 
			{
				$data[$key] = $value;
			}
			unset($data["change"]);
			$data["images"] = $paths;

			$add = new AdTable();
			$add->user ="krieger";
			$add->addAd($data);
		}
	}