<?php
//ESTE ARCHIVO SERA EL QUE PERMITIRA LA CONEXION A LA BD CON MySQL

//Clase Abstracta que nos permitira conectarnos a MySQL
//al definirla como abstracta indicamos que no podemos crear un objeto de este tipo de clase, si no que tiene que ser previamente heredada, y estas clases heredadas van a poder utilizar todos los metodos protegidos de esta clase abstracta.
//de igual manera al definirla como abstracta todas aquellas classes que hereden sus caracteristicas deben de implementar todos los metodos abstractas que el Modelo abstracto tenga
abstract class Model {
	//Atributos
	//private indicamos que estara protejido y con static indicamos que siempre va tener el mismo valor
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';
	//protected indicamos que las clases hijas la van a poder utilizar
	protected $db_name;
	private static $db_charset = 'utf8';
	private $conn;
	protected $query;
	protected $rows = array();
	 
	
	//Métodos 
	//Metodos abstractos pra CRUD de clases que hereden
	abstract protected function create();
	abstract protected function read();
	abstract protected function update();
	abstract protected function delete();
	
	//Método privado para conectarse a la base de datos... por que ningun otro archivo mas que este es el que tendra la coneccion a MySQL
	private function db_open(){
		$this->conn = new mysqli(
			self::$db_host,
			self::$db_user,
			self::$db_pass,
			$this->db_name
		);
		
		$this->conn->set_charset(self::$db_charset);
	}
	
	//Método Privado para desconectarse de la base de datos
	private function db_close(){
		$this->conn->close();
	}
	
	//Establecer un query que afecte datos(INSERT, DELETE o UPDATE)
	protected function set_query(){
		$this->db_open();
		$this->conn->query($this->query); //query es un metodo de MySQL que nos permite hacer una consulta a la BD
		$this->db_close();
	}

	//Obtener datos de un query(SELECT)
	protected function get_query(){
		$this->db_open();
		$result = $this->conn->query($this->query); //query es un metodo de MySQL que nos permite hacer una consulta a la BD
		while( $this->rows[] = $result->fetch_assoc() ); //fetch_assocc es un metodo de la clase MySQL que devuelve los registros de na consulta a una 													BD por su nombre de campo
		$result->close(); //Cerramos la consulta y limpiamos osea liberamos la memoria que ocupa la variable
		$this->db_close();
		
		return array_pop($this->rows); //retornamos el arreglo que esta guardado (llenamos) en la variable rows
										// con array_pop() suprimimos el ultimo valor del arreglo, POR QU los arreglos siempre empezaran en la posicion 0, lo cual la ultima posicion sera nula
	}
		
}