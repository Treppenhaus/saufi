<?php
include_once "../main.php";

if(!isset($_POST["password"])) {
    header("location:../delete-account?msg=missing data");
    exit();
}

$nickname = $_SESSION["nickname"];
$password = $_POST["password"];

$hashed_password = $db -> hash($password);

$res = $db -> query("select * from users where nickname like '" . $nickname ."'");
if($res -> num_rows == 0) {
    header("location:../delete-account?msg=there is no user with that nickname");
    exit();
}

$q = "SELECT * from users where nickname like '" . $nickname ."' and password_hash like '" . $hashed_password . "'";
$res = $db -> query($q);
if($res -> num_rows > 0) {
    // login worked

    $db -> query("DELETE FROM users WHERE nickname = '$nickname'");
    header("location:../register?msg=your account has been deleted from the database. you have been logged out.");
    exit();
}

header("location:../delete-account?msg=wrong password ");
exit();
?>