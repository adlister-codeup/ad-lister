<?php 
	if(isset($_SESSION["user"]))
	{	
		$user = $_SESSION["user"];
	}
	else 
	{
		$user ="";
	}
?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-inner" style="float:right">
        <button id="postbtn" type="button" class="btn"><li>Post Your Ad</li></button>
          <?php if (isset($_SESSION["user"])) {?>
          <button id="logoutbtn" type="button" class="btn">Logout</button>
        <?php } else { ?>
          <button id="loginbtn" type="button" class="btn"><li>Login</li></button>
        <?php } ?>
        <button id="homebtn" type="button" class="largebtn"><li>Krieger's List</li></button>
      </ul>
      <div>Welcome: <?= $user ?></div>
    </div>
  </div>
</nav>
<script src="js/buttons.js"></script>
