/*Listado de operaciones (queries) CRUD de mexflix 

movieseries
	crear movieseries
	Actualziar moviesseries
	Eliminar moviesseries
	Buscar Todas las movieseries
	Busca pelicula o Serie por titulos, Personas(actores, autores), generos
	Buscar una movieseries por categorias 
	Buscar una movieseries por status 
	
status
	Crear status
	Actualizar status
	(REPLACE) status
	Eliminar status
	Buscar Todos los status
	Buscar un status por su status_id 'en particular'
	
user
	Crear User
	Actualizar User
		Datos generales
		Password
	Eliminar User
	Buscar Todos los usuarios
	Buscar un user por:
		user
		email
		role
		
*/


#movieseries
	#crear movieseries
	INSERT INTO movieseries SET imdb_id = 'tt3749900', title ='Gotam', plot ='', author = '', actors ='', country = '', premiere = '2014', trailer ='',
	poster = '', rating = 8.0, genres = 'Crime, Drama, Thriller', category = 'Serie', status = 3;
	
	#Actualziar moviesseries
	UPDATE movieseries SET title ='Gotham', plot ='In crime ridden Gotham City, Thomas and Martha Wayne are murdered before young Bruce Wayne\'s eyes. Although Gotham City Police Department detectives, James Gordon, and his cynical partner, Harvey Bullock, seem to solace\'s the case quickly, things are not so simple. Inspired by Bruce\'s traumatized desire for justice, Gordon vows to find it amid Gotham\'s corruption. Thus begins Gordon\'s lonely quest that would set him against his own comrades and the underworld with their own deadly rivalries and mysteries. In the coming wars, innocence will be lost and compromises will be made as some criminals will fall as casualties while others will rise as super villains. All the while, young Bruce observes this war with a growing obsession that would one day drive him to seek his own justice against the evil of Gotham as The Batman.', author = 'Bruno Heller', actors ='Zabryna Guevara, Ben McKenzie, Donal Logue, David Mazouz', country = 'USA', premiere = '2014', trailer ='https://www.youtube.com/watch?v=VwOPA2upeCA',
	poster = 'https://m.media-amazon.com/images/M/MV5BMmUyOTdjMGEtN2RmNC00YzUwLTg5ZDEtMTI1NWE4ZjcwN2ViXkEyXkFqcGdeQXVyNTA3MTU2MjE@._V1_SX300.jpg', rating = 8.0, category = 'Serie', status = 3 WHERE imdb_id = 'tt3749900';
	
	#Eliminar moviesseries
	DELETE FROM movieseries WHERE imdb_id = 'tt3749900';
	
	#Buscar Todas las movieseries
	SELECT ms.imdb_id, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status 
	FROM movieseries AS ms
		INNER JOIN status AS s
		ON ms.status = s.status_id;
	
	#Busca pelicula o Serie por titulos, Personas(actores, autores), generos
	SELECT ms.imdb_id, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status 
	FROM movieseries AS ms
		INNER JOIN status AS s
		ON ms.status = s.status_id
		WHERE MATCH(ms.title,ms.author,ms.actors,ms.genres)
		AGAINST('drama' IN BOOLEAN MODE);
	
	#Buscar una movieseries por categorias
	SELECT ms.imdb_id, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status 
	FROM movieseries AS ms
		INNER JOIN status AS s
		ON ms.status = s.status_id
		WHERE ms.category = 'Movie';
	
	#Buscar una movieseries por status 
	SELECT ms.imdb_id, ms.title, ms.plot, ms.author, ms.actors, ms.country, ms.premiere, ms.poster, ms.trailer, ms.rating, ms.genres, ms.category, s.status 
	FROM movieseries AS ms
		INNER JOIN status AS s
		ON ms.status = s.status_id
		WHERE ms.status = 3;
	
	
#status
	#Crear status
	INSERT INTO status SET status_id = 0, status = 'Otro status';
	
	#Actualizar status
	UPDATE status set status = 'Other status' WHERE status_id = 6;
	
	#Replace (SE DEBE TENER MUHCO CUIDADO POR QUE REPLACE ACTUALIZA TODOS LOS CAMPOS, SI SE OMITE UN CAMPO POR QUE NO SE NECESITA ACTUALIZAR SE TIENE QUE ESCRIBIR EN LA SENTENCIA EL VALOR ACTUAL)
	#Replace nos sirve para con una sola instruccion insertar o actualizar un dato
	REPLACE INTO status (status_id,status) VALUES (0, 'Otro Status');
	REPLACE status SET status_id = 30, status = 'Other Status';
	
	#Eliminar status
	DELETE FROM status WHERE status_id = 6;
	
	#Buscar Todos los status
	SELECT * FROM status;
	
	#Buscar un status por su status_id 'en particular'
	SELECT * FROM status WHERE status_id = 3;


#user
	#Crear User
	INSERT INTO users SET user='@usuario', email ='usuario@midominio.com', name='Soy un usuario', birthday ='1988-10-09', pass=MD5('un_passwrod'),role = 'Admin';
	
	#Actualizar User
		#Datos generales
	UPDATE users SET name='Soy un Usuario', birthday ='1984-10-09', role='User' WHERE user = '@usuario' AND email='usuario@midominio.com';
		#Password
	UPDATE users SET pass=MD5('un_nuevo_password') WHERE user='@usuario' AND email = 'usuario@midominio.com';
	 
	#Replace User
	REPLACE users SET user='@usuario', pass=MD5('un_nuevo_password');
	REPLACE users SET user='@usuario', email ='usuario@midominio.com', name='Soy un usuario', birthday ='1984-10-09', pass=MD5('un_nuevo_passwrod'),role = 'Admin';
	
	
	#Eliminar User
	DELETE FROM users WHERE user ='@usuario' AND email ='usuario@midominio.com';
	
	#Buscar Todos los usuarios
	SELECT * FROM users;
	
	#Buscar un user por:
		#user
	SELECT * FROM users WHERE user ='@usuario';
		#email
	SELECT * FROM users WHERE email = 'usuario@midominio.com';
		#role
	SELECT * FROM users WHERE role = 'User';
	
