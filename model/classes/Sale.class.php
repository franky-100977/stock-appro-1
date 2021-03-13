<?php
class Vente{
	protected 
		$id = 0, $id_produit = 0, $date_vente = "", $heure_vente = "", $quantite = 0, $pu;
	public function __construct(array $datas){
		$this->hydrate($datas);
	}
	public function hydrate(array $donnees){
		foreach($donnees as $key => $value){
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method)){
				if($method == "setDate_vente" AND is_string($value))
					$value = new DateSys($value);	
				$this->$method($value);
			}else{
				trigger_error("La methode $method n'a pas été trouvée", E_USER_WARNING);
			}
		}
	}
	// Getters
	public function getId(){ return $this->id;}
	public function getId_produit(){ return $this->id_produit;}
	public function getDate_vente($mode =""){
		if($mode = "DateSys")
			return $this->date_vente;
		return $this->date_vente->getDate();
	}
	public function getHeure_vente(){return $this->heure_vente;}
	public function getQuantite(){return $this->quantite;}
	public function getPu(){return $this->pu;}
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
	public function setId_produit($id){
		if((int)$id > 0){
			$this->id_produit = (int) $id;
		}else{
			trigger_error("L'id doit etre un entier strictement positif", E_USER_WARNING);
		}
	}
	public function setDate_vente(DateSys $date){
		$this->date_vente = $date;
	}
	public function setHeure_vente($value){
		if(is_string($value)){
			$this->heure_vente = $value;
		}else{
			trigger_error("set : L'élément passé en parametre n'est de type string", E_USER_WARNING);
		}
	}
	public function setQuantite($qte){
		if((int)$qte > 0){
			$this->quantite = (int) $qte;
		}else{
			trigger_error("la qte doit etre un entier strictement positif", E_USER_WARNING);
		}
	}
	public function setPu($pu){
		if((int)$pu > 0){
			$this->pu = (int) $pu;
		}else{
			trigger_error("le pu doit etre un entier strictement positif", E_USER_WARNING);
		}
	}
}
?>