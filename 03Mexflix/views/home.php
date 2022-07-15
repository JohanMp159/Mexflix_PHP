<?php

$template = '
<article class="item">
	<h2 class="p1"> Hola %s, Bienvenid@ a Mexflix </h2>
	<h3 class="p1"> Tus Peliculas y series favoritas </h3>
	<p class="p1 f1_25"> tu nombre es <b> %s </b> </p>
	<p class="p1 f1_25"> tu Email es <b> %s </b> </p>
	<p class="p1 f1_25"> tu cumpleaños es <b> %s </b> </p>
	<p class="p1 f1_25"> tu perfil de usuario tiene nivel de <b> %s </b> </p>
</article>
';

//printf necesita su primer parametro una cadena de texto, y su segundo parametro serasn las varibales que se reemplazaran por los comodines indicados
printf(
	$template, 
	$_SESSION['user'],
	$_SESSION['name'],
	$_SESSION['email'],
	$_SESSION['birthday'],
	$_SESSION['role']
);