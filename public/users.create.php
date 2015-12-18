<?php 
require_once '../utils/Input.php';
require_once '../utils/Log.php';
$logger = new Log("users.create.php","signup", "logs");
require_once '../models/User.php';


$errors = [];
if (!empty($_POST)) {
     try {
        $userName = Input::getString('username');
    } catch (Exception $e) {
        $errors['username'] = $e->getMessage();
    }
    try {
        $firstName = Input::getString('firstname');
    } catch (Exception $e) {
        $errors['firstname'] = $e->getMessage();
    }
    try {
        $lastName = Input::getString('lastname');
    } catch (Exception $e) {
        $errors['lastname'] = $e->getMessage();
    }
    try {
        $password = Input::getString('password');
    } catch (Exception $e) {
        $errors['password'] = $e->getMessage();
    }
    try {
        $confirmPassword = Input::getString('confirm_password');
    } catch (Exception $e) {
        $errors['confirm_password'] = $e->getMessage();
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
        $gender = Input::get('gender');
    } catch (Exception $e) {
        $errors['gender'] = $e->getMessage();
    }
    var_dump($errors);
    $user = new User;
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
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->hash = hash('sha256',$confirmPassword);
        $user->email = $email;
        $user->birth_date = $formattedDate;
        $user->gender = $gender;
        $user->save();
        header("Location: /users.edit.php");
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
    <script src='http://code.jquery.com/jquery-2.1.1.min.js'></script>
    <script src='jquery.validate.js'></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="center-block">
                <form action="#" method="post" id ="signup" class="form" role="form">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <label class='sign_up' name='register'>Register</label>
                            <input class="form-control" id='<?= empty($errors['username'])? 'username' : $findError ?>' name="username" 
                            placeholder='<?= empty($errors['username']) ? "Enter your username": "Error: " . $errors['username']?>' type="text" 
                            value='<?= isset($_POST['username']) && empty($errors['username'])? $_POST['username']: ''?>'
                                required autofocus><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <input class="form-control" id='firstname' name="firstname" placeholder="First Name" type="text" 
                            value='<?= isset($_POST['firstname']) && empty($errors['firstname'])? $_POST['firstname']: ''?>'
                                required autofocus><br>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <input class="form-control" id='lastname' name="lastname" placeholder="Last Name" type="text" 
                            value='<?= isset($_POST['lastname']) && empty($errors['lastname'])? $_POST['lastname']: ''?>'><br>
                        </div>
                    </div>
                    <input class="form-control" id='<?= empty($errors['email'])? 'email' : $findError ?>' name="email" 
                    placeholder='<?= empty($errors['email']) ? "Enter your Email": "Error: " . $errors['email']?>' type="email" 
                    value='<?= isset($_POST['email']) && empty($errors['email'])? $_POST['email']: ''?>'><br>

                    <input class="form-control" id ='password' name="password" placeholder="New Password" type="password" 
                    value='<?= isset($_POST['password']) && empty($errors['password'])? $_POST['password']: ''?>'><br>

                    <input class="form-control" id='confirm_password' name="confirm_password" placeholder="Re-enter Password" type="password"><br>
                    <input class="form-control" id='<?= empty($errors['birth_date'])? 'birth_date' : $findError ?>'name="birth_date" 
                    placeholder='<?= empty($errors['birth_date']) ? "Enter birth date": "Error: " . $errors['birth_date']?>'type="text" 
                    value='<?= isset($_POST['birth_date']) && empty($errors['birth_date'])? $_POST['birth_date']: ''?>'>

                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineCheckbox1" value="male">
                        Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineCheckbox2" value="female">
                        Female
                    </label>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                </form>
            </div>
        </div>
    </div>
 <script>
$(document).ready(function() {
    $.validator.setDefaults({
        submitHandler: function() {
            form.submit();
        }
    });

    $("#signup").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            firstname: "Please enter your first name",
            lastname: "Please enter your last name",
            password: {
                required: "Please enter a password",
                minlength: "Password must be atleast 5 letters"
            },
            confirm_password: {
                required: "Please confirm password",
                minlength: "Password must be atleast 5 letters",
                equalTo: "Must be equal to password"
            },
            email: {
                required: "Please enter a email",
                email: "Your email address must be in the format of name@domain.com"
            },
        }
    });
});


</script>
</body>
