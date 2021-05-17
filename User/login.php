<?php
session_start();
// include database and object files
include_once '../conf/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->login = isset($_GET['ulog']) ? $_GET['ulog'] : die();
$user->password = isset($_GET['upass']) ? $_GET['upass'] : die();
// read the details of user to be edited
$stmt = $user->login();
if($stmt->num_rows > 0){
    // get retrieved row
    $row = $stmt->fetch_assoc();
    if($row['idRole'] == 2){
      $_SESSION['role'] = "admin";
    }
    $_SESSION["user_login"] = $row['login'];
    $_SESSION['logged'] = true;

  //  create array
    $user_arr=array(
        'status' => true,
        'message' => "Successfully Login!",
        'id' => $row['idUser'],
        'login' => $row['login']
    );
}
else{
    $user_arr=array(
        'status' => false,
        'message' => 'Login or password is not correct!',
    );
}
// make it json format
echo json_encode($user_arr);
?>
