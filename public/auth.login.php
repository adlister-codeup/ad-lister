<?php
require '../utils/Auth.php';
require '../utils/input.php';
session_start();
$sessionId = session_id();


if (Auth::check()) {
  header("Location: /index.php");
  die();
} 
$loginFail = false;
$username = Input::get('username');
$password = Input::get('password');

if (Auth::attempt($username,$password)) {
  header("Location: /index.php");
  die();
} else if ($username !== null && $password !== null) {
  $loginFail = true;
} 
$_SESSION['IS_LOGGED_IN'] = false;
?>
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
    <form class="form-signin signup">
      <h4 class="form-signin-heading">New? <button type="button" class="btn"><a href="users.create.php">Sign up!</a></button></h4>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
            <button class="largebtn">Login</button>   
  </div>
</body>
</html