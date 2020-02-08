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
  1 => 'echo $a, $fl, $boo, $str;',
  2 => 'echo var_dump($a + $str);',
  3 => 'echo var_dump($a == $str);',
  4 => 'echo var_dump($nol==$pusto), var_dump($nol===$pusto);',
  5 => 'echo $s1, "<br>",  $s2;',
  6 => 'echo $mas[one], $mas[2], $mas[3];',
  7 => 'echo var_dump($mas);',
  8 => 'echo (string)$fl;'  ,
  9 => 'echo implode($mas);'  ,
  10 => '$name = \'a\'; echo ${$name};'  ,
  11 => 'for ($i = 1; $i <= 3; $i++) {
            ${"var".$i} = 0;
        }
        echo $var1, $var2, $var3;'  ,
  12 => '$ref = &$a;
        $ref = 10;
        echo $a;'  ,
  13 => 'echo HOST;'  ,
  14 => '$str=$HOST;
        echo var_dump($str);
        $str=@$HOST; 
        echo var_dump($str);'  ,
  15 => '$file_list=`ls -a`;
        echo $file_list;'  ,
  16 => '$str = \'stroka\';
        echo $str.$nol + 1, "<br>";
        echo gettype($str).$nol . 1;' ,
  17 => '$mas_add = array( 
        "dog" => \'gav\',
        "cat"   => \'meow\',
        "V" => 2.24,
        12.02 => "day");
        echo var_dump($mas_add+$mas);'  ,
);

// Отрисовка таблицы
echo '<table border="1" cellspacing="5" cellpadding="7" style="font-size:120%; padding:5%; background:#F5F5DC">';
  echo '<tr>
      <td width="3%" style="background:#D2B48C">№</td>
      <td width="50%" style="background:#D2B48C">Решение</td>
      <td width="30%" style="background:#D2B48C">Результат</td>
  </tr>';
  foreach($ansver as $key => $value){
    echo '<tr>';
      echo "<td>$key</td>";
      echo "<td>$value</td>";
      echo '<td>';eval($value);echo '</td>';
    echo'<tr>';
  }
  echo '</table>';

?>