<?php
session_start();
if(!isset($_SESSION["session"])){
    show_windov();
    if (!isset($_SERVER["PHP_AUTH_USER"]) || (!isset($_SERVER["PHP_AUTH_PW"]))) 
    {
        include_once 'header.php';
        include("../public/page/index.html");
        echo '<div class="center_content"><p>Вы не авторизированны!</p>';
        echo '<form"><input onclick=\'window.location.reload()\' type="button" value="Авторизироваться"></form></div>';
    }
    else
    {
        if(($_SERVER["PHP_AUTH_USER"] !== "user") || ($_SERVER["PHP_AUTH_PW"] !== "qwerty")) 
        {
            show_windov();
            exit;
        }
        else{
            authorized();
        }
    }
}
else{
    echo "Сессия №",var_dump($_SESSION["session"]);
    authorized();
}
function authorized(){
    if(!isset($_SESSION["session"]))
    {
        $_SESSION["session"]=date("H-i-s");
    }

    include_once 'header.php';
    include("../public/page/index.html");

    echo "
    <div class=\"center_content\">
        <p>Ваша личная ссылка:</p>
        <a href=\"./remote_text.php\">http://kappa.cs.petrsu.ru/~kulakov/courses/php/fortune.php</a><br>
        <form action=\"./deauthorize.php\"><input type=\"submit\" value=\"Деавторизироваться\"></form></div>
    </div>";
}
function show_windov()
{
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
}

?>