<?php
class Router {
	public $route;
	
	public function __construct($route){
		
		//http://php.net/manual/es/function.session-start.php
		//http://php.net/manual/es/session.configuration.php
		//Buscar opciones en el PHP.INI
		
		$session_options = array(
			'use_only_cookies' => 1,
			'auto_start' => 1,
			'read_and_close' => true
		);
		
		if( !isset($_SESSION) ) session_start($session_options); //Si no exite el objeto SESSION['ok'], iniciamos una Session
		if( !isset($_SESSION['ok']) ) $_SESSION['ok'] = false; // Si $_Session['ok'] No esta definida, le asignamos el valor de falso
		
		//Controlaremnos que parte de la aplicación vamos a mostrar
		//Si existe un inicio de session, entraria a la AppWeb
		if( $_SESSION['ok']){ 
			$this->route = isset($_GET['r']) ?$_GET['r'] :'home';
			
			$controller = new ViewController();
			
			switch($this->route){ //Switch permite evaluar el valor de una variable dependeindo de los casos
				case 'home':
					$controller->load_view('home');
					break;
					
				case 'movieseries':
					if(!isset($_POST['r']))	$controller->load_view('movieseries');
					else if($_POST['r'] == 'movieserie-add') $controller->load_view('movieserie-add');
					elseif ($_POST['r'] == 'movieserie-edit') $controller->load_view('movieserie-edit');
					elseif ($_POST['r'] == 'movieserie-delete') $controller->load_view('movieserie-delete');
					elseif ($_POST['r'] == 'movieserie-show') $controller->load_view('movieserie-show');
					break;
					
				case 'usuarios':
					if(!isset($_POST['r']))	$controller->load_view('users');
					else if($_POST['r'] == 'user-add') $controller->load_view('user-add');
					elseif ($_POST['r'] == 'user-edit') $controller->load_view('user-edit');
					elseif ($_POST['r'] == 'user-delete') $controller->load_view('user-delete');
					break;
					
				case 'status':
					if(!isset($_POST['r']))	$controller->load_view('status');
					else if($_POST['r'] == 'status-add') $controller->load_view('status-add');
					elseif ($_POST['r'] == 'status-edit') $controller->load_view('status-edit');
					elseif ($_POST['r'] == 'status-delete') $controller->load_view('status-delete');
					break;
					
				case 'salir':
					$user_session = new SessionController();
					$user_session->logout();
					
				default:
					$controller->load_view('error404');
					break;
			}			
		}else{
			if(!isset($_POST['user']) && !isset($_POST['pass']) ){				
				//Si no esta definida las variables que viene por POST, mostrar un formulario de autenticacion 'login' 
				$login_form = new ViewController();
				$login_form->load_view('login');

				//Cuando las varibles enviadas por POST NO vengan vacias, creamos un controlador de Session y a su vez ejecutamos el metodo login, que enviara los valores que vienen en el formulario por POST (usuario y el password)
			} else {
				$user_session = new SessionController();
				$session = $user_session->login($_POST['user'], $_POST['pass']);
				
				//Si $session viene vacia, fue que no encontro ningun registro en la BD, esta redigira al login y mandar un error visible en el formulario
				if( empty($session)){
					//echo 'El usuario y/o password son incorrectos';
					$controller = new ViewController();
					$controller->load_view('login');
					header('Location: ./?error=El usuario '. $_POST['user'] . ' y el password proporcionado no coinciden');
				} else {
					//Cuando el usuario y password sean correctos, creamos las secciones de php para tener acceso a la parte segura de nuesta App
					
					// echo 'Usuario Correcto';
					//var_dump($session);
					$_SESSION['ok'] = true;
					
					//Guardamos en variables de Session los datos de la consulta de la BD
					foreach($session as $row){
						$_SESSION['user'] = $row['user'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['name'] = $row['name'];
						$_SESSION['birthday'] = $row['birthday'];
						$_SESSION['pass'] = $row['pass'];
						$_SESSION['role'] = $row['role'];
					}
					
					header('Location: ./');
				}
			}
		}
	}
	/*
	public function __ destruct(){
		unset($this);
	}*/
}

