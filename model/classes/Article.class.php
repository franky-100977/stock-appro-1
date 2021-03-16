<?php
class Article{
	protected 
		$id = 0, $id_section = 0, $designation = "", $unit_price = 0, $stock = 0,
		$minimum_stock = 3, $maximun_stock = 30;
	public function __construct(array $datas){
		$this->hydrate($datas);
	}
	public function hydrate(array $donnees){
		foreach($donnees as $key => $value){
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}else{
				trigger_error("La methode $method n'a pas été trouvée", E_USER_WARNING);
			}
		}
	}
	// Getters
	public function getId(){ return $this->id;}
	public function getId_section(){ return $this->id_section;}
	public function getDesignation(){ return $this->designation;}
	public function getUnit_price(){ return $this->unit_price;}
	public function getStock(){ return $this->stock;}
	public function getMinimunStock(){ return $this->minimum_stock;}
	public function getMaximunStock(){ return $this->maximum_stock;}
	/**
		SETTERS
	*/
	public function setId($id){
		if(is_int($id)){
			$this->id = (int) $id;
		}else{
			trigger_error("L'id doit etre un entier strictement positif", E_USER_WARNING);
		}
	}
	public function setId_section($id){
		if(is_int($id)){
			$this->id_section = (int) $id;
		}else{
			trigger_error("L'id doit etre un entier strictement positif", E_USER_WARNING);
		}
	}
	public function setDesignation($designation){
		if(is_string($designation)){
			$this->designation = $designation;
		}else{
			trigger_error("setDesignation : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	}
	public function setUnit_price($unit_price){
		if((int)$unit_price >=0){
			$this->unit_price = (int) $unit_price;
		}else{
			trigger_error("setunit_price : L'élément passé en parametre n'est de type int", E_USER_WARNING);
		}
	}
	public function setStock($stock){
		if((int)$stock >=0){
			$this->stock = $stock;
		}else{
			trigger_error("setPrix_gros : L'élément passé en parametre n'est de type int", E_USER_WARNING); 
		}
	}
}
?>