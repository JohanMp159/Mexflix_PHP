<?php

class Cuadrado extends Poligono{
	private $lado;
	
	public function __construct($l){
		$this->lados = 4;
		$this->lado = $l;
	}
	
	public function perimetro(){
		return $this->lados * $this->lado;
	}
	
	public function area(){
		//pow("","") es una funcion Matematica que permite calcular potencias, Primer parametro recibe el numero que se queire elevar, el segundo parametro es que potencia se deseaa
		return pow($this->lado,2);
	}	
}