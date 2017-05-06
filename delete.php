<?php

$id = $_GET['id'];
// echo "id = " . $id;

// Подключение к серверу MySQL (соединение с сервером MySQL): 
$mysqli = new mysqli('localhost', 'root', '', 'shortener'); 

$mysqli->query("DELETE FROM links WHERE id = $id");

// Делаем редирект на главную страницу:
header('Location: index.php'); 

// Прерывание скрипта: 
die();
