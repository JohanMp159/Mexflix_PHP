/*
Mexflix: Base de Datos de películas y Series

Tipos de Datos en MySQL
	http://mysql.conclase.net/curso/index.php?cap=005#
	http://dev.mysql.com/doc/refman/5.7/en/data-types.html

*/

DROP DATABASE IF EXISTS mexflix; /* Elimina la base de datos si existe */

CREATE DATABASE IF NOT EXISTS mexflix; /*IF NOT EXISTS genermos una validacion!.. si no existe, que lo cree*/
USE mexflix;


/*TABLA CATÁLOGO*/
CREATE TABLE status(
	status_id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	status VARCHAR(20) NOT NULL
);

/*TABLA DE DATOS*/
CREATE TABLE movieseries(
	imdb_id CHAR(9) PRIMARY KEY, /*CHAR() Se ocupan los caracteres indicados como maximo y si no se llenan, se ocupan de igual manera estando vacios 									siendo un desperdicio de consumo de espacio fisico de memoria y rendimiento */
	title VARCHAR(80) NOT NULL, /*VARCHAR() tiene la capacidad de adaptarse, si se ocupan 13 las otras 67 no se ocuparan y el campo se adaptara al 									campo que se tenga*/
	plot TEXT NULL,				 /*TEXT Permite almacenar la cantidad de caracteres que se necesiten*/
	author VARCHAR(100) DEFAULT 'Pending', /*DEFAULT si el campo viene vacio damos un valor por defecto*/
	actors VARCHAR(100) DEFAULT 'Pending',
	country VARCHAR(100) DEFAULT 'Unknown',
	premiere YEAR(4) NOT NULL, /*Indicamos que sea de 4 Dígitos la fecha*/
	poster VARCHAR(150) DEFAULT 'no-poster.jpg',
	trailer VARCHAR(150) DEFAULT 'no-trailer.jpg',
	rating DECIMAL(2,1),		/*DECIMAL("","") Necesita dos parametros.. Su primer Parametro es cuantas posiciones va tener mi número; el segundo 									parametro es de esas posiciones cuantas van a ser decimal*/
	genres VARCHAR(50) NOT NULL,
	status INTEGER UNSIGNED  NOT NULL, /*INTEGER Hace referencia a un número entero, UNSIGNED indica que no tenga signo!:.. Este campo funcionara como 										mi FOREING KEY*/ 
	category ENUM('Movie','Serie') NOT NULL, /*ENUM() Es una lista númerada o Conjunto de valores, está no escalara más*/
	FULLTEXT KEY search(title, author, actors, genres), /*FULLTEXT KEY Nos permitira hacer una busqueda global apartir de una coincidencia en los 														campos indicados*/
	FOREIGN KEY(status) REFERENCES status(status_id)
		ON DELETE RESTRICT ON UPDATE CASCADE 
	
	/*iNDICAMOS LA RELACION DE LAS LLAVES.. PRIMERO EL CAMPO QUE ES PRIMARY KAY DE NUESTRA TABLA, LUEGO EL NOMBRE DE LA TABLA QUE VAMOS A REFERENCIAR Y LUEGO EL CAMPO DE LA TABLA QUE COINCIDIRA CON LA RELACION OSEA LA PRIMARY KAY DE LA TABLA REFERENCIADA */
	
	/*DEBEMOS INDICAR UNA RESTRICCION CUANDO SUCEDA POR EJM QUE SE VA ELIMNAR UN CAMPO DE LA TABLA!.. CON RESTRICT INDICAMOS QUE SOLO PODRA ELIMINAR EL CAMPO CUANDO NO TENGA REGISTROS ASOCIADOS A ESTE CAMPO EN NINGUNA TABLA CON LA TENGA RELACION O LA MISMA... CON CASCADE CUANDO QUERAMOS ACTUALIZAR UN VALOR QUE ESTE ASOCIADO EN DEMAS TABLAS O LA MISMA MODIFICARA EN AUTOMATICO TODOS LOS CAMPOS CON ESE VALOR ASOCIADO */
);


