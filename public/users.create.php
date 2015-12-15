<!DOCTYPE html>


<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/home.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <title>Krieger's List</title>
  <?php include '../views/partials/navbar.php'; ?>
	<div class="container">
    	<div class="page-header">
   			<h2>Sign Up!</h2>
   		</div>
	</div>
</head>

<body>
	<div class="container">
	    <div class="row">
	        <div class="center-block">
	            <form action="#" method="post" class="form" role="form">
	            <div class="row">
	                <div class="col-xs-6 col-md-6">
	                    <input class="form-control" name="firstname" placeholder="First Name" type="text"
	                        required autofocus>
	                </div>
	                <div class="col-xs-6 col-md-6">
	                    <input class="form-control" name="lastname" placeholder="Last Name" type="text" required>
	                </div>
	            </div>
	            <label for="email" type="email" id="email">E-mail</label>
	            <input class="form-control" name="youremail" placeholder="Your Email" type="email">
	            <label for="password" type="password" id="password">Password</label>
	            <input class="form-control" name="password" placeholder="New Password" type="password">
	            <label for="reenterpassword" type="reenterpassword" id="reenterpassword">Re-enter password</label>
	            <input class="form-control" name="reenterpassword" placeholder="Re-enter Password" type="password">
	            <label for="birthdate" type="text" id="birthdate">Birthdate</label>
	            <input class="form-control" name="birthdate" placeholder="Birthday" type="date">



	            <label class="radio-inline">
	                <input type="radio" name="sex" id="inlineCheckbox1" value="male">
	                Male
	            </label>
	            <label class="radio-inline">
	                <input type="radio" name="sex" id="inlineCheckbox2" value="female">
	                Female
	            </label>
	            <br />
	            <br />
	            <button class="btn btn-lg btn-primary btn-block" type="submit">
	                Sign up</button>
	            </form>
	        </div>
	    </div>
	</div>
</body>