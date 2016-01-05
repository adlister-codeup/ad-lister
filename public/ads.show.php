<?php
    session_start();
    require_once "../models/AdTable.php";
    if (isset($_GET["ad"]))
    {
        $ad = new AdTable();
        $data =  $ad->loadAd($_GET["ad"]);
        if (!isset($data["images"][0]))
        {
            $data["images"][0] = "img/no_image_available.png";
        }
    }
?>
<!DOCTYPE html>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/home.css">
  <title>Krieger's List</title>
  <?php include '../views/partials/navbar.php'; ?>
</head>
<style type="text/css">
.carousel-inner{
  width:100%;
  max-height: 500px !important;
  min-height: 500px;
}
</style>
<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $data["title"] ?>
                        <small>
                            <?php echo $data["location"] ?>
                            <a href="users.show.php"><?php echo $data["owner"] ?></a>
                        </small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php foreach ($data["images"] as $key => $value) { ?>
                                <?php if ($key == 0) { ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                               <?php }
                                else
                                { ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                               <?php }
                            } ?>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php foreach ($data["images"] as $key => $value) {
                                if ($key == 0 )
                                { ?>
                                    <div class="item active">
                                        <a href="http://adlister.dev/<?php echo $value ?>" target="_blank"> <img src ="http://adlister.dev/<?php echo $value ?>" alt=""></a>
                                        <div class="carousel-caption"></div>
                                    </div>
                                <?php }
                                else 
                                { ?>
                                    <div class="item">
                                        <a href="http://adlister.dev/<?php echo $value ?>" target="_blank"><img src ="http://adlister.dev/<?php echo $value ?>" alt=""></a>
                                        <div class="carousel-caption"></div>
                                    </div>
                               <?php } 
                            } ?>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>$<?php echo $data["price"] ?></h3>
                    <small><a href="ads.edit.php?ad=<?php echo $data["id"]?>">Edit your listing</a></small>
                    <hr>
                    <h3>Contact email: <p><?php echo $data["email"] ?></p></h3>
                    <hr>
                    <?php if ($data["phone"] != "") { ?>
                        <h3>Contact Phone: <p><?php echo $data["phone"] ?></p></h3>
                    <?php } ?>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3><div class="descriptions"><?php echo $data["description"] ?></div></h3>
                    </div>
                </div>
            </div>
                <hr>
        </div>
        <?php include '../views/partials/footer.php'; ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>