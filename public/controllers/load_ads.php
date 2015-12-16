<?php
	require_once "../../models/AdTable.php";

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
	$ads = $load->loadAds($offset, $amount);
	echo $ads;
?>