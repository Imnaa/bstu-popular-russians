<?php

    /*
    // Для записи из языкового файла в БД
    include_once("./langs/ru.php");
    include_once("./langs/en.php");

    $keys_all = array_keys($ru);

    require "./includes/db.php";

    for ($i = 0; $i < count($keys_all); ++$i) {

        $lang = R::dispense('lang');

        //$temp = $keys_all[$i];
        $lang->word = $keys_all[$i];

        //$temp = $russian[$i];
        $lang->ru = $ru[$keys_all[$i]];

        //$temp = $english[$i];
        $lang->en = $en[$keys_all[$i]];

        $id = R::store($lang);
        echo '<div style="color: green;">'.$i.' -> Вы успешно выполнили импорт!</div><hr>';
    }
    */


