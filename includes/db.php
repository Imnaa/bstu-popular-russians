<?php

    require "rb.php";

    R::setup( 'mysql:host=localhost;port=3306;dbname=bstu_popular_russians',
        'root', '12345' );

    session_start();

    function ses_destroy() {
        $_SESSION = [];
        unset($_POST);
        unset($_COOKIE[session_name()]);
        session_destroy();
        header('Location: ../admin.php');
        exit;
    }

?>