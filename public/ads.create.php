<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 		<?php include '../views/partials/navbar.php';?>
		<title>Krieger's List</title>
		<div class="container">
    		<div class="page-header">
   				<h2>Post your listing</h2>
    		</div>
		</div>
	</head>
	<body>
		<div class="container center-block">
	 		<div class="row">
		 		<div class="col-md-10 col-md-offset-1">
			 		<form class="form-group" action="ad_save.php" method="POST" enctype="multipart/form-data">
			 			<label for="title">Title</label>
						<input class="form-control" type="text" id="title" name="title" placeholder="Title" required>
						<label for="desc">Description</label>
						<textarea class="form-control" type="text" id="desc" name="description" placeholder="Description"></textarea>
						<label for="img">Images</label>
						<input type="file" name="images[]" id="img" accept="image/*" multiple>
						<label for="email">Email</label>
						<input class="form-control" type="email" id="email" name="email" placeholder="email@email.email" required>
						<label for="phone">Phone</label>
						<input class="form-control" type="tel" id="phone" name="phone" placeholder="Enter Phone Number">
						<label for="price">Price $</label>
						<input class="form-control" type="number" id="price" name="price" placeholder="0.00" required>
						<label for="location">Location</label>
						<input class="form-control" type="text" id="location" name="location" placeholder="san antonio">
						<label for="categories">Categories</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" value="automobiles"> Automobiles
								</label>
								<label>
									<input type="checkbox" value="bionicparts"> Bionic Parts
								</label>
								<label>
									<input type="checkbox" value="blackmarket"> Black Market
								</label>
								<label>
									<input type="checkbox" value="education"> Education
								</label>
								<label>
									<input type="checkbox" value="jobs"> Jobs
								</label>
								<label>
									<input type="checkbox" value="pets"> pets
								</label>
								<label>
									<input type="checkbox" value="homes"> Homes
								</label>
								<label>
									<input type="checkbox" value="forrent"> For Rent
								</label>
								<label>
									<input type="checkbox" value="other"> Other
								</label>
							</div>
						<br>
						<input type="text" name="change" value="add" hidden>
						<button class="btn btn-default" type ="reset">Clear</button>
						<button class="btn btn-success">Submit listing</button>
			 		</form>
		 		</div>
		 	</div>
		 </div>
	 	<?php include '../views/partials/footer.php'; ?>
	</body>
</html>