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
        <button type="button" class="btn"><li><a href="../ads.create.php">Post Your Ad</a></li></button>
          <?php if (isset($_SESSION["user"])) {?>
          <button type="button" class="btn"><a href="../auth.logout.php">Logout</a></button>
        <?php } else { ?>
          <button type="button" class="btn"><li><a href="../auth.login.php">Login</a></li></button>
        <?php } ?>
        <button type="button" class="largebtn"><li><a href="index.php">Krieger's List</a></li></button>
      </ul>
      <div>Welcome: <?= $user ?></div>
    </div>
  </div>
</nav>
<script src="js/buttons.js"></script>
