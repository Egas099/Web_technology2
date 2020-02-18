<?php
include_once 'header.php';
include_once '..\public\page\mail_SMTP_kappa.html';
if ( isset ($_POST['send_mail']) )
    sending_mail();

function sending_mail()
{
    
    $to = $_POST['sending_to'];
    $subject = $_POST['sending_subject'];
    $message = wordwrap($_POST['sending_message'], 70, "\r\n");
    $headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: dmitriev@cs.karelia.ru' . "\r\n"; 

    if(mail($to, $subject, $message, $headers))
    {
        alert("Ваше письмо отправленно.");
    }
    else
        alert("Неудалось отправить ваше письмо!");   
}
function alert($mess){
    echo "<script>alert(\"$mess\");</script>";
}
?>