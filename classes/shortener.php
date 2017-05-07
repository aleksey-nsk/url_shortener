<?php

// Создадим класс Shortener:  
class Shortener 
{
	// Объявим protected-свойство данного класса:
	protected $connection;

	// Создадим конструктор:
	public function __construct() 
	{
		// Соединяемся с сервером MySQL 
		// и записываем объект в свойство $connection: 
		$this->connection = new mysqli('localhost', 'root', '', 'shortener');
		// $this->connection = new mysqli('sql210.byethost24.com', 'b24_20062583', 'short99test8', 'b24_20062583_shortener');
	}

	// Метод который генерирует некий код:	
	public function generateCode($id) 
	{
		// Символы из которых будет состоять случайный код:
		$alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

		// string str_shuffle( string $str ) - переставляет символы
		// в строке случайным образом. Возвращает перемешанную строку:
		$shuffled = str_shuffle($alphabet);

		// string substr( string $string , int $start [, int $length ] )
		// - возвращает подстроку строки $string, начинающуюся
		// со $start символа по счету и длиной $length символов.
		// Случайный код длиной 4 символа: 
		$random = substr($shuffled, 0, 4); 

		settype($id, "string"); // $id теперь строка (тип string)
		
		// В итоге получим $code - это случайный код длиной 5 символов или больше. 
		// Первые несколько символов это айдишник из БД, далее идут 4 случайных символа.
		// $code это строка (тип string):
		$code = $id . $random; 		
		
		return $code; // возвращаем сгенерированный код	
	}

	// Метод который сохраняет в БД URL и короткую ссылку на этот URL.
	// В данный метод передаём $url:
	public function saveUrl($url) 
	{
		// Удалим пробелы и табуляции из начала и конца строки: 
		$url = trim($url);

		// filter_var() фильтрует переменную с помощью определенного фильтра.
		// Здесь в качестве фильтра валидации данных 
		// используем FILTER_VALIDATE_URL - он проверяет значение как URL, 
		// опционально с требуемыми компонентами.
		// То есть проверим $url на корректность с помощью filter_var(): 
		if( !filter_var($url, FILTER_VALIDATE_URL) ) 
		{
			return; 
		}

		// Теперь обращаемся к базе данных:
		$select_row = $this->connection->query("SELECT * FROM links WHERE url = '{$url}'");

		if($select_row->num_rows == 0) // если число рядов в результирующей выборке равно 0 
		{			
			// Сначала записываем в базу данных url: 
			$this->connection->query("INSERT INTO links(url) VALUES('{$url}')");

			// Далее нужно сгенерировать код с помощью метода generateCode(), передав 
			// ему id последней вставленной записи: 
			$code = $this->generateCode($this->connection->insert_id);
			// - insert_id возвращает ID, генерируемый запросом (обычно INSERT) 
			// к таблице, которая содержит колонку с атрибутом AUTO_INCREMENT. 

			// Сгенерируем короткий URL:
			$short_url = "http://shortener.local/$code";
			// $short_url = "http://short.byethost24.com/$code";
			
			// Затем обновляем запись, вставив туда $code и $short_url:  
			$this->connection->query("UPDATE links SET code = '{$code}' WHERE url = '{$url}'");
			$this->connection->query("UPDATE links SET short_url = '{$short_url}' WHERE url = '{$url}'");

			// Возвращаем код $code из метода: 
			return $code;
		}
	}

	// Метод который вернёт URL из БД:
	public function getUrl($code)
	{
		$code = $this->connection->query("SELECT url FROM links WHERE code = '$code'");

		if($code->num_rows) 
		{
			return $code->fetch_object()->url;
		}
		else
		{
			return '';
		}
	}	
}
