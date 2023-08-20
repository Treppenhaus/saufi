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
            let slidervalue = 1;

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
                let requrl = "./creategame.php?settings="+strplayers+":"+ (repeating ? "1" : "0")+":"+slidervalue;

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
                    echo $drinks[rand(0,count($drinks)-1)];?>
                </p>
            </div>

            <div class="field">
                <div class="management">
                    <div class="playersettings">
                        <h3>Spieler hinzufügen</h3>
                        <input class="addp" type="username" id="playernamex" placeholder="Spielername">
                        <button class="addp" onclick="add()">Hinzufügen</button>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="gamesettings">
                        <h3>Einstellungen</h3>
                        <div class="checkboxes">
                            <input type="checkbox" name="Wiederholungen" id="repeating-box" checked=checked>
                            <p class="checkbox-text">Wiederholungen</p>
                        </div>
                        <br>
                        <h3>Multiplikator</h3>
                        <p class="note">Wie ehrenlos seid ihr?</p>
                        <input type="range" min="0.2" max="6" value="1.0" class="slider" step="0.5" id="multiplyslider">
                        <p id="sliderrange">x1.0</p>
                        <script>
                            let slider = document.getElementById("multiplyslider");
                            let out = document.getElementById("sliderrange");
                            slider.oninput = () => {
                                if(slider.value == 0.2) {
                                    slidervalue = 0.2;
                                }
                                else {
                                    slidervalue = Math.round((slider.value -0.2) * 10) / 10;
                                }
                                out.innerHTML = "x"+slidervalue;
                                console.log("slidervalue", slidervalue);
                            };

                        </script>
                    </div>
                </div>
                <div class="players" id="players">
                    <h1>Spieler:</h1>
                    <!--<div class="player">
                        <p class="name">Spielername</p>
                        <button class="remove-player">-</button>
                    </div>-->
                </div>
                <br>
                <hr>
                <br>
                <div class="start-area">
                    <button onclick="startgame()" class="start-button">Spiel starten!</button>
                </div>
            </div>
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>