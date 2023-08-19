<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <script type="text/javascript" src="dares.js"></script>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="register.css">
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
                <form action="register.php" method="post" class="form">
                    <h1 class="form-title">Account erstellen</h1>
                    <?php
                    if(isset($_GET["msg"])) {
                        echo "<p class='error-message'>" . htmlspecialchars($_GET['msg']) . "</p><br/>";
                    }?>
                    <input type="text" name="nickname" placeholder="nickname" id="nickname"><br>
                    <input type="email" name="email" placeholder="e-mail (not required)" id="email"><br>
                    <input type="password" name="password" id="password" placeholder="password"><br>
                    <input type="submit" value="register">
                </form>
            </div>
            <p class="footnote"><a href="../login" class="already-registered">Log in</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>