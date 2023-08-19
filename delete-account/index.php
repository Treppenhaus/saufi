<?php  include_once "../main.php";

if(!isLoggedIn()) {
    sendhome("you need to be logged in.");
}




?>
<div class="info">
    <a href="../account">GO BACK</a>
    <p>account name: "<?php echo $_SESSION["nickname"]?>"</p>
    <p>after deleteion, your account can not be restored. all games you created will also be deleted instantly.</p>
    <p>to finally delete your account, enter your password and press the "delete" button.</p>
    <br>
    <form action="delete.php" method="post" class="form">
        <?php if(isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo "<p class='error'>$msg</p>";
        }
        ?>
        <input type="password" placeholder="password" name="password">
        <input type="submit" value="DELETE">
    </form>
    <br>
    <br>
    <a href="../account">GO BACK</a>
</div>

<style>
.info * {
    font-size: 5vh;
}
.error {
    color: reD;
}
</style>