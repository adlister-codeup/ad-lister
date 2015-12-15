<?php
	require_once "../models/AdTable.php";
	$ads = new AdTable;
	echo $ads->loadAds(0);
?>