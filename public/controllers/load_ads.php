<?php
	require_once "../models/AdTable.php";

	if (isset($_GET["page"]))
	{
		$offset = ($_GET["page"] - 1) * 25;
	}
	else 
	{
		$offset = 0;
	}
	$load = new AdTable;
	$ads = $load->loadAds($offset);
	echo $ads;
?>