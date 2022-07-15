<?php 
require_once('Model.php');

class StatusModel extends Model {
	public $status_id;
	public $status;
	
	public function __construct(){
		$this->db_name = 'mexflix';
	}
	
	
	public function create( $status_data = array() ){
		foreach ($status_data as $key => $value){
			$$key = $value; //al indicar dobe signo de pesos ($$) significa que la posicion indicada la convierta en una variable dinamica
		};
		
		$this->query = "INSERT INTO status (status_id, status) VALUES ($status_id, '$status')";
		$this->set_query();
	}
	
	public function read( $status_id = '' ){
		$this->query = ($status_id != '')
			?"SELECT * FROM status WHERE status_id = $status_id"
			:"SELECT * FROM status";
		
		$this->get_query();
		//var_dump($this->rows); //permite analizar y convertir a cadena de texto el contenido de un objeto
		$num_rows = count($this->rows); //count()es un metodo que al ser ejecutado en un arreglo devolvera el número de posiciones de ese arreglo
		$data = array();
		
		foreach($this->rows as $key => $value){
			array_push($data, $value); //array_push agregara al final del arreglo una nueva posicion.. array_push('primer parametro donde se guaradara 								el nuevo valor','segundo parametro que valo sera el que se guardara')
			//$data[$key] = value; // si no queremos utilizar array_push() de igual manera podemos asignar el valor al nuevo arreglo de esta mnera.
		}
		return $data;
	}
	
	public function update( $status_data = array() ){
		foreach ($status_data as $key => $value){
			$$key = $value; //al indicar dobe signo de pesos ($$) significa que la posicion indicada la convierta en una variable dinamica
		};
		
		$this->query = "UPDATE status SET status_id = $status_id, status = '$status' WHERE status_id = $status_id";
		$this->set_query();
	}
	
	public function delete( $status_id = '' ){
		$this->query = "DELETE FROM status WHERE status_id = $status_id";
		$this->set_query();
	}
	
	/*
	public function __destruct(){
		unset($this); // hacemos referencia a destruir nuestro objeto
	}*/
	
}