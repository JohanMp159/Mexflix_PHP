<?php

$ms_controller = new MovieSeriesController();

if($_POST['r'] == 'movieserie-delete' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud'])){
	
	$ms = $ms_controller->get($_POST['imdb_id']);
	
	if(empty($ms)){
		$template = '
			<div class="container">
				<p class="item  error">No existe la MovieSerie <b>%s</b></p>
			</div>
			<script>
				window.onload = function(){
					reloadPage("movieseries")
				}
			</script>
		';
		
		printf($template,$_POST['imdb_id']);
	}else{
		$template_ms ='
			<h2 class="p1">Eliminar MovieSerie</h2>
			<form method="POST"  class="item">
				<div class="p1 f2">
					¿Estas seguro de eliminar la MoviesEries: <mark class="p1">%s</mark>?
				</div>
				<div class="p_25">
					<input class="button  delete" type="submit" value="SI">
					<input class="button  add" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="imdb_id" value="%s">
					<input type="hidden" name="r" value="movieserie-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';
		
		printf(
			$template_ms,
			$ms[0]['imdb_id'],
			$ms[0]['imdb_id']
		);
	}
	
}else if($_POST['r'] == 'movieserie-delete' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'del'){
	//Programamos la inserción
	
	$ms = $ms_controller->del($_POST['imdb_id']);
	
	$template ='
		<div class="container">
			<p class="item  delete"> MovieSerie <b>%s</b> eliminada </p>
		</div>
		
		<script>
			window.onload = function(){
				reloadPage("movieseries")
			}
		</script>
	';
	
	printf($template, $_POST['imdb_id']);
}else{
	//generamos una vista de perfil de no autorizado
	$controller = new ViewController();
	$controller->load_view('error401');
	
}