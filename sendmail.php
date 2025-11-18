<?php
header('Access-Control-Allow-Origin: http://fn-code.com/');
header('Access-Control-Allow-Headers: x-requested-with, content-type');
header('Access-Control-Allow-Methods: POST');
header('content-type: application/json');
header('Access-Control-Max-Age: 240');

$body = file_get_contents('php://input');

if( !$body ) {
  echo "NOOOO";
  die();
}

$form = json_decode($body);
$name = trim($form->name);
$email = trim($form->email);
$message = trim($form->message);

/* check name */
$patternName = "/^(?! )( ?[a-zA-Z]+[a-zA-ZäöüÄÖÜß]{2}){1,3}$/i";
$validatedName = preg_match($patternName, $name);

/* check email */
$patternEmail = '/^'.
'(?![.])([.]?[a-zA-Z0-9äöüÄÖÜß!\'#$%&*+\/=?^_`{|}~-]){1,64}'. // localPage
'@'.
'(?![.])([\.\-]?[a-zA-Z0-9äöüÄÖÜß]){1,252}[.][a-zA-Z]{2,24}'. // domainPart
'$/i';
$validatedEmail = preg_match($patternEmail, $email);

/* check message */
$patternMessage = "/^[a-zA-Z0-9äöüÄÖÜß!\'#$%&*+\/=?^_`{|}~ ,\.\n-]{1,800}$/i";
$validatedMessage = preg_match($patternMessage, $message);

if( $validatedName && $validatedEmail && $validatedMessage ) {
  $send = 'florian@fn-code.com';
  $header[] = 'From: Florian Nußbaum <florian@fn-code.com>';
  $header[] = 'Reply-To: '. $email;
  $header[] = 'MIME-Version: 1.0';
  $header[] = 'Content-type: text/html; charset=utf-8';
  
  mail($send, $name, $message, implode("\r\n", $header));

  $alert = [
    'status' => true,
    'message' => 'success!',
  ];
} else {
  $alert = [
    'status' => false,
    'message' => 'error!',
  ];
}
echo json_encode($alert);
