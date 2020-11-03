<?php
session_start();
if(!isset($_SESSION["session"])){
    if (!isset($_POST["login_test"]) || (!isset($_POST["password_test"])))  {
        include_once 'header.php';
        include("../public/page/index.html");
        show_windov();
    }
    else
    {
        if(($_POST["login_test"] !== "user") || ($_POST["password_test"] !== "qwerty")) 
        {
            include_once 'header.php';
            include("../public/page/index.html");
            show_windov();
            exit;
        }
        else{
            authorized();
        }
    }
}
else{
    authorized();
}
function authorized(){
    if(!isset($_SESSION["session"]))
    {
        $_SESSION["session"]=date("H-i-s");
    }
    
    include_once 'header.php';
    include("../public/page/index.html");
    // echo "Сессия №",var_dump($_SESSION["session"]);
    
    echo "
    <div class=\"center_content\">
        <p>Ваша личная ссылка:</p>
        <a href=\"./remote_text.php\">http://kappa.cs.petrsu.ru/~kulakov/courses/php/fortune.php</a><br>
        <form action=\"./death.php\"><input type=\"submit\" value=\"Деавторизироваться\"></form></div>";
}
function show_windov()
{
    include("../public/page/login.html");
}
?>