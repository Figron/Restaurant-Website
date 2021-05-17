<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>About Us</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <script src="conf/ajax.js" type="text/javascript"></script>
</head>

<body style="height:1500px; font-family:Ubuntu;">
  <div class="jumbotron text-center" style="margin-bottom:0">
    <div class="container">
      <h1> This is our restaurant </h1>
    </div>
  </div>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <a class="navbar-brand" mr-auto href="Restaurant.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="Dishes.php">View dishes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="About_Us.php">About us</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" style="<?php
        if(isset($_SESSION['logged'])){
          if($_SESSION['logged']==true){
            echo "display:none;";
          }else echo "display:inline;";
        }
         ?>
        ">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">
            <?php if(isset($_SESSION['logged'])){
              if($_SESSION['logged']==false){
              echo "Signup/Login";
            }
            }
          else {
            $_SESSION['logged'] = false;
            echo "Signup/Login";
          }?>
        </a>
        </li>
        <li class="nav-item dropdown" style="<?php
        if(isset($_SESSION['logged'])){
          if($_SESSION['logged']==false){
            echo "display:none;";
          }else echo "display:block;";
        }
        ?>">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Welcome back, <?php echo $_SESSION['user_login'];?></a>

        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">View Profile</a>
          <?php
          if(isset($_SESSION['role'])&&$_SESSION['role'] == 'admin'){
            echo "<a class = 'dropdown-item' href='Orders.php'>View orders</a>";
          }
           ?>
          <a class="dropdown-item" href="/User/logout.php">Sign out</a>
        </div>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="Shopping_Cart.php">Shopping cart</a>
        </li>
      </ul>
    </div>
  </nav>
    <div class="container" style="margin-top:30px">
      <p>Our restaurant is known for our high standarts and we are happy to bring them to WEB!</p>
      <h5>Working time</h5>
      <ul class="list-group">
        <li class = "list-group-item">Monday 09-18</li>
        <li class = "list-group-item">Tuesday 09-18</li>
        <li class = "list-group-item">Wednesday 09-18</li>
        <li class = "list-group-item">Thursday 09-18</li>
        <li class = "list-group-item">Friday 09-18</li>
        <li class = "list-group-item">On Saturday to Sunday we work until the last customer.</li>
      </ul>
    </div>
    <!-- Signup/Login modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <ul class="nav nav-tabs nav-fill" style="width:100%">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#login_tab">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#signup_tab">Sign up</a>
              </li>
            </ul>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="tab-content">
              <div class="tab-pane container active" id="login_tab">
                <form class="needs-validation" novalidate method="get"  id="login_form">
                  <!-- onsubmit="sendAjaxForm('result_response','login_form','/User/login.php')" -->
                  <div class="form-group" id="login_response">
                  </div>
                  <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" class="form-control" id="ulog" placeholder="Enter username" name="ulog" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback">Please fill in this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="upass" placeholder="Enter password" name="upass" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <button type="button" onclick="sendAjaxLogin('result_response','login_form','/User/login.php')"class="btn btn-primary" id="submit_login">Submit</button>
                  <!-- <div class="form-group">

                  </div> -->
              </div>
              </form>
              <div class="tab-pane container fade" id="signup_tab">
                <form class="needs-validation" novalidate method="post" id="signup_form">
                  <div class="form-group" id="signup_response">
                  </div>
                  <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" class="form-control" id="uslog" placeholder="Enter username" name="ulog" required>
                    <div class="valid-feedback">Valid</div>
                    <div class="invalid-feedback">Please fill in this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="uspass" placeholder="Enter password" name="upass" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" id=usphone placeholder="Enter phone" name="uphone" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                  </div>
                  <div class="form-group form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="remember" required> I agree on collecting my personal data.
                      <div class="valid-feedback">Valid.</div>
                      <div class="invalid-feedback">Check this checkbox to continue.</div>
                    </label>
                  </div>
                  <button type="button" onclick="sendAjaxSignup('signup_response','signup_form','/User/signup.php')" class="btn btn-primary" id="submit_login">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
