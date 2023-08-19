<?php  include_once "../main.php";

// check for game id if valid
if(!isset($_GET["gid"])) sendhome("invalid game id");
$gameid = $_GET["gid"];
$res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid'");
if($res -> num_rows == 0) sendhome("game does not exist");

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="history.css">
        <?php icon()?>
    </head>
    <body>
        <div class="wrapper">
            <div class="head">
                <a href="https://saufi.giveme.pizza/" class="link">saufi.giveme.pizza</a>
                <p class="title">Verlauf<?php 
                $drinks = array("🍷", "🍾", "🍸", "🍹", "🍺", "🍻", "🥂", "🥃", "🥤");
                echo $drinks[rand(0,count($drinks)-1)];
            ?></p>
            </div>

            <div class="field">
                <br/>
                <h3>Spielinfos</h3>
                <br/>
                <div class="game-infos">

                    <?php 

                    $created = 0;
                    $activity = 0;
                    $nsfw = "";
                    $repeating = "";
                    $multiplicator = 0;

                    $res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid'");
                    if($res -> num_rows > 0) {
                        while($row = $res->fetch_assoc()) {
                            $repeating = $row["repeating"];
                            $multiplicator = $row["multiplicator"];
                            $nsfw = $row["nsfw"];
                            $created = $row["created"];
                            $activity = $row["latest_activity"];
                        }
                    }

                    $players = "";
                    $res = $db -> query("SELECT * FROM players WHERE gameid = '$gameid'");
                    if($res -> num_rows > 0) {
                        while($row = $res->fetch_assoc()) {
                            $players = $players . $row["nickname"] . ", ";
                        }
                    }
                    $players = substr_replace($players, "", -1); // not working (?)
                    ?>

                    <p>Erstellt am:</p>
                    <p><?php echo date('d.m.Y H:i:s', $created);?></p>

                    <p>Letzte Aktivität:</p>
                    <p><?php echo date('d.m.Y H:i:s', $activity);?></p>

                    <p>Mitspieler:</p>
                    <p><?php echo $players;?></p>

                    <p>Multiplikator:</p>
                    <p><?php echo $multiplicator;?></p>
                
                    <p>Wiederholungen:</p>
                    <p><?php echo $repeating ? "ja" : "nein";?></p>
                    
                    <p>nsfw:</p>
                    <p><?php echo $nsfw ? "ja" : "nein";?></p>
                    
                    <p>Game-ID:</p>
                    <p><?php echo $gameid;?></p>
                </div>
                <br/>
                <hr>
                <br/>
                <h3>Spielverlauf</h3>
                <br/>
                <div class="history">
                    <?php
                    $res = $db -> query("SELECT * FROM history WHERE gameid = '$gameid' ORDER BY timestamp DESC;");
                    if($res -> num_rows > 0) {
                        while($row = $res->fetch_assoc()) {
                            $dare = $row["dare"];
                            $timestamp = date('H:i:s', $row["timestamp"]);
                            echo "
                            <p>$timestamp</p>
                            <p>$dare</p>";
                        }
                    }
                    ?>
                </div>
            </div>
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>