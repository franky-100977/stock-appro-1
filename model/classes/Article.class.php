<?php
class Article{
	protected 
		$id = 0, $nom = "", $prix_detail = 0, $prix_gros = 0, $stock = 0;
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
	public function getNom(){ return $this->nom;}
	public function getPrix_detail(){ return $this->prix_detail;}
	public function getPrix_gros(){ return $this->prix_gros;}
	public function getStock(){ return $this->stock;}
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
	public function setNom($nom){
		if(is_string($nom)){
			$this->nom = $nom;
		}else{
			trigger_error("setNom : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	}
	public function setPrix_detail($prix_detail){
		if((int)$prix_detail >=0){
			$this->prix_detail = (int) $prix_detail;
		}else{
			trigger_error("setPrix_detail : L'élément passé en parametre n'est de type int", E_USER_WARNING);
		}
	}
	public function setPrix_gros($prix_gros){
		if((int)$prix_gros >=0){
			$this->prix_gros = $prix_gros;
		}else{
			trigger_error("setPrix_gros : L'élément passé en parametre n'est de type int", E_USER_WARNING);
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