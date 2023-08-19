<?php
include_once "../main.php";


if(!isset($_GET["gid"])) echo "missing game ids";
$gameid = $_GET["gid"];
$res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid'");
if($res -> num_rows == 0) echo "game does not exist";

$admin = false;
if(isset($_GET["a"])) {
    $amdmincode = $_GET["a"];
    $res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid' AND admincode = '$amdmincode'");
    $admin = $res -> num_rows != 0;
}

if(!isset($_GET["dare"])) echo "missing dare";
$dare = $_GET["dare"];
$timestamp = time();

if($admin) {
    $db -> query("INSERT INTO history (dare, timestamp, gameid) VALUES ('$dare', $timestamp, '$gameid')");
    echo "ok";
}
else {
    echo "only the host can skip to the next dare.";
}





?>