<?php
require_once("model/classes/Manager.class.php");

class UsersManager extends Manager{

	public function __construct(){
		parent::__construct("users", "User");
	}
	public function userExist($id){
		parent::elementExist($id);
	}
	public function usernameExist($username){
		select = $this->bd->query("SELECT * FROM ".$this->table." WHERE username = '".$username."'");
		return ($select->rowCount() > 0);
	}
	public function getUser($id){
		parent::getElement($id);
	}
	public function getUsers(){
		parent::getElements();
	}
	public function add(User $user){
		parent::add($user);
	}
	public function update(User $user){
		parent::update($user);
	}
	public function delete($id){
		parent::delete($id);
	}
}
?>