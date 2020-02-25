<?php
  $xml = fopen("data/test.xml", "r+");
  $write = fopen("data/write.xml", "r+");

  while(!feof($xml))
  {
    $str = fgets($xml);
    $str  = html_entity_decode ($str , "ENT_HTML401");
    // $str = preg_replace("=<br */? >=i", "/<br/>", $str);
    fwrite($write,$str);
  }
  fclose ($xml);
  fclose ($write);

  $xml = simplexml_load_file('data/write.xml');

  echo '<dl style="padding:1%">';
  foreach($xml->question as $question)
  {
    echo '<dt>',$question['id'],'. ',mb_ucfirst($question->name), '</dt>';
    foreach($question->answer as $answer)
      echo '<dd>', $question['id'],'.', $answer['id'],' ',mb_ucfirst($answer), '</dd>';
  }
  echo '</dl>';

  function mb_ucfirst($str, $encoding='UTF-8')
  {
      $str = mb_ereg_replace('^[\ ]+', '', $str);
      $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
              mb_substr($str, 1, mb_strlen($str), $encoding);
      return $str;
  }
  function br2nl($str) {
    return preg_replace("=<br */? >=i", "", $str);
    }
?>