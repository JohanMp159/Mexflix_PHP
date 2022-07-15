INSERT INTO movieseries SET imdb_id = 'TT3749900', title = 'Gotham', genres = 'Action, Crime, Drama',premiere ='2014',status = 3;

UPDATE movieseries SET author= 'Bruno Heller', actors ='Ben McKenzie, Jada Pinkett Smith, Donal Logue', country ='USA', poster ='https://m.media-amazon.com/images/M/MV5BMmUyOTdjMGEtN2RmNC00YzUwLTg5ZDEtMTI1NWE4ZjcwN2ViXkEyXkFqcGdeQXVyNTA3MTU2MjE@._V1_SX300.jpg', trailer ='', rating = 8.0, category = 'Serie', plot = 'In crime ridden Gotham City, Thomas and Martha Wayne are murdered before young Bruce Wayne\'s eyes. Although Gotham City Police Department detectives, James Gordon, and his cynical partner, Harvey Bullock, seem to solace\'s the case quickly, things are not so simple. Inspired by Bruce\'s traumatized desire for justice, Gordon vows to find it amid Gotham\'s corruption. Thus begins Gordon\'s lonely quest that would set him against his own comrades and the underworld with their own deadly rivalries and mysteries. In the coming wars, innocence will be lost and compromises will be made as some criminals will fall as casualties while others will rise as super villains. All the while, young Bruce observes this war with a growing obsession that would one day drive him to seek his own justice against the evil of Gotham as The Batman.' WHERE imdb_id = 'TT3749900';

DELETE FROM movieseries WHERE imdb:id = 'TT3749900';

SELECT * FROM movieseries; 
SELECT COUNT(*) FROM movieseries; 
SELECT * FROM movieseries WHERE category ='Serie'; 
SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category ='Serie'; 
SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category ='Movie' AND country  LIKE 'USA' ORDER BY premiere; 
SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category ='Movie' AND country  LIKE '%USA' ORDER BY premiere; 
SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category ='Movie' AND country  LIKE 'USA%' ORDER BY premiere; 
SELECT title, category, country, genres, premiere, status FROM movieseries WHERE category ='Serie' AND country  LIKE '%USA%' ORDER BY premiere; 
SELECT title, category, country, genres, premiere, status FROM movieseries WHERE status = 1 OR status = 2 OR status = 3 ORDER BY premiere; 


/*CONSULTAS MULTIPLE*/

SELECT * FROM movieseries AS ms INNER JOIN status AS s /*AS Indicamos un alias a la tabla*/ /*INNER JOIN JUNTAMOS LA TABLA INDICADAS*/
SELECT * FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id; /*REFERENCIAMOS POR CLAVE PRIMARIA*/
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id;
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id ORDER BY ms.premiere;
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id ORDER BY ms.premiere DESC;
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id WHERE s.status = 'Canceled' ORDER BY ms.premiere;
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id WHERE s.status = 'Canceled' OR s.status = 'Coming Soon' ORDER BY ms.premiere;
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status FROM movieseries AS ms INNER JOIN status AS s ON ms.status = s.status_id WHERE (s.status = 'Canceled' OR s.status = 'Coming Soon' OR s.status ='In Isuue') AND ms.category = "Serie" ORDER BY ms.premiere;

/*CONSULTAS FULLTEXT KEY*/

SELECT * FROM movieseries
	WHERE MATCH(title, author, actors, genres) /*MATCH() Une las coincidencias de los campos que vamos a consultar*/
	AGAINST('Jay Oliva' IN BOOLEAN MODE); /*AGAINT('Indicamos el valor que estoy buscando' IN BOOLEAN MODE)*/

SELECT title, category, country, genres, premiere, status, author, actors FROM movieseries
	WHERE MATCH(title, author, actors, genres) 
	AGAINST('Jay Oliva' IN BOOLEAN MODE); 
	
SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
	FROM movieseries AS ms 
	INNER JOIN status AS s
	ON ms.status = s.status_id
	WHERE MATCH(ms.title, ms.author, ms.actors, ms.genres) 
	AGAINST('drama' IN BOOLEAN MODE)
	ORDER BY ms.premiere;

/*INTEGRIDAD REFERENCIAL*/

SELECT COUNT(*) FROM movieseries WHERE status = 3;

INSERT INTO status SET status ='Otro Status', status_id = 0;
SELECT * FROM status;
SELECT COUNT(*) FROM movieseries WHERE status= 6
DELETE FROM movies WHERE status = 1 /*Debemos Eliminar los registros para poder eliminar proximamente el campo padre */
DELETE FROM status WHERE status_id = 1 /*Es posible eliminar este campo por que ya no existe ningun registro asociado a este valor*/

SELECT ms.title, ms.category, ms.country, ms.genres, ms.premiere, s.status
	FROM movieseries AS ms 
	INNER JOIN status AS s
	ON ms.status = s.status_id
	ORDER BY s.status, ms.premiere;
	
/*ACTUALIZAMOS EL VALOR '' DEL CAMPO STATUS 2 Y POR LA CASCADE INDICADA EN LA FOREING KEY ESTA ACTUALZIARA TODOS LOS VALORES VINCULADOS EN AUTOMATICO*/
UPDATE status
	SET status_id = 7; status = 'Estrenada'
	WHERE status_id = 2;