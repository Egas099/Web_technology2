<?php
include_once 'header.php';
include_once '..\public\page\mail_SMTP_kappa.html';

$config['smtp_username'] = 'dmitriev@cs.karelia.ru';  //Адрес почтового ящика.
$config['smtp_host'] =  'mail.cs.karelia.ru';  //сервер для отправки почты
$config['smtp_from'] = 'dmitriev@cs.karelia.ru'; //От кого

if (isset($_POST['send_mail'])) {
    echo "<div class=\"mess\">";
    sending_mail();
}

function smtpmail($to = '', $mail_to, $subject, $message, $headers = '')
{
    global $config;
    $SEND  = "Date: " . date("Y-m-d H:i") . "\r\n";
    $SEND .= 'Subject: ' . $subject . "\r\n";
    $SEND .= $headers . "\r\n\r\n";
    
    $SEND .=  $message . "\r\n";
    if (!$socket = fsockopen($config['smtp_host'], 25, $errno, $errstr, 30)) {
        echo $errno . "<br>" . $errstr;
        return false;
    }

    if (!server_parse($socket, "220")) return false;

    fputs_socket($socket, "HELO " . $config['smtp_host'] . "\r\n");
    if (!server_parse($socket, "250")) {
        echo '<p>Не могу отправить HELO!</p>';
        fclose($socket);
        return false;
    }
    fputs_socket($socket, "MAIL FROM: " . $config['smtp_username'] . "\r\n");
    if (!server_parse($socket, "250")) {
        echo '<p>Не могу отправить комманду MAIL FROM: </p>';
        fclose($socket);
        return false;
    }
    fputs_socket($socket, "RCPT TO: " . $mail_to . "\r\n");

    if (!server_parse($socket, "250")) {
        echo '<p>Не могу отправить комманду RCPT TO: </p>';
        fclose($socket);
        return false;
    }
    fputs_socket($socket, "DATA\r\n");

    if (!server_parse($socket, "354")) {
        echo '<p>Не могу отправить комманду DATA</p>';
        fclose($socket);
        return false;
    }
    fputs_socket($socket, $SEND . "\r\n.\r\n");

    if (!server_parse($socket, "250")) {
        echo '<p>Не смог отправить тело письма. Письмо не было отправленно!</p>';
        fclose($socket);
        return false;
    }
    fputs_socket($socket, "QUIT\r\n");
    fclose($socket);
    echo "</div>";
    return TRUE;
}

function server_parse($socket, $response)
{
    global $config;
    if (!($server_response = fgets_socket($socket, 256))) {
        echo "<pre style=\"color:red\">Проблемы с отправкой почты!</pre>";
        return false;
    }
    if (!(substr($server_response, 0, 3) == $response)) {
        echo "<pre style=\"color:red\">Проблемы с отправкой почты!</pre>";
        return false;
    }
    return true;
}
function fputs_socket($socket, $data)
{
    fputs($socket, $data);
    echo "<pre style=\"color:blue\">$data</pre>";
}
function fgets_socket($socket, $n)
{
    $resp = fgets($socket, $n);
    echo "<pre style=\"color:green\">$resp</pre>";
    return $resp;
}
function sending_mail()
{
    $to = '';
    $mail_to = $_POST['sending_to'];
    $subject = $_POST['sending_subject'];
    $message = wordwrap($_POST['sending_message'], 70, "\r\n");
    $headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: dmitriev@cs.karelia.ru' . "\r\n";

    if (smtpmail($to, $mail_to, $subject, $message, $headers)) {
        alert("Ваше письмо отправленно.");
    } else
        alert("Неудалось отправить ваше письмо!");
    // mail($mail_to, $subject, $message, $headers);
}
function alert($mess)
{
    echo "<script>alert(\"$mess\");</script>";
}
