<?php
include_once "../main.php";

if(!(isset($_POST["nickname"]) && isset($_POST["password"]))) {
    header("location:../login?msg=missing data");
    exit();
}

$nickname = $_POST["nickname"];
$password = $_POST["password"];
$hashed_password = $db -> hash($password);

$res = $db -> query("select * from users where nickname like '" . $nickname ."'");
if($res -> num_rows == 0) {
    header("location:../login?msg=there is no user with that nickname");
    exit();
}

$q = "select * from users where nickname like '" . $nickname ."' and password_hash like '" . $hashed_password . "'";
$res = $db -> query($q);
if($res -> num_rows > 0) {
    // login worked
    $_SESSION["nickname"] = $nickname;

    while($row = $res->fetch_assoc()) {
        $_SESSION["id"] = $row["id"];
        $_SESSION["permission"] = $row["permission"];
        $_SESSION["registered"] = $row["registered"];
    }

    echo "you have been logged in";
    header("location:../home?logged_in");
    exit();
}

header("location:../login?msg=wrong password ");
exit();
?>