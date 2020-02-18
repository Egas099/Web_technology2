<?php
// Проверяем, был ли уже установлен Cookie 'Total_visits',
// Если да, то читаем его значение,
// И увеличиваем значение счетчика обращений к странице:
if (isset($_COOKIE['Total_visits'])) 
    $cnt=$_COOKIE['Total_visits']+1;
else 
    $cnt=0;
// Устанавливаем Cookie 'Total_visits' зо значением счетчика
setcookie("Total_visits",$cnt,0);

include_once 'header.php';
include("../public/page/index.html");

// Выводим значение счётчика (количество посещений) или "Добро пожаловать!" если значение счётчика равно нулю
if($cnt)
    alert("Вы посетили эту страницу <b>$cnt</b> раз");
else 
    alert("Добро пожаловать!");
    
function alert($message){
    echo "<p class=\"center_content\" style=\"text-align: center;border: 4px double black; \">$message</p>";
}
?>