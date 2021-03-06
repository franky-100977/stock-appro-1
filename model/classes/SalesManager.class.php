<?php
require_once("model/classes/Manager.class.php");

class SalesManager extends Manager{

	public function __construct(){
		parent::__construct("sales", "Sale");
	}
	public function saleExist($id){
		parent::elementExist($id);
	}
	public function getSale($id){
		parent::getElement($id);
	}
	public function getSales(){
		parent::getElements();
	}
	public function add(Sale $sale){
		parent::add($user);
	}
	public function update(Sale $sale){
		parent::update($user);
	}
	public function delete($id){
		parent::delete($id);
	}
}

?>