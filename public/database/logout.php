<?php
// let session start
session_start();
// unset all session
session_destroy();
header("Location:../../index.php");
?>