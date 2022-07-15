<?php
class Perro {
	//ATRIBUTOS
		//public: Acceso desde cualquier método de la clase u objeto que lo invoque
		//private : Acceso solo desde los métodos de la clase, los objetos no los pueden invocar
		//protected: Acceso solo desde los metodos de la clase y las subclases que la hereden, los objenos no los pueden invocar
	
	public $nombre;
	public $raza;
	public $edad;
	public $sexo;
	public $adiestrado;
	public $foto;
	public $comida;
	private $pulgas;
	public static $mejor_amigo = 'Hombre';
	const MEJOR_CUALIDAD = 'Fidelidad';
	
	//MÉTODOS
		// constructor: Método que se ejecuta automaticamente al incio de instanciar la clase
		//destruct: Método que se ejecuta automaticamente al final de instanciar la clase
	
	public function __construct($n,$r,$s,$e,$a,$f,$p){
		$this->nombre = $n;
		$this->raza = $r;
		$this->edad = $e . ' años';
		$this->sexo = ($s)?'Macho':'Hembra';
		$this->adiestrado = ($a)?'Adiestrado':'No Adiestrado';
		$this->foto = $f;
		$this->pulgas = $p;
		echo '<p> <mark> Hola, Soy el constructor de la clase</mark> </p>';
	}
	
	public function __destruct(){
		echo '<p> <mark> Adios, Soy el destructor de la clase</mark> </p>';
	}
	
	public function ladrar(){
		echo '<p><mark> Guaauu Guaa </mark></p>';
	}
	public function comer($c){
		$this->comida = $c;
		echo '<p>'.$this->nombre.' come '.$this->comida.'</p>';
	}
	public function aparecer(){
		echo '<img src=" '.$this->foto.' ">';
	}
	
	public function tiene_pulgas(){
		echo ($this->pulgas)?'<p>'.$this->nombre.', Tiene pulgas </p>':'<p>'.$this->nombre.', No tiene pulgas </p>';
	}
	
	public function mas_info(){
		$this->ladrar();
		self::ladrar();
		$this->comer('huesos');
		Perro::comer('huesos');
		echo '<p> El Mejor amigo del Perro es el '.Perro::$mejor_amigo.'</p>';
		echo '<p> La Mejor cualidad del perro es la '.Perro::MEJOR_CUALIDAD.'</p>';	
	}
}

$kenai = new Perro('Kenai','Firefox',3,true,true,'URLDELA FOTO',false);

echo '<h1>'.$kenai->nombre.'</h1>';
echo '<h2>'.$kenai->raza.'</h2>';
echo '<h3>'.$kenai->edad.'</h3>';
echo '<h4>'.$kenai->sexo.'</h4>';
echo '<h5>'.$kenai->adiestrado.'</h5>';
echo '<h6>'.$kenai->foto.'</h6>';
//echo '<h6>'.$kenai->pulgas.'</h6>';

$kenai->ladrar();
$kenai->comer('croqueta');
$kenai->aparecer();
$kenai->tiene_pulgas();
$kenai->mas_info();
// var_dump($kenai); /* var_dump() PERMITE ANALIZAR LA ESTRUCTURA DE UN OBJETO */
?>