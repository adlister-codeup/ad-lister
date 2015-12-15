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
	    <div class="row">
	        <div class="">
	            <h2 class="form-signin-heading">Please sign up</h2>
	            <form action="#" method="post" class="form" role="form">
	            <div class="row">
	                <div class="col-xs-6 col-md-6">
	                    <input class="form-control" name="firstname" placeholder="First Name" type="text"
	                        required autofocus />
	                </div>
	                <div class="col-xs-6 col-md-6">
	                    <input class="form-control" name="lastname" placeholder="Last Name" type="text" required />
	                </div>
	            </div>
	            <input class="form-control" name="youremail" placeholder="Your Email" type="email" />
	            <input class="form-control" name="reenteremail" placeholder="Re-enter Email" type="email" />
	            <input class="form-control" name="password" placeholder="New Password" type="password" />
	            <label for="">Birth Date</label>
	            <div class="row">
	                <div class="col-xs-4 col-md-4">
	                    <select class="form-control">
	                        <option value="Month">Month</option>
	                        <option value="Month">January</option>
	                        <option value="Month">jasdf</option>
	                    </select>
	                </div>
	                <div class="col-xs-4 col-md-4">
	                    <select class="form-control">
	                        <option value="Day">Day</option>
	                    </select>
	                </div>
	                <div class="col-xs-4 col-md-4">
	                    <select class="form-control">
	                        <option value="Year">Year</option>
	                    </select>
	                </div>
	            </div>
	            <label class="radio-inline">
	                <input type="radio" name="sex" id="inlineCheckbox1" value="male" />
	                Male
	            </label>
	            <label class="radio-inline">
	                <input type="radio" name="sex" id="inlineCheckbox2" value="female" />
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