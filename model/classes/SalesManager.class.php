<?php
	/*
		Gerer les ventes
	*/
class VentesManager{
	private $_bd;

	public function __construct(){
		$this->setBD(BDFactory::getMysqlConnectionWithPDO());
	}

	public function setBD(PDO $bd){
		$this->_bd = $bd;
	}
	public static function getAttributsVentes(){
		$attrs = array("id", "id_vente", "date_vente", "heure_vente", "quantite", "pu");
		return $attrs;
	}
	public function venteExist($id,$id_vente = 0, $date_vente="", $heure_vente="", $quantite = 0){
		if($id_vente != 0){
			$select = $this->_bd->query("SELECT * FROM ventes WHERE id_vente = $id_vente AND date_vente = '$date_vente' AND heure_vente = '$heure_vente' AND quantite = $quantite");
		}else{
			$select = $this->_bd->query("SELECT * FROM ventes WHERE id = $id");
		}
		return ($select->rowCount() > 0);
	}
	public function getVente($id){
		$select = $this->_bd->query("SELECT * FROM ventes WHERE id = ".$id);
		$vente = $select->fetch(PDO::FETCH_ASSOC);
		$vente['id'] = (int) $vente['id'];
		$vente['id_produit'] = (int) $vente['id_produit'];
		return new Vente($vente);
	}
	public function getList($condition = "", $ordre = "id ASC"){
		$return = array();
		$ordre_text = "ORDER BY id ASC";
		if(in_array($ordre, array('id ASC', 'id DESC', 'id_vente ASC', 'id_vente DESC')))
			$ordre_text = "ORDER BY ".$ordre;
		if($condition == "id_vente"){
			$select = $this->_bd->query("SELECT $condition FROM ventes $ordre_text");
			while($r = $select->fetch(PDO::FETCH_ASSOC)){
				$return[] = $r["$condition"];
			}
		}else{
			$select = $this->_bd->query("SELECT * FROM ventes $ordre_text");
			while($vente = $select->fetch(PDO::FETCH_ASSOC)){
				$vente['id'] = (int) $vente['id'];
				$vente['id_produit'] = (int) $vente['id_produit'];
						$return[] = new Vente($vente);
			}
		}
		return $return;
	}
	public function getListBy($by, $ordre = "ASC",$particulier = "", $condition = ""){
		$return = array();
		if($ordre != "DESC")
			$ordre = "ASC";
		if($condition != "")
			$condition = "WHERE ".$condition;
		if(in_array($by, $this->getAttributsVentes())){
			if(in_array($particulier, $this->getAttributsVentes())){
				$select = $this->_bd->query("SELECT $particulier FROM ventes $condition ORDER BY $by $ordre");
				while($r = $select->fetch(PDO::FETCH_ASSOC)){
					$return[] = $r["$particulier"];
				}
			}else{
				$select = $this->_bd->query("SELECT * FROM ventes $condition ORDER BY $by $ordre");
				while($vente = $select->fetch(PDO::FETCH_ASSOC)){
					$vente['id'] = (int) $vente['id'];
					$vente['id_produit'] = (int) $vente['id_produit'];
					$return[] = new Vente($vente);
				}
			}
			return $return;	
		}else{
			trigger_error("Le paramètre $by n'est pas accepté", E_USER_WARNING);
		}
	}
	public function add(Vente $vente){
		$insertion = $this->_bd->prepare("INSERT INTO ventes(id_produit, date_vente, heure_vente, quantite,pu) VALUES(?,?,?,?,?)");
		return $insertion->execute(array(
			$vente->getId_produit(), $vente->getDate_vente()->getDate(), $vente->getHeure_vente(), 
			$vente->getQuantite(), $vente->getPu()
		));
	}
	public function update(Vente $vente){
		
	}
	public function delete($id){
		return $this->_bd->query("DELETE FROM ventes WHERE id = ".$id);
	}
}

?>