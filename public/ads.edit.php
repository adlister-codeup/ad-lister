<?php
		require_once "../models/AdTable.php";
		if (isset($_GET["ad"]))
		{
			session_start();
			if (isset($_SESSION["user"]))
			{
				$load = new AdTable();
				try
				{
					$ad = $load->loadAd($_GET["ad"]);
				} catch (Exception $e)
				{
					echo "Invalid Ad id.";
					exit;
				}
				if ($_SESSION["user"]!=$ad["owner"])
				{
					echo "this is not your ad, you do not have permission to edit it.";
					exit;
				} 
				else
				{
					extract($ad);
				}
			} 
			else
			{
				echo "Please log in.";
				exit;
			}
		} 
		else
		{
			echo "Ad does not exist.";
			exit;
		}
?>
<!DOCTYPE html>
<html>
<head>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<link rel="stylesheet" href="../css/home.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<title>Krieger's List</title>
  	<?php include '../views/partials/navbar.php'; ?>
  	<div class="container">
    	<div class="page-header">
   			<h2>Edit your listing</h2>
    	</div>
	</div>
</head>
	<body>
	 		<div class="row">
		 		<div class="col-md-10 col-md-offset-1">
			 		<form class="form-group">
			 			<label for="title">Current Title</label>
						<input class="form-control" type="text" id="title" placeholder="Title" value="<?=$title?>" required>
						<label for="desc">Current Description</label>
						<textarea class="form-control" type="text" id="desc" placeholder="Description"><?=$description?></textarea>
						<button><a href="http://adlister.dev/image_edit.php">Change Images</a></button>
						<br>
						<label for="email">Contact Email</label>
						<input class="form-control" type="email" id="email" placeholder="email@email.email" value="<?=$email?>" required>
						<label for="phone">Phone</label>
						<input class="form-control" type="tel" id="phone" placeholder="Enter Phone Number" value="<?=$phone?>">
						<label for="price">Price $</label>
						<input class="form-control" type="number" id="price" placeholder="0.00" value="<?=$price?>" required>
						<label for="location">Location</label>
						<input class="form-control" type="text" id="location" placeholder="san antonio" value="<?=$location?>">
						<br>
						<button class="btn btn-default" type ="reset">Clear</button>
						<button class="btn btn-success">Update listing</button>
			 		</form>
		 		</div>
		 	</div>

	 		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>