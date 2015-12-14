<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<title>Add a Listing</title>
	</head>
	<body>
	 		<?php include '../views/partials/navbar.php'; ?>
	 		<?php include '../views/partials/header.php'; ?>
	 		<div class="row">
		 		<div class="col-md-10 col-md-offset-1">
			 		<form class="form-group">
			 			<label for="title">Title</label>
						<input class="form-control" type="text" id="title" placeholder="Title" required>
						<label for="desc">Description</label>
						<textarea class="form-control" type="text" id="desc" placeholder="Description"></textarea>
						<label for="img">Images</label>
						<input type="file" id="img">
						<label for="email">Email</label>
						<input class="form-control" type="email" id="email" placeholder="email@email.email" required>
						<label for="phone">Phone</label>
						<input class="form-control" type="tel" id="phone" placeholder="Enter Phone Number">
						<label for="price">Price $</label>
						<input class="form-control" type="number" id="price" placeholder="0.00" required>
						<label for="location">Location</label>
						<input class="form-control" type="text" id="location" placeholder="san antonio">
						<br>
						<button class="btn btn-default" type ="reset">Clear</button>
						<button class="btn btn-success">Submit listing</button>
			 		</form>
		 		</div>
		 	</div>

	 		<?php include '../views/partials/footer.php'; ?>
	</body>
</html>