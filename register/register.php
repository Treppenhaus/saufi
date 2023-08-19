<?php
include_once "../main.php";
if(!(isset($_POST["nickname"]) && isset($_POST["password"]))) {
    header("location:../register?msg=missing data");
    exit();
}

$nickname = $_POST["nickname"];
$password = $_POST["password"];

$res = $db -> query("select * from users where nickname like '" . $nickname ."'");
if($res -> num_rows > 0) {
    header("location:../register?msg=nickname does already exist (sry)");
    exit();
}

if(strlen($nickname) > 20 || strlen($nickname) < 2) {
    header("location:../register?msg=nickname must be 2-20 characters long");
    exit();
}


if(strlen($password) > 200 || strlen($password) < 4) {
    header("location:../register?msg=password must be 5-200 characters long");
    exit();
}

$allowedCharactersNickname = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_";
foreach(str_split($nickname) as $char) {
    if(!(strpos($allowedCharactersNickname, $char) !== false)) {
        header("location:../register?msg=nickname can only have letters, numbers and underscores ( _ )");
        exit();
    }
}

$now = time();
// finally register user
$hashed_password = $db->hash($password);
if($_POST["email"] != "") {
    $q = "insert into users(nickname, email, password_hash, last_online, registered) values ('$nickname', '" .$_POST["email"] . "', '$hashed_password', $now, $now)";
    $db -> query($q);
}
else {
    $q = "insert into users(nickname, password_hash, last_online, registered) values ('$nickname', '$hashed_password', $now, $now)";
    $db -> query($q);
}

// log in
header("location:../login?msg=your account has been created, log in now pls")

?>