<?php
	/*
		Gerer les factures
	*/
class FacturesManager{
	private $_bd;

	public function __construct(){
		$this->setBD(BDFactory::getMysqlConnectionWithPDO());
	}

	public function setBD(PDO $bd){
		$this->_bd = $bd;
	}
	public static function getAttributsFactures(){
		$attrs = array("id", "client", "ids_produits", "mode_produits", "qte_produits", "pu_produits", "pt_produits", "red_produits", "total", "date_vente", "heure_vente");
		return $attrs;
	}
	public function factureExist($id,$client="", $ids_produits="", $total="", $date=""){
		if($client != ""){
			$select = $this->_bd->query("SELECT * FROM factures WHERE client = '$client' AND ids_produits = '$ids_produits' AND total = $total AND date_vente = '$date'");
		}else{
			$select = $this->_bd->query("SELECT * FROM factures WHERE id = $id");
		}
		return ($select->rowCount() > 0);
	}
	public function getFacture($id){
		$select = $this->_bd->query("SELECT * FROM factures WHERE id = ".$id);
		$facture = $select->fetch(PDO::FETCH_ASSOC);
		$facture['id'] = (int) $facture['id'];
		return new Facture($facture);
	}
	public function getList($condition = "", $ordre = "id ASC"){
		$return = array();
		$ordre_text = "ORDER BY id ASC";
		if(in_array($ordre, array('id ASC', 'id DESC', 'client ASC', 'client DESC')))
			$ordre_text = "ORDER BY ".$ordre;
		if($condition == "client"){
			$select = $this->_bd->query("SELECT $condition FROM factures $ordre_text");
			while($r = $select->fetch(PDO::FETCH_ASSOC)){
				$return[] = $r["$condition"];
			}
		}else{
			$select = $this->_bd->query("SELECT * FROM factures $ordre_text");
			while($facture = $select->fetch(PDO::FETCH_ASSOC)){
				$facture['id'] = (int) $facture['id'];
				$return[] = new Facture($facture);
			}
		}
		return $return;
	}
	public function add(Facture $facture){
		$insertion = $this->_bd->prepare("INSERT INTO factures(client, ids_produits, mode_produits, qte_produits, pu_produits, pt_produits, red_produits, total, date_vente, heure_vente) VALUES(?,?,?,?,?,?,?,?,?,?)");
		return $insertion->execute(array(
			$facture->getClient(), $facture->getIds_produits(), $facture->getMode_produits(), 
			$facture->getQte_produits(), $facture->getPu_produits(), $facture->getPt_produits(),
			$facture->getRed_produits(), $facture->getTotal(), $facture->getDate_vente(), $facture->getHeure_vente()
		));
	}
	public function update(Facture $facture){
		
	}
	public function delete($id){
		return $this->_bd->query("DELETE FROM factures WHERE id = ".$id);
	}
}

?>