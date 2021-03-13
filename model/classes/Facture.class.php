<?php
class Facture{
	protected 
		$id = 0, $client = "", $ids_produits = "", $mode_produits = "", $qte_produits = "";
	protected
		$pu_produits = "", $pt_produits = "", $red_produits = "", $total = 0, $date_vente = "", $heure_vente = "";
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
	public function getClient(){return $this->client;} 
	public function getIds_produits(){return $this->ids_produits;} 
		public function getIds_produits_tab(){
			$return =  $this->ids_produits;
			$return = explode('-|-', $return);
			return $return;
		} 
	public function getMode_produits(){return $this->mode_produits;} 
		public function getMode_produits_tab(){
			$return =  $this->mode_produits;
			$return = explode('-|-', $return);
			return $return;
		} 
	public function getQte_produits(){return $this->qte_produits;}
		public function getQte_produits_tab(){
			$return =  $this->qte_produits;
			$return = explode('-|-', $return);
			return $return;
		} 
	public function getPu_produits(){return $this->pu_produits;} 
		public function getPu_produits_tab(){
			$return =  $this->pu_produits;
			$return = explode('-|-', $return);
			return $return;
		} 
	public function getPt_produits(){return $this->pt_produits;} 
		public function getPt_produits_tab(){
			$return =  $this->pt_produits;
			$return = explode('-|-', $return);
			return $return;
		} 
	public function getRed_produits(){return $this->red_produits;} 
		public function getRed_produits_tab(){
			$return =  $this->red_produits;
			$return = explode('-|-', $return);
			return $return;
		}
	public function getTotal(){return $this->total;}
	public function getDate_vente(){return $this->date_vente;}
	public function getHeure_vente(){return $this->heure_vente;}
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
	public function setClient($value){
		if(is_string($value)){
			$this->client = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	} 
	public function setIds_produits($value){
		if(is_string($value)){
			$this->ids_produits = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	} 
	public function setMode_produits($value){
		if(is_string($value)){
			$this->mode_produits = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	} 
	public function setQte_produits($value){
		if(is_string($value)){
			$this->qte_produits = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	}
	public function setPu_produits($value){
		if(is_string($value)){
			$this->pu_produits = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	} 
	public function setPt_produits($value){
		if(is_string($value)){
			$this->pt_produits = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	} 
	public function setRed_produits($value){
		if(is_string($value)){
			$this->red_produits = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	} 
	public function setTotal($value){
		if((int) $value > 0){
			$this->total = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type int", E_USER_WARNING);
		}
	}
	public function setDate_vente($value){
		if(is_string($value)){
			$this->date_vente = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	}
	public function setHeure_vente($value){
		if(is_string($value)){
			$this->heure_vente = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	}
}
?>