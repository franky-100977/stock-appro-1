<?php
class UsersManager{
	private $_bd;

	public function __construct(){
		$this->setBD(BDFactory::getMysqlConnectionWithPDO());
	}

	public function setBD(PDO $bd){
		$this->_bd = $bd;
	}
	public static function getAttributsUser(){
		return array("id","username", "password", "restricted_password", "tel1", "tel2", "email");
	}
	public function userExist(User $user){
		if((int) $user->getId() > 0){
			$select = $this->_bd->query("SELECT * FROM users WHERE id = ".$user->getId());
			return ($select->rowCount() > 0);
		}else{
			trigger_error("L'utilisateur passé en paramètre n'a pa d'identitifant", E_USER_WARNING);
			return false;
		}
	}
	public function usernameExist($username){
		if(is_string($username) AND $username != ""){
			$select = $this->_bd->query("SELECT * FROM users WHERE username = '".$username."'");
			return ($select->rowCount() > 0);
		}else{
			trigger_error("Veuillez passer une chaine de caractères en paramètre", E_USER_WARNING);
			
		}
	}
	public function getUser($param){
		if(is_int($param))
			$select = $this->_bd->query("SELECT * FROM users WHERE id = ".$param);
		else
			$select = $this->_bd->query("SELECT * FROM users WHERE username = '".$param."'");
		if($select->rowCount() > 0){
			$user = $select->fetch(PDO::FETCH_ASSOC);
			$user['id'] = (int) $user['id'];
			return new User($user);
		}else{
			trigger_error("L'utilisateur à l'Id ".$id." n'existe pas dans la base de données", E_USER_WARNING);
			return false;
		}
	}
	public function getList(){
		$select = $this->_bd->query("SELECT * FROM users ORDER BY username");
		$users = array();
		
		while($user = $select->fetch(PDO::FETCH_ASSOC)){
			$user['id'] = (int) $user['id'];
			$users[] = new User($user);
		}
		return $users;
	}
	public function add(User $user){
		$insertion = $this->_bd->prepare("INSERT INTO users(username, password, restricted_password, tel1, tel2, email) VALUES(?,?,?,?,?,?)");
		if($insertion->execute(array($user->getUsername(), $user->getPassword(), $user->getRestricted_password(), $user->getTel1(), $user->getTel2(), $user->getEmail())))
			return true;
		else 
			return false;
	}
	public function update(User $user){
		$changements = "";
		$attrs = self::getAttributsUser();
		for($i=0;$i<count($attrs);$i++){
			$method = 'get'.ucfirst($attrs[$i]);
			if($user->$method() != ""){
				$changements .= $attrs[$i]." = '".$user->$method()."'";
				if($i < (count($attrs)-1))
					$changements .= ",";
			}
		}
		return $this->_bd->query("UPDATE users SET ".$changements." WHERE id = ".$user->getId());
		
	}
	public function delete(User $user){
		return $this->_bd->query("DELETE FROM users WHERE id = ".$user->getId());
	}
}
?>