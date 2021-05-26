<?php

// header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/OAuth.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);// Passing `true` enables exceptions
//die(var_dump($mail));
//$mail->SMTPDebug = 2;//При включении возможен конфликт с "done" функцией аякса

//Server settings
$mail->isMail(); // Set mailer to use mail func php, if not smtp - preference use it
//$mail->isSendmail(); // Set mailer to use mail func php
// $mail->isSMTP(); // Set mailer to use SMTP
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->CharSet = 'UTF-8';

//$mail->Host = 'smtp.com';  // Specify main and backup SMTP servers
//$mail->Username = '';                 // SMTP username
//$mail->Password = '';                           // SMTP password

//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = '465';                                    // TCP port to connect to

//Recipients
$mail->setFrom('email', 'company_name');
//$mail->FromName = 'company_name';
$mail->addAddress('email');
//$mail->addAddress('куда отправлять письмо');

//$mail->addReplyTo('contact@email.com', 'Information');  //Обратный адрес, куда должны писать пользователи в ответ на письмо, письмо на этот адрес отправлено не будет
//$mail->addCC('');
//$mail->addBCC('');

//Attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Add attachments Optional name

//custom variant
//if (!empty($_FILES) && $_FILES['file']['error'] == 0) {
//  $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
//}

//default(from of. site) multi file upload. Important, input type="file" name must have [] in name last, like: "userfile[]"
//if (!empty($_FILES) && $_FILES['userfile']['error'] == 0) {
// на некоторых хостах если не в одной форме не используется поле для загрузки файлов этот блок нужно удалять
  $msg = "";
  for ($ct = 0; $ct < count($_FILES['userfile']['tmp_name']); $ct++) {
    $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['userfile']['name'][$ct]));
    $filename = $_FILES['userfile']['name'][$ct];
    if (move_uploaded_file($_FILES['userfile']['tmp_name'][$ct], $uploadfile)) {
      $mail->addAttachment($uploadfile, $filename);
    } else {
      $msg .= 'Failed to move file to ' . $uploadfile;
    }
  }
//}

//Build mail body content
$message = "";
$c = true;
foreach ( $_POST as $key => $value ) {
  if ( $value != "" && $key != "form_subject" ) {
    $message .= "
      " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
      <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
      <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
    </tr>
    ";
  }
}

// Code to display URL of current page.
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $urlLink = "https://";
else
  $urlLink = "http://";
// Append the host(domain name, ip) to the URL.
$urlLink .= $_SERVER['HTTP_HOST']; // оставляет только корневой хост
// Append the requested resource location to the URL
//$urlLink .= $_SERVER['REQUEST_URI']; // кидает до файла отправки ".../mail.php"
// Print the link
//echo $urlLink;

//$message .= '<b>Адрес сайта </b> - <a href="' . $urlLink . '">' . $urlLink . '</a>';

//Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = $_POST["form_subject"];
$mail->Body = "<table style='width: 100%;'>$message</table>";
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//die(var_dump($mail->Body));

//$mail->send();
if( $mail->send() ){
  $answer = '1';
}else{
  $answer = '0';
  echo 'Письмо не может быть отправлено. ';
  echo 'Ошибка: ' . $mail->ErrorInfo;
}
// echo json_encode(['Answer after submit' => $answer ]);

die( 'Answer after submit: ' . $answer );
?>
