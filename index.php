<?php
	session_start();
	// In order to have access to session variables at any site pages, it is necessary 
	// to write only one line in the begining of each file, in which we need to use 
	// sessions. And then we can refer to the elements of the $_SESSION array. 
?>

<!DOCTYPE html> <!-- version HTML 5 for all documents --> 
<html>
	<head>
		<meta charset="utf-8">
		<title>My URL Shortener</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<div id="main_container">
			<h1>
				My URL Shortener
			</h1>

			<h3>
				Исходники на <a href="https://github.com/aleksey-nsk/url_shortener">GitHub</a>
			</h3>

			<form method="POST" action="handler.php">
				<!-- Скрытое поле, по которому будем определять
		 	 	был сабмит формы или не было: -->
				<input type="hidden" name="check" value="y">

				<!-- 
				Тег input лучше сделать используя 
				новое значение атрибута url (добавлено в HTML5). 
				Он не отправит форму, пока адрес не будет начинаться с http:// 
				-->
				<input type="url" name="original_url" placeholder="http://" autocomplete="on">

				<input type="submit" value="SHORTEN URL">
			</form>

			<div id="message">
				<?php
					// Проверяем наличие сессионной переменной 'message'. 
					// Если она есть, то выводим её значение: 
					if( isset($_SESSION['message']) ) 
					{
						echo $_SESSION['message'];
						$_SESSION['message']="";						
					}
				?>
			</div>

			<div id="urls">
				<?php 
					// ----- Подключение к серверу MySQL (соединение с сервером MySQL) -----

					// Параметры подключения для локального сервера:
					$host = 'localhost'; 
					$user = 'root'; 
					$password = ''; 
					$database = 'shortener';

					// Параметры подключения для выбранного хостинга:
					// $host = ''; 
					// $user = ''; 
					// $password = ''; 
					// $database = '';

					$mysqli = new mysqli($host, $user, $password, $database); 

					// ---------------------------------------------------------------------
					
					// Проверка подключения (соединения): 
					if( mysqli_connect_errno() )
					{
						printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
						exit;
					} 

					// Посылаем запрос серверу: 
					$stmt = $mysqli->query("SELECT id, url, short_url 
											FROM links 
											ORDER BY id DESC");

					// Возвращаем число строк в результате запроса: 
					$num = $stmt->num_rows; 

					// Выбираем результаты запроса: 
					for($i=0; $i<$num; $i++)
					{		
						$row = $stmt->fetch_assoc(); 

						$id = $row['id'];
						$url = $row['url'];
						$short_url = $row['short_url'];

						echo "<hr>" .
							 "Original URL: " . "<a href=$url target='_blank'>" . $url . "</a>" .
							 "<br>" . 
							 "Short URL: &nbsp&nbsp&nbsp&nbsp&nbsp" . 
							 "<a href=$url target='_blank'>" . $short_url . "</a>" .
							 "<br>" .
							 "<a class='del' href='delete.php?id=$id'>Delete URL</a>";						               
					}

					// Освобождаем память:
					$stmt->close(); 

					// Закрытие подключения (закрытие соединения):
					$mysqli->close();
				?>
			</div> <!-- /urls -->
		</div> <!-- /main_container -->
	</body>
</html>
