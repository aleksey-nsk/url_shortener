<?php

session_start();

// Подключим файл, содержащий класс Shortener:
require_once "classes/shortener.php";

// Создадим объект класса Shortener:
$shortener = new Shortener();

// var_dump($_POST);

$isFormSubmit = isset( $_POST['check'] );
if($isFormSubmit === true)
{
	$original_url = $_POST['original_url'];
	
	if( $code = $shortener->saveUrl($original_url) ) 
	{
		$_SESSION['message'] = "Готово! Короткий URL создан!";
	} 
	else 
	{
		$_SESSION['message'] = "Ошибка! Некорректный URL! Либо для данного URL уже есть запись в БД!";
	}
}

// Делаем редирект на главную страницу:
header('Location: index.php'); 

// Прерывание скрипта: 
die(); 
