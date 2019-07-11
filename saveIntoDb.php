<?php
    require "./includes/db.php";

	$word = trim($_POST['word']);
	$ru = trim($_POST['ru']);
	$en = trim($_POST['en']);

	// если все дали
	if($word && $ru && $en){
		// Изменяем запись
		R::exec('UPDATE lang SET ru = ?, en = ? WHERE word = ?', array($ru, $en, $word));
		
		// Извлекаем данные
		$record = R::findOne('lang', 'word = ?', array($word));
		
		if ($record) 
		{
			$message = 'Все хорошо';
		}
		else 
		{
			$message = 'Не удалось найти записанные данные';
		}

	}else{
		$message = 'Не удалось изменить данные';
	}
	/** Возвращаем ответ скрипту */
	// Формируем масив данных для отправки
	$out = array(
		'message' => $message,
		'record' => $record
	);
	// Устанавливаем заголовот ответа в формате json
	header('Content-Type: text/json; charset=utf-8');
	// Кодируем данные в формат json и отправляем
	echo json_encode($out);
	R::close();
?>