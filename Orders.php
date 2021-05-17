<?php
session_start();

	if(isset($_POST['change_status']))
	{
		$status = $_POST['status_select'];
    $order = $_POST['id_order'];

    include_once 'conf/database.php';

    $db_handle = new Database();
    $conn = $db_handle->getConnection();
    $query = "UPDATE orders SET idStatus=(SELECT idStatus FROM status WHERE Name='$status') WHERE idOrders=$order";
    $stmt = $db_handle->conn->query($query);
	}

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Orders</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="conf/ajax.js" type="text/javascript"></script>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
</head>

<body style="height:1500px; font-family:Ubuntu;">
  <div class="jumbotron text-center" style="margin-bottom:0">
    <div class="container">
      <h1>Order management</h1>
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
    <h3>All orders are listed here!</h3>

    <div class="container">
      <?php
      include_once 'conf/database.php';

      $db_handle = new Database();
      $conn = $db_handle->getConnection();

      $total_quantity = 0;
      $total_price = 0;
      //Display user info

      //get all orders
      $query = "SELECT * FROM orders ORDER BY idOrders ASC";
      $stmt = $db_handle->conn->query($query);
      //Info from orders
      while($row_order = $stmt->fetch_assoc()){

        echo "<div class='container py-2'>
        <h4>Order № $row_order[idOrders]</h4>";
        $query3 = "SELECT * FROM users WHERE idUser=$row_order[idUser]";
        $stmt3 = $db_handle->conn->query($query3);
        while($row_users = $stmt3->fetch_assoc()){
          echo "<div class='container'>";
          $query4 = "SELECT Name FROM status WHERE idStatus=$row_order[idStatus]";
          $stmt4 = $db_handle->conn->query($query4);
          $temp = $stmt4->fetch_assoc();
          echo "<strong>Status:</strong>
          $temp[Name] </br>
          <strong>Login:</strong>
          $row_users[Login] </br>
          <strong>Phone</strong>
          $row_users[Phone]
          </div>
          ";
        }
        echo "<div class='table-responsive-md'>";

        $query1 = "SELECT * FROM order_has_dish WHERE idOrder = $row_order[idOrders]";
        $stmt1 = $db_handle->conn->query($query1);
        echo "<table class='table table-bordered'
        <tbody>
        <tr>
          <th style='text-align:left;'>Dish</th>
          <th style='text-align:left;'>Code</th>
          <th style='text-align:right;' width='5%'>Quantity</th>
          <th style='text-align:right;' width='10%'>Unit Price</th>
          <th style='text-align:right;' width='10%'>Price</th>
          <!--<th style='text-align:center;' width='5%'>Remove</th> -->
        </tr>";


        //Info from row_has_dish
          while($row_has_dish = $stmt1->fetch_assoc()){

            $query2 = "SELECT Name, Image, Code, Price FROM dishes WHERE idDishes=$row_has_dish[idDishes]";
            $stmt2 = $db_handle->conn->query($query2);
            //Info from dishes
            while($row_dishes = $stmt2->fetch_assoc()){
              echo "<tr>
              <td>
              <img src=$row_dishes[Image] class='mr-3 mt-3 rounded-circle' style='width:144px'>
              $row_dishes[Name]
              </td>
              <td>
              $row_dishes[Code]
              </td>
              <td style='text-align:right;'>
              $row_has_dish[Quantity]
              </td>
              <td style='text-align:right;'>
              $row_dishes[Price] uan
              </td>
              <td style='text-align:right;'>";
              echo $row_has_dish['Quantity']*$row_dishes['Price']. " uan";
              echo "</td>
              </tr>";
              $total_quantity+=$row_has_dish['Quantity'];
              $total_price+=$row_has_dish['Quantity']*$row_dishes['Price'];
            }

          }
          echo "
            <tr>
            <td colspan='2' align='right'>Total</td>
            <td align='right'>$total_quantity</td>
            <td colspan='2' aligh='right'><strong>$total_price uan</strong></td>
            </tr>
          ";
          echo
          "</tbody>
          </table>
          </div>";

        $total_quantity = 0;
        $total_price = 0;

        echo "
        <div class='container'>
        <form action=";
        echo htmlentities($_SERVER['PHP_SELF']);
        echo " method='post'>
        <textarea style='display:none;' name='id_order'>$row_order[idOrders]</textarea>
        Change status:
        <select name='status_select' class='custom-select form-control' style='width:50%'>";
        $query5 = "SELECT Name FROM status";
        $stmt5 = $db_handle->conn->query($query5);
        while($row_status = $stmt5->fetch_assoc()){
          echo "<option value='$row_status[Name]'>$row_status[Name]</option>";
        }

        echo "</select>
          <input type='submit' class='float-right btn btn-info mr-1 form control' name='change_status' id='change_status' value='Change_status'>
        </form>
        </div></div>";
      }


       ?>


    </div>
  </div>

  <!-- The Modal -->
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
  </div>
</body>

</html>
