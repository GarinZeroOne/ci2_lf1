<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Piloto {

	private $idPiloto;
	private $nombre;
	private $apellido;
	private $pais;
	private $foto;
	private $code;
	private $driverId;
	private $valorActual = 0;
	private $valorAnterior = 0;
	private $equipo;
	private $precioMin = 0;
	private $precioMax = 0;
	private $valoresMercado;
	private $valorMax;
	private $valorMin;
	private $posicionMundial;
	private $puntosMundial;

	public function Piloto() {

	}

	public function getIdPiloto() {
		return $this->idPiloto;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getApellido() {
		return $this->apellido;
	}

	public function getPais() {
		return $this->pais;
	}

	public function getFoto() {
		return $this->foto;
	}

	public function getCode() {
		return $this->code;
	}

	public function getDriverId() {
		return $this->driverId;
	}

	public function getValorActual($formateado = false) {
		if ($formateado) {
			return number_format($this->valorActual, 0, ',', '.') . " €";
		}
		return $this->valorActual;
	}

	public function getValorAnterior($formateado = false) {
		if ($formateado) {
			return number_format($this->valorAnterior, 0, ',', '.') . " €";
		}
		return $this->valorAnterior;
	}

	public function getEquipo() {
		return $this->equipo;
	}

	public function setIdPiloto($idPiloto) {
		$this->idPiloto = $idPiloto;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setApellido($apellido) {
		$this->apellido = $apellido;
	}

	public function setPais($pais) {
		$this->pais = $pais;
	}

	public function setFoto($foto) {
		$this->foto = $foto;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setDriverId($driverId) {
		$this->driverId = $driverId;
	}

	public function setValorActual($valorActual) {
		$this->valorActual = $valorActual;
	}

	public function setValorAnterior($valorAnterior) {
		$this->valorAnterior = $valorAnterior;
	}

	public function setEquipo(Equipo $equipo) {
		$this->equipo = $equipo;
		$equipo->addPiloto($this);
	}

	public function getPrecioMin() {
		return $this->precioMin;
	}

	public function getPrecioMax() {
		return $this->precioMax;
	}

	public function setPrecioMin($precioMin) {
		$this->precioMin = $precioMin;
	}

	public function setPrecioMax($precioMax) {
		$this->precioMax = $precioMax;
	}

	public function getValoresMercado() {
		return $this->valoresMercado;
	}

	public function setValoresMercado($valoresMercado) {
		$this->valoresMercado = $valoresMercado;
	}

	public function getValorMax($formateado = false) {
		if ($formateado){
			return number_format($this->valorMax, 0, ',', '.') . " €";
		}
		return $this->valorMax;
	}

	public function getValorMin($formateado = false) {
		if ($formateado){
			return number_format($this->valorMin, 0, ',', '.') . " €";
		}
		return $this->valorMin;
	}

	public function setValorMax($valorMax) {
		$this->valorMax = $valorMax;
	}

	public function setValorMin($valorMin) {
		$this->valorMin = $valorMin;
	}

	public function getPosicionMundial() {
		return $this->posicionMundial;
	}

	public function getPuntosMundial() {
		return $this->puntosMundial;
	}

	public function setPosicionMundial($posicionMundial) {
		$this->posicionMundial = $posicionMundial;
	}

	public function setPuntosMundial($puntosMundial) {
		$this->puntosMundial = $puntosMundial;
	}

	public static function getById($idPiloto, $valMercado = true) {
		$CI;
		$CI = & get_instance();
		$CI->load->model('pilotos/pilotos_model');
		$datosPiloto = $CI->pilotos_model->getPiloto($idPiloto);

		$instance = new self();
		$instance->setIdPiloto($idPiloto);
		$instance->setNombre($datosPiloto->nombre);
		$instance->setApellido($datosPiloto->apellido);
		$instance->setPais($datosPiloto->pais);
		$instance->setFoto($datosPiloto->foto);
		$instance->setCode($datosPiloto->code);
		$instance->setDriverId($datosPiloto->driverId);
		$instance->setPrecioMax($datosPiloto->precio_max);
		$instance->setPrecioMin($datosPiloto->precio_min);

		$valorPiloto = $CI->pilotos_model->getValorPiloto($idPiloto);

		$instance->setValorActual($valorPiloto->valor_actual);
		$instance->setValorAnterior($valorPiloto->valor_anterior);

		if ($valMercado){
			$instance->setValoresMercado(
					$CI->pilotos_model->getValoresMercadoPilotoObject($idPiloto));
		}

		$instance->setValorMin($CI->pilotos_model->getValorMinimoPiloto($idPiloto));
		$instance->setValorMax($CI->pilotos_model->getValorMaximoPiloto($idPiloto));

		$datosMundial = $CI->pilotos_model->getPosicionPilotoMundial($idPiloto)->row();

		$instance->setPosicionMundial($datosMundial->posicion);
		$instance->setPuntosMundial($datosMundial->puntos);

		return $instance;
	}

	public function aumentarValor($porcentaje) {
		$this->valorAnterior = $this->valorActual;
		$this->valorActual = $this->valorActual + ($this->valorActual * $porcentaje / 100);
		if ($this->valorActual > $this->precioMax) {
			$this->valorActual = $this->precioMax;
		}
	}

	public function disminuirValor($porcentaje) {
		$this->valorAnterior = $this->valorActual;
		$this->valorActual = $this->valorAnterior - ($this->valorAnterior * $porcentaje / 100);
		if ($this->valorActual < $this->precioMin) {
			$this->valorActual = $this->precioMin;
		}
	}

	public function mismoValor(){
		$this->valorAnterior = $this->valorActual;
	}

	public function getCambioValor($formateado = false) {
		$valor = $this->valorActual - $this->valorAnterior;
		if ($formateado) {
			return number_format($valor, 0, ',', '.') . " €";
		}
		return $valor;
	}

	public function getCambioPorcentaje($formateado = false) {
		$porcentaje = $this->valorActual * 100 / $this->valorAnterior - 100;
		if ($formateado) {
			return round($porcentaje, 2). "%";
		}
		return round($porcentaje, 2);
	}

	public function getPrecioAlquiler($formateado = false) {
		$valor = $this->valorActual / 10;
		if ($formateado) {
			return number_format($valor, 0, ',', '.') . " €";
		}
		return $valor;
	}

	static function comparaPosicionMundial($a,$b) {
		return $a->getPosicionMundial() -$b->getPosicionMundial();
	}

}
