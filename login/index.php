<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <title>saufi</title>
        <script type="text/javascript" src="dares.js"></script>
        <link rel="stylesheet" href="../colors.css">
        <link rel="stylesheet" href="../default.css">
        <link rel="stylesheet" href="login.css">
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
                <form action="login.php" method="post" class="form">
                    <h1 class="form-title">Log in</h1>
                    <?php
                    if(isset($_GET["msg"])) {
                        echo "<p class='error-message'>" . htmlspecialchars($_GET['msg']) . "</p><br/>";
                    }?>
                    <input type="text" name="nickname" placeholder="nickname" id="nickname"><br>
                    <input type="password" name="password" id="password" placeholder="password"><br>
                    <input type="submit" value="log in">
                </form>
            </div>
            <p class="footnote"><a href="../register" class="already-registered">Register</a> | <a href="../" class="already-registered">Home</a> | <a href="../support" class="already-registered">Support Me</a> | <a href="../privacy" class="already-registered">Privacy</a></p>
    
        </div>
    </body>
</html>