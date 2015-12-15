<!DOCTYPE html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/home.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <title>Krieger's List</title>
  <?php include '../views/partials/navbar.php'; ?>
</head>
<body>
	<div class="container">
	    <h1>UsernameHere</h1>
	  	<hr>
		<div class="row">
	      <div class="col-md-3">
	        <div class="text-center">
	          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
	          <h3><a href="users.edit.php"> Edit your profile</a></h3>
	        </div>
	      </div>
	        <div class="col-md-9 personal-info">
	        	<h3>Personal info</h3>
	        	<div class="well">Here is stuff about the user, whatever they feel like sharing</div>
			    <div class="row">
		            <div class="col-md-4 portfolio-item">
		                <a href="ads.show.php">
		                	<img class="img-responsive" src="http://placehold.it/700x400" alt="">
		                </a>
		                <h3>
		                    <a href="ads.show.php">Fake crap for sale</a>
		                </h3>
		                <p>10 cents a pail.</p>
		            </div>
		            <div class="col-md-4 portfolio-item">
		                <a href="ads.show.php">
		                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
		                </a>
		                <h3>
		                    <a href="#">Old item</a>
		                </h3>
		                <p>Item Description.</p>
		            </div>
		            <div class="col-md-4 portfolio-item">
		                <a href="ads.show.php">
		                    <img class="img-responsive" src="http://placehold.it/700x400" alt="">
		                </a>
		                <h3>
		                    <a href="#">Weird, used item</a>
		                </h3>
		                <p>Item description</p>
		            </div>
		        </div>
	       	</div>
	    </div>
	</div>
	<?php include '../views/partials/footer.php'; ?>
</body>
