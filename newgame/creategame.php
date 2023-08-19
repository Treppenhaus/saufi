<?php 
include_once "../main.php";
/** create new game
 *  - get amount of players and settings
 *  - create game in database and generate admin key
 *  - give link to gameid and admin key to owner
 *  - other players can VIEW (not join) the game using a link containing the game-id


* creategame.php?settings=player1;player2;player3:1
* ^url                        ^players            ^settings (repeat=1)

 */

if(!isset($_GET["settings"])) {
    echo "error";
    exit();
}

$data = $_GET["settings"];
$data = explode(":", $data);
$players = explode(";", $data[0]);
$repeating = $data[1] == "1";

// all data has been gathered
// now create gameid
function createGameID() {
    $letters = "abcdefgkmnpqrstuvwxyz23456789";
    $id = "1-";
    for($i = 0; $i < 5; $i++) $id = $id . $letters[rand(0,strlen($letters)-1)];
    if(gameIDTaken($id)) return createGameID();
    return $id;
}

function gameIDTaken($id) {
    // todo: check in database if gameid is already taken
    return false;
}

$gameid = createGameID();



// create admin password / code
function createAdminCode() {
    $letters = "0123456789abcdef";
    $pw = "";
    for($i = 0; $i < 8; $i++) $pw = $pw . $letters[rand(0,strlen($letters)-1)];
    return $pw;
}

$admincode = createAdminCode();
$timestamp = time();
$multiplicator = 1.0;
$nsfw = false;

// this is all information we theoretically got at this point
/*
echo "players: " . implode(", ", $players) . "<br/>";
echo "repeating: " . $repeating . "<br/>";
echo "gameid: $gameid<br/>";
echo "admin: $admincode<br/>";
echo "logged in: ".isLoggedIn()."<br/>";
if(isLoggedIn()) {
    echo "creator: ". $_SESSION['nickname'] ."<br/>";
}
echo "timestamp: $timestamp<br/>";
echo "multiplicator: $multiplicator<br/>";
*/

// but the client only needs the created gameid and adminpassword, so we only give that
echo "$gameid;$admincode";

// still, we need to create the database entry
// https://i.outtave.de/EcKphZVq5U.png?key=gFasenuAo3BFga

$repeating = $repeating ? "true" : "false";
$nsfw = $nsfw ? "true" : "false";

$q = "";
if(isLoggedIn()) {
    $q = "INSERT INTO games(gameid, admincode, repeating, nsfw, multiplicator, created, latest_activity, creator)
    VALUES ('$gameid', '$admincode', $repeating, $nsfw, $multiplicator, $timestamp, $timestamp, ".$_SESSION["id"] . ")";
}
else {
    $q = "INSERT INTO games(gameid, admincode, repeating, nsfw, multiplicator, created, latest_activity)
    VALUES ('$gameid', '$admincode', $repeating, $nsfw, $multiplicator, $timestamp, $timestamp)";
}
$db -> query($q);
echo ";game_ok";

// also, we need to add the players so we can get them later and calculate possible dares
// the challenge to player conversion should also be done server-side so its easier to display the same for every player.

foreach($players as $playername) {
    $q = "INSERT INTO players(nickname, gameid) VALUES ('$playername', '$gameid')";
    $db -> query($q);
    echo ";$playername";
}

// everything is done, the game was created and saved to the database
// the database can now be accessed.
?>