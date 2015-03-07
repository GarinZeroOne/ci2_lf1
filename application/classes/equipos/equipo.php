<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Equipo {

	private $idEquipo;
	private $escuderia;
	private $foto;
	private $constructorId;
	private $valorActual = 0;
	private $valorAnterior = 0;
	private $pilotos = array();
	private $precioMin = 0;
	private $precioMax = 0;
	private $valoresMercado;
	private $valorMax;
	private $valorMin;
	private $posicionMundial;
	private $puntosMundial;

	public function Equipo() {

	}

	public function getIdEquipo() {
		return $this->idEquipo;
	}

	public function getEscuderia() {
		return $this->escuderia;
	}

	public function getFoto() {
		return $this->foto;
	}

	public function getConstructorId() {
		return $this->constructorId;
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

	public function getPilotos() {
		return $this->pilotos;
	}

	public function getPrecioMin() {
		return $this->precioMin;
	}

	public function getPrecioMax() {
		return $this->precioMax;
	}

	public function setIdEquipo($idEquipo) {
		$this->idEquipo = $idEquipo;
	}

	public function setEscuderia($escuderia) {
		$this->escuderia = $escuderia;
	}

	public function setFoto($foto) {
		$this->foto = $foto;
	}

	public function setConstructorId($constructorId) {
		$this->constructorId = $constructorId;
	}

	public function setValorActual($valorActual) {
		$this->valorActual = $valorActual;
	}

	public function setValorAnterior($valorAnterior) {
		$this->valorAnterior = $valorAnterior;
	}

	public function setPilotos($pilotos) {
		foreach ($pilotos as $piloto) {
			$this->addPiloto($piloto);
		}
	}

	public function addPiloto(Piloto $piloto) {
		if (!in_array($piloto, $this->pilotos)) {
			$this->pilotos[] = $piloto;
			$piloto->setEquipo($this);
		}
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

	public function getValorMax($formateado = false) {
		if ($formateado) {
			return number_format($this->valorMax, 0, ',', '.') . " €";
		}
		return $this->valorMax;
	}

	public function getValorMin($formateado = false) {
		if ($formateado) {
			return number_format($this->valorMin, 0, ',', '.') . " €";
		}
		return $this->valorMin;
	}

	public function setValoresMercado($valoresMercado) {
		$this->valoresMercado = $valoresMercado;
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

	public static function getById($idEquipo, $valorMercado = true) {
		$CI;
		$CI = & get_instance();
		$CI->load->model('equipos/equipos_model');
		$datosEquipo = $CI->equipos_model->getInfoEquipo($idEquipo);

		$instance = new self();

		$instance->setConstructorId($datosEquipo->constructorId);
		$instance->setIdEquipo($idEquipo);
		$instance->setEscuderia($datosEquipo->escuderia);
		$instance->setFoto($datosEquipo->foto);
		$instance->setPrecioMax($datosEquipo->valor_max);
		$instance->setPrecioMin($datosEquipo->valor_min);

		$datosValor = $CI->equipos_model->getValorEquipo($idEquipo);

		$instance->setValorActual($datosValor->valor_actual);
		$instance->setValorAnterior($datosValor->valor_anterior);

		if ($valorMercado){
			$instance->setValoresMercado($CI->equipos_model->getValoresMercadoEquipoObject($idEquipo));
		}
		$instance->setValorMax($CI->equipos_model->getValorMaximoEquipo($idEquipo));
		$instance->setValorMin($CI->equipos_model->getValorMinimoEquipo($idEquipo));

		$datosMundial = $CI->equipos_model->getPosicionEquipoMundial($idEquipo)->row();

		$instance->setPosicionMundial($datosMundial->posicion);
		$instance->setPuntosMundial($datosMundial->puntos);

		return $instance;
	}

	public function aumentarValor($porcentaje) {
		$this->valorAnterior = $this->valorActual;
		$this->valorActual = $this->valorAnterior + ($this->valorAnterior * $porcentaje / 100);
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

	public function mismoValor() {
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
		$porcentaje = round($porcentaje, 2);
		if ($formateado) {
			return $porcentaje . "%";
		}
		return $porcentaje;
	}

	static function comparaPosicionMundial(Equipo $a,Equipo $b) {
		return $a->getPosicionMundial() -$b->getPosicionMundial();
	}

}
