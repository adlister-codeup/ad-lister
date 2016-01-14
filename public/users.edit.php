<?php
require_once '../utils/Input.php';
require_once '../models/User.php';
require_once '../utils/Auth.php';
$errors = [];
$username = $_SESSION['user'];
$user = User::findUser($username);
if (!empty($_POST)) {
     try {
        $userName = Input::getString('username');
    } catch (Exception $e) {
        $errors['username'] = $e->getMessage();
    }
    try {
        $first_name = Input::getString('first_name');
    } catch (Exception $e) {
        $errors['first_name'] = $e->getMessage();
    }
    try {
        $lastName = Input::getString('last_name');
    } catch (Exception $e) {
        $errors['last_name'] = $e->getMessage();
    }
    try {
        $email = Input::getString('email');
    } catch (Exception $e) { 
        $errors['email'] = $e->getMessage();
    }
    var_dump($errors);

    try {
        if ($user->checkUsername($userName)) {
            throw new Exception("Username has been taken");
        }
    } catch (Exception $e) {
        if ($userName != NULL) {
            $errors['username'] = $e->getMessage();
        }
    }
     try {
        if ($user->checkEmail($email)) {
            throw new Exception("Email is already in use");
        }
    } catch (Exception $e) {
        if ($email != NULL) {
            $errors['email'] = $e->getMessage();
        }
    }
    if (empty($errors)) {
        $formattedDate = $dateTimeObject->format('Y-m-d');
        $user->username = $userName;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->save();
    }
}
?>
<!DOCTYPE html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/home.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <title>Krieger's List</title>
  <script src='http://code.jquery.com/jquery-2.1.1.min.js'></script>
  <script src='/jquery.validate.js'></script>
</head>

<body>
  <?php include '../views/partials/navbar.php'; ?>
  <div class="container">
      <h1>Edit Profile</h1>
    	<hr>
  	<div class="row">
        <!-- left column -->
        <div class="col-md-3">
          <div class="text-center">
            <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
            <h6>Upload a different photo...</h6>
            
            <input type="file" class="form-control">
          </div>
        </div>
        
        <!-- edit form column -->
        <div class="col-md-9 personal-info">
          <div class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a> 
            <i class="fa fa-coffee"></i>
            This is an <strong>.alert</strong>. Use this to show important messages to the user.
          </div>
          <h3>Personal info</h3>
          
          <form action="#" method="post" id ="edit" class="form" role="form">
            <div class="form-group">
              <label class="col-lg-3 control-label">First name:</label>
              <div class="col-lg-8">
                <input class="form-control" id='first_name' name='first_name' type="text"
                placeholder='<?= empty($errors['first_name']) ? '': "Error: " . $errors['first_name']?>'  
                value='<?= $user->first_name ?>'<br>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Last name:</label>
              <div class="col-lg-8">
                <input class="form-control" id='last_name' name='last_name' type="text"
                placeholder='<?= empty($errors['last_name']) ? '': "Error: " . $errors['last_name']?>'  
                value='<?= $user->last_name ?>'><br>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-8">
                <input class="form-control" id='email' name='email' type="text"
                placeholder='<?= empty($errors['email']) ? '': "Error: " . $errors['email']?>'  
                value='<?= $user->email ?>'><br>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Username:</label>
              <div class="col-md-8">
                <input class="form-control" id='username' name='username' type="text"
                placeholder='<?= empty($errors['username']) ? '': "Error: " . $errors['username']?>' 
                value='<?= $user->username ?>'><br>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <button class="btn primary" type="submit">Save Changes</button>
                <span></span>
                <input type="reset" class="btn btn-default" value="Cancel">
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
  <?php include '../views/partials/footer.php'; ?>
  <script>
  $(document).ready(function() {
    $.validator.setDefaults({
        submitHandler: function() {
            form.submit();
        }
    });
    $("#edit").validate({
        rules: {
            password: {
                minlength: 5
            },
            confirm_password: {
                minlength: 5,
                equalTo: "#password"
            },
            email: {
                email: true
            },
        },
        messages: {
            password: {
                minlength: "Password must be atleast 5 letters"
            },
            confirm_password: {
                minlength: "Password must be atleast 5 letters",
                equalTo: "Must be equal to password"
            },
            email: {
                email: "Your email address must be in the format of name@domain.com"
            },
        }
    });
});

  </script>
</body>