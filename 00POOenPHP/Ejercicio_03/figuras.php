<?php
require 'poligono.php';
require 'triangulo.php';
require 'cuadrado.php';
require 'rectangulo.php';
require 'hexagono.php';

echo '
<h2> Polígonos </h2>
<p> Figura geometrica que esta limitada por tres o mas rectas y tiene tres o mas angulos y vertices </p>
<h2> Perimetro </h2>
<p> El perimetro de un polígono es igual a la suma de las longitudes de sus lados</p>
<h2> Área </h2>
<p> El area de un polígono es la medida de la region o superfici encerrada por un polígono </p> <hr> ';

echo '
	<h3>Triangulo</h3>
	<img src="http://bextlan.com/img/para-cursos/poo-triangulo.png">
';

//Llamamos la Clase TRIANGULO
$triangulo = new Triangulo(3,6,9,10);

echo '<p>'.$triangulo->lados().'</p>';
//get_class() obtenemos el NOMBRE de la clase a la que pertenede desde un archivo externo
echo '<p> El Perímetro del '.get_class($triangulo).' es: <mark>'.$triangulo->perimetro().'</mark></p>';
echo '<p> El Área del '.get_class($triangulo).' es: <mark>'.$triangulo->area().'</mark></p> <hr>'; 


echo '
	<h3>Cuadrado</h3>
	<img src="http://bextlan.com/img/para-cursos/poo-cuadrado.png">
';

$cuadrado = new Cuadrado(7);

echo '<p>'.$cuadrado->lados().'</p>';
echo '<p> El Perímetro del '.get_class($cuadrado).' es: <mark>'.$cuadrado->perimetro().'</mark></p>';
echo '<p> El Área del '.get_class($cuadrado).' es: <mark>'.$cuadrado->area().'</mark></p> <hr>'; 


echo '
	<h3>Rectangulo</h3>
	<img src="http://bextlan.com/img/para-cursos/poo-rectangulo.png">
';

$rectangulo = new Rectangulo(5,6);

echo '<p>'.$rectangulo->lados().'</p>';
echo '<p> El Perímetro del '.get_class($rectangulo).' es: <mark>'.$rectangulo->perimetro().'</mark></p>';
echo '<p> El Área del '.get_class($rectangulo).' es: <mark>'.$rectangulo->area().'</mark></p> <hr>'; 



echo '
	<h3>Hexagono</h3>
	<img src="http://bextlan.com/img/para-cursos/poo-hexagono.png">
';

$hexagono = new Hexagono(8,9);

echo '<p>'.$hexagono->lados().'</p>';
echo '<p> El Perímetro del '.get_class($hexagono).' es: <mark>'.$hexagono->perimetro().'</mark></p>';
echo '<p> El Área del '.get_class($hexagono).' es: <mark>'.$hexagono->area().'</mark></p> <hr>'; 


