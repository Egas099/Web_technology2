<?php
session_start();
if(!isset($_SESSION["session"])){
    header("Location: ./login.php");
    exit();
}
include("../public/page/index.html");
include_once 'header.php';


$xml = simplexml_load_file('http://kappa.cs.petrsu.ru/~kulakov/courses/php/fortune.php');

echo "<div class=\"center_content\">", $xml->body->p->pre, "</div><br>";

?>