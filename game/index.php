<?php include_once "../main.php";

// check for game id if valid
if(!isset($_GET["gid"])) sendhome("invalid game id");
$gameid = $_GET["gid"];
$res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid'");
if($res -> num_rows == 0) sendhome("game does not exist");


$admin = false;
if(isset($_GET["a"])) {
    $admincode = $_GET["a"];
    $res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid' AND admincode = '$admincode'");
    $admin = $res -> num_rows != 0;
}


// get players and other game info
$players = array();
$repeating = false;
$multiply = 1;
$nsfw = false;
$dare = "lets go";
$dare_timestamp = 0; // not used


$q = "SELECT dare, timestamp FROM history WHERE gameid = '$gameid' ORDER BY timestamp DESC LIMIT 1";
$res = $db -> query($q);
if($res -> num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        $dare = $row["dare"];
        $dare_timestamp = $row["timestamp"];
    }
}


$res = $db -> query("SELECT * FROM games WHERE gameid = '$gameid'");
if($res -> num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        $repeating = $row["repeating"];
        $multiply = $row["multiplicator"];
        $nsfw = $row["nsfw"];
    }
}

if($admin) {
    // we only need to get the players when the user is the host
    // because only the host should be able to generate a new dare which needs the players
    $res = $db -> query("SELECT nickname FROM players WHERE gameid = '$gameid'");
    if($res -> num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            array_push($players, $row["nickname"]);
        }
    }
}

$qrcodeurl = "https://saufi2.giveme.pizza/game/?gid=$gameid";
//$qrcodeurl = "https://10.0.0.222/saufi/game/?gid=$gameid";

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="game.css">
        <script type="text/javascript" src="../dares.js"></script>
        <?php
        if(!$admin) echo '<meta http-equiv="refresh" content="3">';

        ?>
        <?php icon()?>
        <script>
        
            // get this data from database, it was saved previously and
            // is accessible by gameid
            //--------------------------
            let gameid = "<?php echo $gameid;?>"; 
            let adminpw = "<?php echo $admin ? $admincode : "";?>";
            let players = [<?php foreach($players as $nickname) {
                echo "'$nickname', ";
            }?>];
            let repeating = <?php echo $repeating ? "true" : "false";?>;
            let nsfw = <?php echo $nsfw ? "true" : "false";?>;
            let multiply = "<?php echo $multiply;?>";
            //---------------------------


            let availableDares = [...dares];
            let qr_toggled = false;
            qr = () => {
                qr_toggled = !qr_toggled;
                let element = document.getElementById("qr");
                let btn = document.getElementById("qr-button");
                if(qr_toggled) {
                    element.classList.remove("hidden");
                    btn.classList.add("active-btn");
                }
                else {
                    element.classList.add("hidden");
                    btn.classList.remove("active-btn");
                }
            };

            refreshcurrentdare = () => {
                let reqUrl = "./currentdare.php?gid="+gameid;
                if(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
                else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                xmlhttp.onreadystatechange = () => {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                        let data = xmlhttp.responseText.split(";;;");
                        let newdare = data[0];
                        let timestamp = data[1];
                        //todo: maybe add timestamp as wlel?
                        console.log("new dare: ", {newdare, timestamp});
                        document.getElementById("dare").innerHTML = newdare;
                    }
                }
                xmlhttp.open("GET", reqUrl, false);
                xmlhttp.send();
            }

            randInt = (min, max) => {return Math.floor(Math.random() * (max - min + 1) + min)};

            refreshcounter = (current, max) => {
                if(!repeating) {
                    let newval = current + " / " + max;
                    document.getElementById('counterbox').innerHTML = newval;
                }
            }

            generateDare = () => {
                // todo: get dares from database in the future, make it possible to select like nsfw etc etc

                if(availableDares.length == 0) {
                    return "Es sind keine weiteren Sachen verfügbar. Ihr habt alle "+ dares.length + " Sachen gehabt.";
                }

                let n = randInt(0, availableDares.length - 1);
                let dare = availableDares[n]
                let player = players[randInt(0, players.length - 1)]
                dare = dare.replace('{player}', player);                    
                if(!repeating) {
                    availableDares.splice(n, 1);
                }
                return dare;
            }

            next = () => {
                // generate dare and execute setdare(x);
                let dare = generateDare();
                refreshcounter(dares.length - availableDares.length, dares.length);
                setdare(dare);
                setTimeout(() => refreshcurrentdare(), 50);
                // idk what after im drunk holy shit

            }

            setdare = (dare) => {

                // set dare for current game / change current question
                // NEEDS TO USE ADMIN PASSWORD
                // OTHERWISE ANYONE COULD GO NEXT

                let reqUrl = "./setdare.php?gid="+gameid+"&a="+adminpw+"&dare="+dare;

                if(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
                else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                xmlhttp.onreadystatechange = () => {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                        let res = xmlhttp.responseText;
                        // on response
                        if(res != "ok") {
                            alert("something went wrong while setting next dare. " + res);
                            return;
                        }
                        console.log(res);
                    }
                }
                xmlhttp.open("GET", reqUrl, false);
                xmlhttp.send();
            };
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="head">
                <a href="https://saufi.giveme.pizza/" class="link">saufi.giveme.pizza | <?php echo $admin ? "host" : "viewer" ?></a>
                <p class="title">Saufi<?php 
                $drinks = array("🍷", "🍾", "🍸", "🍹", "🍺", "🍻", "🥂", "🥃", "🥤");
                echo $drinks[rand(0,count($drinks)-1)];
            ?></p>
            </div>

            <div class="field">
                <div class="saufi-view" id="game-view">
                    <div class="saufi">

                        <div class="center-box">
                            <p id="dare"><?php echo "$dare";?></p>
                            <?php if($admin) echo '<button class="next-button" onclick="next()">weiter</button>'?>
                            <p id="counterbox"><?php echo $repeating ? "(wiederholend) " : "💫";?></p>
                            <a href="../history/?gid=<?php echo $gameid;?>">verlauf ansehen</a>
                        </div>

                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&color=000&margin=15&data=<?php echo $qrcodeurl;?>" alt="qr code image" id="qr" class="qr hidden">

                    </div>
                </div>
            </div>
        
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
            <button class="qr-button" id="qr-button"><img src="../qr.png" alt="" onclick="qr()"></button>
        </div>
    </body>
</html>