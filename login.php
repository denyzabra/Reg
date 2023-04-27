<!--
<!--?php
$title = "Login";

include('model/model_login.php'); // load and/or process DB data for Add/Edit Staff page
include('header.php'); // load DOCTYPE, <HEAD> content and opening <BODY> tag

?>
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_2.jpg');"></div>
    
    <div class="contents order-2 order-md-1">
      <div class="container">
        <div class="row align-items-top justify-content-center">
          <div class="col-md-7 py-5">
            
            <!-?php if (isset($email_error) ) { ?><p style="background-color:red;color:white;font-weight:bold">Email address not found in database, please try again.</p><!--?php }
             elseif (isset($login_failed) ) { ?><p style="background-color:red;color:white;font-weight:bold">Login failed, please try again.</p><!--?php } ?>
            

            <form action="login.php" method="post">
        
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <h3>Login</h3>
            <p class="mb-4">Please enter your email address and password to login.</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="e.g. john@your-domain.com" id="email" name="email" value="<!--?php if(!empty($login['email'])) echo $login['email'] ?> ">
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" value="<!--?php if(!empty($login['password'])) echo $login['password'] ?>">
                  </div>
                </div>
              </div>

              <input type="submit" value="Login" name="submit" class="btn px-5 btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
      
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 p-0">
          <div class="bg-image" style="background-image: url('images/bg_2.jpg');"></div>
        </div>
        <div class="col-md-6 p-0">
          <div class="login-form">
            <?php if (isset($email_error) ) { ?><p class="error">Email address not found in database, please try again.</p><?php }
             elseif (isset($login_failed) ) { ?><p class="error">Login failed, please try again.</p><?php } ?>

            <h1>Login</h1>
            <p class="lead">Please enter your email address and password to login.</p>
            <form action="login.php" method="post">
              <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" placeholder="e.g. john@your-domain.com" id="email" name="email" value="<?php if(!empty($login['email'])) echo $login['email'] ?>">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" value="<?php if(!empty($login['password'])) echo $login['password'] ?>">
              </div>
              <input type="submit" value="Login" name="submit" class="btn btn-primary btn-block">
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>

