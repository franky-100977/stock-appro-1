<?php
require_once("model/classes/Manager.class.php");

class BillsManager extends Manager{

	public function __construct(){
		parent::__construct("bills", "Bill");
	}
	public function BillExist($id){
		parent::elementExist($id);
	}
	public function getBill($id){
		parent::getElement($id);
	}
	public function getBills(){
		parent::getElements();
	}
	public function add(Bill $bill){
		parent::add($user);
	}
	public function update(Bill $bill){
		parent::update($user);
	}
	public function delete($id){
		parent::delete($id);
	}
}

?>