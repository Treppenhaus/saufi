<?php
include_once "../main.php";
session_destroy();
header("location:../home?msg=you have been logged out successfully!")

?>