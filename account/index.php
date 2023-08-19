<?php  include_once "../main.php";

if(!isLoggedIn()) {
    sendhome("you need to be logged in.");
}

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="account.css">
        <?php icon()?>
    </head>
    <body>
        <div class="wrapper">
            <div class="head">
                <a href="https://saufi.giveme.pizza/" class="link">saufi.giveme.pizza</a>
                <p class="title"><?php echo $_SESSION["nickname"] . "💕";?></p>
            </div>

            <div class="field">
                <br/>
                <h3>Accountinfos</h3>
                <br/>
                <div class="account-infos">
                    <p>Registriert seit:</p>
                    <p><?php echo date('d.m.Y H:i:s', $_SESSION["registered"]);?></p>
                    <p>Berechtigungsstufe:</p>
                    <p>
                    <?php 
                    
                    $perm = $_SESSION["permission"];
                    
                    $text = "Du bist ein toller Mensch :)";
                    if($perm == 1) {
                        $text = "Du bist ziemlich cool und ich kenne dich, deswegen ist dein Name bunt animiert [im gegensatz zu normalen usern pff]";
                    }
                    else if($perm == 2) {
                        $text = "Du kannst die fragen/dares bearbeiten und bist so eine art Admin. Dein Name ist rot animiert.";
                    }
                    else if($perm == 3) {
                        $text = "insane";
                    }

                    echo "$perm";
                    ?></p>
                    <p> ↪ Bedeutung:</p>
                    <p><?php echo $text;?></p>
                    <hr>
                    <hr>
                    <p></p>
                    <a href="../delete-account" class="delete-account">account löschen</a>
                    <p></p>
                    <a href="../logout">ausloggen</a>
                </div>

                <div class="games">
                    <h3>Spiele</h3>
                    <br/>
                    <div class="game-container">
                        <?php
                        $userid = $_SESSION["id"];
                        $res = $db -> query("SELECT * FROM games WHERE creator = $userid order by created desc");
                        if($res -> num_rows > 0) {
                            while($row = $res->fetch_assoc()) {
                                $date = date('d.m.Y H:i:s', $row["created"]);
                                $gameid = $row["gameid"];
                                $players = "";

                                $res2 = $db -> query("SELECT nickname FROM players WHERE gameid = '$gameid'");
                                if($res2 -> num_rows > 0) {
                                    while($rowx = $res2->fetch_assoc()) {
                                        $players = $players . $rowx["nickname"] . " ";
                                    }
                                }
                                echo "<p>$date</p>
                                <p>$players</p>
                                <a class='history' href='../history?gid=$gameid'>verlauf</a>";
                            }
                        }
                        ?>
                    
                    </div>
                </div>
                
            </div>
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>