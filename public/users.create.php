<?php 
require_once '../utils/Input.php';
require_once '../models/User.php';
$errors = [];
if (!empty($_POST)) {
     try {
        $userName = Input::getString('user_name');
    } catch (Exception $e) {
        $errors['user_name'] = $e->getMessage();
    }
    try {
        $firstName = Input::getString('first_name');
    } catch (Exception $e) {
        $errors['first_name'] = $e->getMessage();
    }
    try {
        $lastName = Input::getString('last_name');
    } catch (Exception $e) {
        $errors['last_name'] = $e->getMessage();
    }
    try {
        $password = Input::getString('password');
    } catch (Exception $e) {
        $errors['password'] = $e->getMessage();
    }
    try {
        $reEnterPassword = Input::getString('reenterpassword');
    } catch (Exception $e) {
        $errors['reenterpassword'] = $e->getMessage();
    }
    try {
        $email = Input::getString('email');
    } catch (Exception $e) { 
        $errors['email'] = $e->getMessage();
    }
    try {
        $dateTimeObject = Input::getDate('birth_date', new DateTime('1900-01-01'), new DateTime());
    } catch (Exception $e) {
        $errors['birth_date'] = $e->getMessage();
    }
    try {
        $gender = Input::getString('gender');
    } catch (Exception $e) {
        $errors['gender'] = $e->getMessage();
    }
    if (empty($errors)) {
    $formattedDate = $dateTimeObject->format('Y-m-d');
        $user = new User;
        $user->user_name = Input::get($userName);
        $user->first_name = Input::get($first_name);
        $user->last_name = Input::get($last_name);
        $user->password = hash('sah256',Input::get($password));
        $user->email = Input::get($email);
        $user->birth_date = Input::get($formattedDate);
        $user->gender = Input::get($gender);
        $user->save();
    }
}
$findError = 'errorFinder';

?>
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
	                        <input class="form-control" name="user_name" placeholder="Enter a UserName" type="text"
	                            required autofocus />
	                    </div>
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
		            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
	            </form>
	        </div>
	    </div>
	</div>
</body>
