<!DOCTYPE html>
<html lang="en">
      <head>
          
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="styles.css">
            <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          
        </head>
        <body>
            <?php
                if(!array_key_exists('id', $_SESSION)) {
                    echo "
                    <div class='wrapper' style='position: fixed; z-index=-10;'>
                       <img src='views/back.jpg' class='img-responsive' alt='Responsive image' style='width: 1440px;'>
                    </div>";
                }
            ?>
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php">CONNECT</a>

                <nav class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="?page=timeline">Your timeline</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="?page=yourtweets">Your tweets</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="?page=publicprofiles">Public profiles</a>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        
                        <?php     
                            if(array_key_exists('id', $_SESSION)) {  
                        ?>
                                <li class="nav-item lead text-primary" id="user"><a href="?page=myprofile"><strong>@<?php echo $_SESSION['username']; ?></strong></a></li>
                                <a class="btn btn-outline-primary my-2 my-sm-0" href="?function=logout">Logout</a>
                        <?php
                            } else {
                        ?>
                            <button class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#myModal">Login/Sign up</button>
                        <?php
                            }    
                        ?>
                    </div>
                </nav>
            </nav>