<?php
abstract class Poligono{
	protected $lados;
	
	abstract protected function perimetro();
	abstract protected function area();
	
	//get_called_class() obtenemos el NOMBRE de la clase a la que pertenese desde un archivo propio(interno)
	public function lados(){
		return 'Un <mark>'.get_called_class().'</mark> tiene <mark>'.$this->lados.'</mark> lados';
	}
}