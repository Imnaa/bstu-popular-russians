<?php
    require "./includes/db.php";

	$id = intval($_POST['id']);

	/** Если нам передали ID то обновляем */
	if($id){
		// Извлекаем данные
		$record = R::findOne('lang', 'id = ?', array($id));
		
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