/*Tabla para registro de usuarios*/
CREATE TABLE users(
	user VARCHAR(15) PRIMARY KEY,
	email VARCHAR(80) UNIQUE NOT NULL, /*UNIQUE indicamos que el campo registrado no se permitara volver a ingresar el registro*/
	name VARCHAR(100) NOT NULL,
	birthday DATE NOT NULL,
	pass CHAR(32) NOT NULL, 
	role ENUM('Admin','User') NOT NULL
);

INSERT INTO status(status_id,status) VALUES
	(1,'Coming Soon'),
	(2,'Release'),
	(3,'In Isuue'),
	(4,'Finished'),
	(5,'Canceled');
	
INSERT INTO users(user,email,name,birthday,pass,role) VALUES 
	('@johanmunoz','jamp.159@hotmail.com','Johan Muñoz','1997-04-02',MD5('6628992'),'Admin'), /*Utilizamos MD5('') para generar una encriptacion a 																								partir de cadena de texto*/
	('@user','usuario@gmail.com','Usuario Mortal','2000-04-26',MD5('123'),'User');
	
/*http://omdbapi.com*/
INSERT INTO movieseries(imdb_id,title,plot,genres,author,actors,country,premiere,trailer,poster,rating,status,category)VALUES
(
	'tt0903747','Breaking Bad','When chemistry teacher Walter White is diagnosed with Stage III cancer and given only two years to live, he decides he has nothing to lose. He lives with his teenage son, who has cerebral palsy, and his wife, in New Mexico. Determined to ensure that his family will have a secure future, Walt embarks on a career of drugs and crime. He proves to be remarkably proficient in this new world as he begins manufacturing and selling methamphetamine with one of his former students. The series tracks the impacts of a fatal diagnosis on a regular, hard working man, and explores how a fatal diagnosis affects his morality and transforms him into a major player of the drug trade.','Crime, Drama, Thriller','Vince Gilligan','Bryan Cranston, Anna Gunn, Aaron Paul, Dean Norris','USA','2008','https://www.youtube.com/watch?v=Bi3mMWw_cJ4','https://m.media-amazon.com/images/M/MV5BZTE2YWRlMmYtOGFkYy00MjcxLWJkNmQtNTJmNTZkZjVhZGE1XkEyXkFqcGdeQXVyMTMzNDExODE5._V1_SX300.jpg',9.5,4,'Serie'
),
(
	'tt2820466','Justice League: The Flashpoint Paradox','An alteration of the timeline for the superhero, The Flash. The Flash must team with other heroes to restore the timeline while the Earth is ravaged by a war between Aquaman\'s Atlantis and Wonder Woman\'s Amazons.','Animation, Action, Adventure, Fantasy, Sci-Fi','Jay Oliva','Justin Chambers, C. Thomas Howell, Michael B. Jordan, Kevin McKidd','USA','2013','http://www.youtube.com/watch?v=xe0JiobQ98o','https://m.media-amazon.com/images/M/MV5BMTgwNTljYzgtOTU3ZC00ZjhhLTk0YzItY2RiMWU0MGZlNzFjL2ltYWdlXkEyXkFqcGdeQXVyNDQ2MTMzODA@._V1_SX300.jpg',8.1,2,'Movie'
),
(
	'tt1520211','The Walking Dead','Sheriff Deputy Rick Grimes gets shot and falls into a coma. When awoken he finds himself in a Zombie Apocalypse. Not knowing what to do he sets out to find his family, after he\'s done that, he gets connected to a group to become the leader. He takes charge and tries to help this group of people survive, find a place to live and get them food. This show is all about survival, the risks and the things you\'ll have to do to survive.','Drama, Horror, Thriller','N/A','Andrew Lincoln, Norman Reedus, Melissa McBride','USA','2015','','https://m.media-amazon.com/images/M/MV5BZmU5NTcwNjktODIwMi00ZmZkLTk4ZWUtYzVjZWQ5ZTZjN2RlXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg',8.4,3,'serie'
);