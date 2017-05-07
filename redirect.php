<?php

require_once "classes/shortener.php";

$code = $_GET['code'];
// echo 'code = ' . $code;

if( isset($code) )
{
	$shortener = new Shortener();
	
	if( $url = $shortener->getUrl($code) )
	{
		// echo $url; 
		header("Location: $url"); // делаем редирект
		die(); // прерывание скрипта
	}
	else
	{
		// echo "По данному коду $code URL в базе не найден!";		
		header('Location: page_404.php'); // делаем редирект 
		die(); // прерывание скрипта 
	}
}
