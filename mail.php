<?php

    $to = "kolya.romashenko@yandex.ru"; // емайл получателя данных из формы 
	$from = "robot@bstu.ru";   // от кого письмо
	$subject = "Обратная связь \"Неиссякаемый родник\"";  // тема
    
    $message = "Ваше имя: ".$_POST['name']."<br>"; //name=name
    $message .= "E-mail: ".$_POST['email']."<br>"; //name=email
    $message .= "Номер телефона: ".$_POST['phone']."<br>"; // name=phone
    $message .= "Сообщение: ".$_POST['message']."<br>"; // name=message

	mail($to, "=?utf-8?B?".base64_encode($subject)."?=", $message, 'MIME-Version: 1.0' . "\r\n"
		. 'From: ' . $from . "\r\n"
		. 'Reply-To: admin@bstu.ru' . "\r\n"
		. 'Content-type: text/html; charset="utf-8"' . "\r\n"
		. 'X-Mailer: php Mailer');


	$redicet = $_SERVER['HTTP_REFERER'];
	@header ("Location: $redicet");
	exit;
?>