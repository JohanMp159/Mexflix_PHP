<!-- Si la variable 'error' que se envia por la URL de tipo GET['error'] esta definida -->
<?php 
print('
	<form class="item" method="post">
		<div class="p_25">
			<input type="text" name="user" placeholder="Usuario" required>
		</div>
		<div class="p_25">
			<input type="password" name="pass" placeholder="Passwrod" required>
		</div>
		<div class="p_25">
			<input type="submit" class="button" value="Enviar">
		</div>
	</form>
');

if ( isset($_GET['error'])){ 
	$template ='
	<div class="container ">
		<p class="item  error"> %s </p>
	</div>
	';
	
	printf($template, $_GET['error']);
 }