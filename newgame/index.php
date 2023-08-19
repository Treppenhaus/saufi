<?php include_once "../main.php";?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="newgame.css">
        <?php icon()?>
        <script>
            let players = [];
            let repeating = false;

            add = () => {
                let input = document.getElementById("playernamex");
                let name = input.value;
                input.value = "";
                if(name.length > 0 && !players.includes(name)) {
                    addplayer(name);
                }
                console.log(players);
            }

            addplayer = (playername) => {
                const container = document.createElement("div");
                const pname = document.createElement("p");
                pname.appendChild(document.createTextNode(playername));
                const button = document.createElement("button");
                button.appendChild(document.createTextNode("-"));

                button.setAttribute("onclick", "delplayer('"+playername+"')");
                container.setAttribute("id", playername);
                pname.classList.add("name");
                container.classList.add("player");
                button.classList.add("remove-player");

                container.appendChild(pname);
                container.appendChild(button);
                
                document.getElementById("players").appendChild(container);
                players.push(playername);
            }

            delplayer = (playername) => {
                const container = document.getElementById(playername);
                container.remove();
                players.splice(players.indexOf(playername), 1);
            }

            startgame = () => {

                if(players.length < 2) {
                    alert("Du benötigst mindestens 2 Spieler!");
                    return;
                }
                repeating = document.getElementById("repeating-box").checked;
                console.log({settings: {repeating: repeating}});

                // now create game in database:
                let strplayers = "";
                for(let i = 0; i < players.length; i++) {
                    strplayers += players[i];
                    if(i < players.length - 1) {
                        strplayers += ";"
                    }
                } 
    
                let requrl = "./creategame.php?settings="+strplayers+":"+ (repeating ? "1" : "0");

                if(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
                else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                xmlhttp.onreadystatechange = () => {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                        let res = xmlhttp.responseText;
                        // on response
                        if(!res.includes("game_ok")) {
                            alert("something went wrong while creating the game, please try again. ):");
                            return;
                        }

                        res = res.split(";");
                        let gameid = res[0];
                        let adminpw = res[1];
                        newurl = "../game?gid="+gameid+"&a="+adminpw;
                        window.location.replace(newurl);
                    }
                }
                xmlhttp.open("GET", requrl, false);
                xmlhttp.send();
            }

        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="head">
                <a href="https://saufi.giveme.pizza/" class="link">saufi.giveme.pizza</a>
                <p class="title">Saufi<?php 
                $drinks = array("🍷", "🍾", "🍸", "🍹", "🍺", "🍻", "🥂", "🥃", "🥤");
                echo $drinks[rand(0,count($drinks)-1)];
            ?></p>
            </div>

            <div class="field">
                <div class="management">
                    <h3>Spieler hinzufügen</h3>
                    <input class="addp" type="username" id="playernamex" placeholder="Spielername">
                    <button class="addp" onclick="add()">Hinzufügen</button>
                    <br>
                    <div class="checkboxes">
                        <input type="checkbox" name="Wiederholungen" id="repeating-box" checked=checked>
                        <p class="checkbox-text">Wiederholungen</p>
                    </div>
                </div>
                <div class="players" id="players">
                    <h1>Spieler:</h1>
                    <!--<div class="player">
                        <p class="name">Spielername</p>
                        <button class="remove-player">-</button>
                    </div>-->
                </div>
                <div class="start-area">
                    <button onclick="startgame()" class="start-button">Spiel starten!</button>
                </div>
            </div>
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>