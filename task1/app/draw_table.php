<?php
/* Описание скалярных переменных */

$a      = 15;        # целое
$fl     = 3.14;         # с плавающей точкой
$boo     = TRUE;         # boolean
$str    = "stroka";     # строка
$nol    = 0;
$pusto    = "";

$s1 = "Переменная a = $a \n";   # разбираемая строка
$s2 = 'Переменная a = $a \n';   # неразбираемая строка

/* Описание массива */

$mas = array( "one" => TRUE,
            1   => -20,
            "three" => 3.14);
$mas[]="two";
$mas["four"]=4;

/* Описание константы */

define("HOST", "kappa.cs.karelia.ru");


/* Вывод значения переменной на экран */
// echo $a, "\n";
$ansver = array( // Массив ответов
1 => 'echo $a, $fl, $boo, $str;',// Выводим переменные
2 => 'echo var_dump($a + $str);',// Выводим сумму переменных(Ошибка т.к. складываем число со строкой)
3 => 'echo var_dump($a == $str);',// Выводим результат сравнения (false т.к. значения не равны)
4 => 'echo var_dump($nol==$pusto), var_dump($nol===$pusto);', // ("==" - сравнение значений)("===" - сравнение значений и типов)
5 => 'echo $s1, "<br>",  $s2;',// Выводим 2 строки разбираемую и не разбираемую (В разбираемой строке php ищет специальные символы)
6 => 'echo $mas[one], $mas[2], $mas[3];', // Выводим элементы массива (2й элемент обьявляется в строчке "$mas[]="two";", а 3й не обьявлен вовсе, поэтому ничего не выведено)
7 => 'echo var_dump($mas);',// Вывод структурированной информации о массиве
8 => 'echo var_dump((string)$fl);'  , // Вывод переменной приведённой к типу строка
9 => 'echo var_dump(implode($mas));'  , // Вывод массива, все элементы которого обьеденены в строку
10 => '$name = \'a\'; echo $$name;',// Выводим значение переменной $a, используя синтаксис "переменные переменных"
11 => 'for ($i = 1; $i <= 3; $i++) {
            ${"var".$i} = 0;
      }
      echo $var1, $var2, $var3;'  ,//Создаём семейство переменных $var1, $var2, $var3 и инициализируем значением 0
12 => '$ref = &$a;
      $ref = 10;
      echo $a;'  ,//Изменяем значение переменной $a, используя "присвоение по ссылке". Выводим $a.
13 => 'echo HOST;'  ,// Вывод константы
14 => '$str=$HOST; 
      echo var_dump($str);
      $str=@$HOST; 
      echo var_dump($str);'  , // Присваиваем переменной значение константы через $ ...
15 => '$file_list=`dir`;
      echo mb_convert_encoding($file_list, "UTF-8", "CP866");'  ,// Исполняем команду "ls" и выводим результат её работы на экран
16 => '$str = \'stroka\';
      echo var_dump($str.$nol + 1), "<br>";
      echo var_dump(gettype($str).$nol . 1);' ,//Вывод результата вычисления выражения "$str.$nol +1"
17 => '$mas_add = array( 
      "dog" => \'gav\',
      "cat"   => \'meow\',
      "V" => 2.24,
      1 => 9999,
      12.02 => "day");
      echo var_dump($mas+$mas_add), "<br>";
      echo var_dump($argc), "<br>";
      echo var_dump($argv), "<br>";'  ,// Создание нового массива и вывод суммы двух массивов      
      );
include_once './public/page/index.html';
// Отрисовка таблицы
echo '<table border="1" cellspacing="5" cellpadding="7" rules="rows">
            <tr id="title">
                  <td width="3%">№</td>
                  <td width="50%">Решение</td>
                  <td width="30%">Результат</td>
            </tr>';
foreach($ansver as $key => $value){
      echo "<tr>
                  <td>$key</td>
                  <td>$value</td>
                  <td>"; echo eval($value); echo '</td>
            <tr>';
}
echo '</table>';
?>