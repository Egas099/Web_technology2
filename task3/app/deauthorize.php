<?php
session_start();
// if(!isset($_SESSION["session"])){
unset($_SESSION["session"]);
// }
echo "deauthorize";
echo var_dump($_SESSION["session"]);
// exit;
?>