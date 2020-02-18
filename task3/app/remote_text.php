<?php
session_start();
if(!isset($_SESSION["session"])){
    header("Location: ./login.php");
    exit();
}
echo $_SESSION["session"];
include_once 'header.php';
include("../public/page/index.html");

$xml = simplexml_load_file('http://kappa.cs.petrsu.ru/~kulakov/courses/php/fortune.php');

echo "<div class=\"center_content\">", $xml->body->p->pre, "</div><br>";

?>