<?php
	/*
		Gerer les ventes
	*/
class Manager{
	protected $bd, $table, $class;

	public function __construct($table, $class){
		$this->bd = new PDO("mysql:host=localhost;dbname=boutique", "root", "");
		$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->table = $table;
		$this->class = $class;
	}
	
	public function ElementExist($id){
		$select = $this->bd->query("SELECT * FROM ".$this->table." WHERE id = $id");
		return ($select->rowCount() > 0);
	}
	public function getElement($id){
		$select = $this->bd->query("SELECT * FROM ".$this->table." WHERE id = ".$id);
		$element = $select->fetch(PDO::FETCH_ASSOC);
		$element['id'] = (int) $element['id'];
		return new $this->class($element);
	}
	public function getElements($condition = ""){
		$elements = array();
		if($condition == ""){
			$select = $this->_bd->query("SELECT * FROM ".$this->table);
		}else{
			$select = $this->_bd->query("SELECT * FROM ".$this->table." WHERE ".$condition);
		}
		while($element = $select->fetch(PDO::FETCH_ASSOC)){
			$elements[] = $this->class($element);
		}
		return $elements;
	}
	public function add($this->class $element){
		$reflectClass = new ReflectionClass($element);
		$propertiesNames = "";
		$propertiesValues = [];
		$i = 0;
		foreach($reflectClass->getProperties() as $property){
			$property->setAccessible(true);
			if($property->getName() != "id"){
				$propertiesNames .= $property->getName();
				if(is_int($property->getValue()))
					$propertiesValues[] = $property->getValue();
				else
					$propertiesValues[] ]= "'".$property->getValue()."'";
				if ($i < len($reflectClass->getProperties())){
					$propertiesNames .= ", ";
				}
			}
			$i++;
		}

		$insertion = $this->bd->prepare("INSERT INTO ".$this->table."(".$propertiesNames.") VALUES(?,?,?,?,?)");
		return $insertion->execute($propertiesValues);
	}
	public function update($this->class $element){
		$reflectClass = new ReflectionClass($element);
		$changements = "";
		foreach($reflectClass->getProperties() as $property){
			$property->setAccessible(true);
			if($property->getName() != "id"){
				if(is_int($property->getValue())){
					$changements .= $property->getName()." = ".$property->getValue();
				}else{
					$changements .= $property->getName()." = '".$property->getValue()."'";
				}
				if ($i < len($reflectClass->getProperties())){
					$changements .= ", ";
				}
			}
			$i++;
		}
		return $this->bd->query("UPDATE ".$this->table." SET ".$changements." WHERE id = ".$element->getId());
	}
	public function delete($id){
		return $this->bd->query("DELETE FROM ventes WHERE id = ".$id);
	}
}

?>