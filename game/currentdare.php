<?php

include_once "../main.php";

if(!isset($_GET["gid"])) echo "missing game ids";
$gameid = $_GET["gid"];

$q = "SELECT dare, timestamp FROM history WHERE gameid = '$gameid' ORDER BY timestamp DESC LIMIT 1";
$res = $db -> query($q);

if($res -> num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        $dare = $row["dare"];
        $timestamp = $row["timestamp"];
        echo "$dare;;;$timestamp";
    }
}
else echo "invalid game id";
?>