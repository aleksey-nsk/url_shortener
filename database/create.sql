/* Выполним данный запрос в phpMyAdmin: */

/* Создадим таблицу links: */ 
CREATE TABLE links 
(
	id    INT    NOT NULL    PRIMARY KEY    AUTO_INCREMENT,
	url        VARCHAR(100), /* url который мы будем вводить в форму. Ограничим 100 знаков */	 	
	code       VARCHAR(10),  /* код который будет сгенерирован для каждого URL */
	short_url  VARCHAR(50)   /* короткий URL-адрес */
);

/* Увидим описание таблицы links: */ 
DESCRIBE links; 
