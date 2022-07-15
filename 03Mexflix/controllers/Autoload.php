<?php
class Autoload{
	public function __construct(){
		//spl_autoload_register() Se ejecutara por cad archivo que encuentre dentro de la carpeta, este recibe como parametro una funcion anonima y esta indicara la ruta para acceder a diferentes modelos y controladores
		//por cada archivo de las rutas de carpetas que se especifique imprimira la programacion de dicho archivo
		spl_autoload_register(function($class_name){ //Recordemos que la funcion anomima que se ejecuta dentro de la funcion spl_autoload_register() 													recibe un parametro que es el nombre de la clase (RUTA O LINK) %class_name
			$models_path = './models/'.$class_name.'.php'; //Formamos la ruta de los Modelos
			$controllers_path = './controllers/'.$class_name.'.php'; //Formamos la ruta de los controladores 
			
			//Evaluamos si existe el archivo en la variable %models_path o $controllers_path incluyeme ese archivo 
			if(file_exists($models_path))  require_once($models_path);
			if(file_exists($controllers_path))  require_once($controllers_path);
		});	
	}
	/*
	public function __destruct(){
		unset($this);
	}*/
	
}