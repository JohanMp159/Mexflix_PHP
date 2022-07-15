<?php
require('StatusController.php');

echo '<h1>CRUD con MVC de la tabla status</h1>';

$status = new StatusController(); //Instanciamos un objeto de la clase StatusModel()

/*
var_dump($status_data); // var_dump permite analizar el tipo de contenido de la variable
$num_status = count($status_data); //count() guardamos el numero de registro
echo '<h2> Número de Status: <mark>'.$num_status.'</mark> </h2>'; 
*/


//INSERTAR NUEVO STATUS
//echo '<h2> Insertando Status </h2>';
$new_status = array(
	'status_id'=>0,
	'status' => 'Otro Status'
);
$status->create($new_status);


//ACTUALIZAMOS UN STATUS
//echo '<h2> Actualizando Status </h2>';
$update_status = array(
	'status_id'=>21,
	'status' => 'Other Status'
);
$status->update($update_status);


//Eliminar Datos
//echo '<h2> Eliminando Status </h2>';
$status->delete(21);



//CONSULTAR LOS STATUS EN UNA TABLA
$status_data = $status->read(); //Llamamos el Método read() ya definido en la clase StatusModel, el cual fue creado incialmente de la clase Princiapl Model como abstract, la cual nos indicaba que solo estaba definida 
echo '<h2> Tabla de Status </h2>'; 
echo '
<table>
	<tr>
		<th> status_id </th>
		<th> status </th> 
	</tr>';
	for ($n = 0; $n < count($status_data); $n++){
		echo '
		<tr>
			<td>'.$status_data[$n]['status_id'].'</td>
			<td>'.$status_data[$n]['status'].'</td> 
		</tr> ';
	}
	
echo '</table>'; 
