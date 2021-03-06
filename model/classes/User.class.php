<?php
	class User{
		protected
			$id = 0, $username = "", $password = "", $restricted_password;
		protected
			$tel1 = "Aucun", $tel2 = "Aucun", $email = "Aucune";
		// Constructeur
		public function __construct(array $datas){
			$this->hydrate($datas);
		} 
		// Fonction d'hydratation de l'objet
		public function hydrate($datas){
			foreach ($datas as $key => $value) {
				$method = 'set'.ucfirst($key);
				if(method_exists($this, $method)){
					$this->$method($value);
				}else{
					trigger_error("Hydrate : La méthode $method n'a pas été trouvée", E_USER_WARNING);
				}
			}
		}
		// Fonction qui renvoie les données demandées dans un tableau
		public function getByArray(array $datas){
			$return = array();
			foreach ($datas as $key => $value) {
				$method = 'get'.ucfirst($key);
				if(method_exists($this, $method)){
					$return[$key] = $this->$method($value);
				}else{
					trigger_error("getByArray : La méthode $method n'a pas été trouvée", E_USER_WARNING);
				}
			}
			return $return;
		}
		// GETTERS
		public function getId(){return $this->id;}
		public function getUsername(){return $this->username;}
		public function getPassword(){return $this->password;}
		public function getRestricted_password(){return $this->restricted_password;}
		public function getTel1(){return $this->tel1;}
		public function getTel2(){return $this->tel2;}
		public function getEmail(){return $this->email;}

		// SETTERS
		public function setId($id){
			if(is_int($id) AND $id > 0){
				$this->id = $id;
			}else{
				trigger_error("L'id doit être un entier strictement positif'", E_USER_WARNING);
			}
		}
		public function setUsername($username){
			if(is_string($username) AND strlen($username) >= 5){
				$this->username = $username;
			}else{
				trigger_error("Le nom d'utilisateur doit avoir au moins six caractères", E_USER_WARNING);
			}
		}
		public function setPassword($password){
			if(is_string($password) AND strlen($password) >= 6){
				$this->password = $password;
			}else{
				trigger_error("Le mot de passe doit avoir au moins huit caractères", E_USER_WARNING);
			}
		}
		public function setRestricted_password($password){
			if(is_string($password)){
				$this->restricted_password = $password;
			}else{
				trigger_error("Le mot de passe doit avoir au moins huit caractères", E_USER_WARNING);
			}
		}
		public function setTel1($tel){if($tel != "") $this->tel1 = $tel;}
		public function setTel2($tel){if($tel != "") $this->tel2 = $tel;}
		public function setEmail($email){if($email != "") $this->email = $email;}

		// Autres fonctions
		public function isset_restricted_password(){
			$isset = false;
			if($this->restricted_password != "")
				$isset = true;
			return $isset;
		}
	}
?>