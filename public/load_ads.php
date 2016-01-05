<?php
	require_once "../models/AdTable.php";

	if (isset($_POST["amount"]))
	{
		$amount = (int)$_POST["amount"];
	}
	else 
	{
		$amount = 12;
	}
	if (isset($_POST["page"]))
	{
		$offset = ($_POST["page"] - 1) * $amount;
	} 
	else
	{
		$offset = 0;
	}
	$load = new AdTable;
	if ($_POST["search"] == "")
	{
		$ads = $load->loadAds($offset, $amount);
	}
	else 
	{
		$ads = $load->searchAll($offset, $amount, $_POST["search"]);
	}
	if (!isset($data["images"][0]))
    {
        $data["images"][0] = "img/no_image_available.png";
    }
	echo $ads;
?>