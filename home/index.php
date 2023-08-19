<?php include_once "../main.php";?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <script type="text/javascript" src="dares.js"></script>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="home.css">
        <?php icon()?>
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
                <a class="button highlighted" href="../newgame"><div><p>Spielen</p></div></a><br/>

                <?php 
                    if(isLoggedIn()) {
                        echo '<a class="button" hreF="../account"><div><p>Einstellungen / Account</p></div></a><br/>';
                    }
                    else {
                        echo '<a class="button" href="../login"><div><p>Einloggen</p></div></a><br/>
                        <a class="button" hreF="../register"><div><p>Registrieren</p></div></a><br/>
                        <a class="button gray" hreF="./"><div><p>Einstellungen (benötigt Account)</p></div></a>';
                    }
                ?>
            </div>
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>