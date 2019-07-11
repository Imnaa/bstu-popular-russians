<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
	<head>
		<?php
			if($GLOBALS['title']) {
			    $title = $GLOBALS['title'];
			} else {
			    $GLOBALS['title'] = "Welcome";        
			}
			if($GLOBALS['desc']) {  
			    $desc = $GLOBALS['desc'];
			} else {
			    $desc = "This is a default description of my website";      
			}
			if($GLOBALS['keywords']) {
			    $keywords = $GLOBALS['keywords'];   
			} else {
			    $keywords = "welcome, key, words";     
			}
		?>

		<title><?php echo $title ?></title>
		<meta name="description" content="<?php echo $desc ?>">
		<meta name="keywords" content="<?php echo $keywords ?>">
		<link rel="icon" href="./favicon.ico" type="image/x-icon">
		<meta charset="UTF-8">
		<!-- jquery -->
		<script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
		<!-- popper -->
  		<script type="text/javascript" src="./js/popper.min.js"></script>
		<!-- Bootstrap 4 -->
		<link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">
  		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<!-- CSS -->
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<!-- include summernote css/js -->
		<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

		<!-- Google Fonts -->
		<!-- link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic-ext" rel="stylesheet">-->
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">
		<!-- Уведомления -->
		<script type="text/javascript" src="./js/notifications.js"></script>
	</head>