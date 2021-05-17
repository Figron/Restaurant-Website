<?php
session_start();
// get database connection
include_once '../conf/database.php';

// instantiate user object
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
// set user property values
$user->login = $_POST['ulog'];
$user->password = $_POST['upass'];
$user->phone = $_POST['uphone'];

// create the user
if($user->signup()){

    $_SESSION["user_login"] = $user->login;
    $_SESSION['logged'] = true;

    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->login
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
echo json_encode($user_arr);
?>
