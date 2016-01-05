<?php
require_once '../utils/Auth.php';
require_once '../utils/input.php';
require_once '../models/BaseModel.php';

$sessionId = session_id();
if (!Auth::check()) {
  header("Location: /index.php");
  die();
} 
if (!empty($_POST)) {
  $errors = [];
  try {
      $username = Input::getString('username');
  } catch (Exception $e) {
      $errors['username'] = $e->getMessage();
  }
  try {
      $password = Input::getString('password');
  } catch (Exception $e) {
      $errors['password'] = $e->getMessage();
  }
  $loginFail = false;

  if (Auth::attempt($username,$password)) {
    header("Location: /index.php");
    die();
  } else if ($username !== null && $password !== null) {
    $loginFail = true;
  } 
  $_SESSION['user'] = false;
} else {
  $loginFail = false;
}

?>
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
    <div class="page-header">
      <?php if (!$loginFail): ?>
        <h3>Input Info:</h3>
      <?php else: ?>
        <h1>Login Failed...Try Again</h1>
      <?php endif; ?>
    </div>
  </div>        
  <div class="container center-block">
    <form class="form-signin signup" action='#' method='POST'>
      <h4 class="form-signin-heading">New? <button type="button" class="btn"><a href="/users.create.php">Sign up!</a></button></h4>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="username" name ='username'id="input_username" class="form-control" placeholder="Enter Username" required="" autofocus=""><br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name='password' id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
            <button class="largebtn" type='submit'>Login</button>   
  </div>
</body>
<script src="js/buttons.js"></script>

</html