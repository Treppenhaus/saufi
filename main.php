<?php

session_start();
include_once "Db.php";
$db = new Db("127.0.0.1", "root", "", "saufi");
$db2 = new Db("127.0.0.1", "root", "", "saufi");

function isLoggedIn() {
    return isseT($_SESSION["nickname"]);
}

function icon() {
    $urls = array(
        "https://em-content.zobj.net/source/microsoft/74/tropical-drink_1f379.png",
        "https://cdn3.emoji.gg/default/microsoft/wine-glass.png",
        "https://em-content.zobj.net/thumbs/160/microsoft/74/beer-mug_1f37a.png",
        "https://em-content.zobj.net/thumbs/160/microsoft/74/clinking-beer-mugs_1f37b.png"
    );
    $url = $urls[rand(0,count($urls)-1)];
    echo '<link rel="icon" type="image/png" href="'.$url.'" />';
}

function sendhome($reason) {
    header("location:../home?msg=$reason");
    exit();
}
?>