<?php
  if (file_exists('data/test.xml')) {
    $xml = simplexml_load_file('data/test.xml');
  } else {
    exit('Не удалось открыть файл test.xml.');
  }
  echo '<dl style="padding:1%">';
  foreach($xml->question as $question)
  {
    echo '<dt>',$question['id'],'. ',$question->name, '</dt>';
    foreach($question->answer as $answer)
      echo '<dd>', $question['id'],'.', $answer['id'],' ',$answer, '</dd>';
  }
  echo '</dl>';
?>