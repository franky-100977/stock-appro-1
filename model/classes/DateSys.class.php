<?php 
class DateSys{
	protected $day, $month, $year, $time_date;
	public static $MONTHS = array("Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre");
	public static $SHORT = "s", $LONG = "l";

	public function __construct($day, $month = 0, $year = 0){
		if($month == 0 AND $year == 0){
			$this->setDate($day);
		}elseif($month != 0 AND $year == 0){
			trigger_error("DateSys::__construct : Erreur lors d'instanciation: renseignez l'année", E_USER_WARNING);
		}else{
			$this->setyear($year);
			$this->setmonth($month);
			$this->setday($day);
		}
		$this->time_date = mktime(0,0,0, $this->month, $this->day, $this->year);
	}
	// GETTERS
	public function getTime_date(){return $this->time_date;}
	public function getDay($param = ""){
		if($param == self::$LONG)
			return date('D', $this->time_date);
		elseif($param == self::$SHORT){
			$num = date('w', $this->time_date);
			if($num == 0) $num = 7;
			return $num;
		}
		return $this->day;
	}
	public function getMonth($param = ""){
		if($param == "l")
			return self::$MONTHS[$this->month-1];
		return $this->month;
	}
	public function getYear(){return $this->year;}
	//SETTERS
	public function setDay($day){
		if(is_int($day) AND $day > 0 AND $day <=31){
			if($this->month == 2){
				if($day <= 29){
					$this->day = $day;
				}else{
				trigger_error("Le month dans cette date est le deuxieme donc on ne peut avoir un nombre de days supérieur à 29",E_USER_WARNING);
				}
			}else if(in_array($this->month, array(4,6,9,11))){
				if($day <= 30){
					$this->day = $day;
				}else{
				trigger_error("Le month dans cette date ne peut avoir un nombre de days supérieur à 30",E_USER_WARNING);
				}
			}else{
				$this->day = $day;
			}
		}else{
			trigger_error("Le day dans la date doit etre un entier strictement positif inférieur ou égal à 31", E_USER_WARNING);
		}
	}
	public function setmonth($month){
		if(is_int($month) AND $month > 0 AND $month <=12){
			if(($month == 2 AND $this->day > 29) OR(in_array($month, array(4,6,9,11)) AND $this->day > 30)){
				trigger_error("Cette date a ".$this->day." days. Vous ne pouvez donc pas mettre le month N° ".$month, E_USER_WARNING);
			}else
				$this->month = $month;
		}else{
			trigger_error("Le month dans la date doit etre un entier strictement positif inférieur ou égal à 12", E_USER_WARNING);
		}
	}
	public function setYear($year){
		if(is_int($year) AND ($year > 1900)){
			$this->year = $year;
		}else{
			trigger_error("year incorrecte", E_USER_WARNING);
		}
	}
	// Autres finctions
	/*
		Prend une date et la décompose pour les attributs de l'objet
		@param $date:string
		@return void
	*/
	public function setDate($date){
		$elmts = explode('-', $date);
		if(count($elmts) == 3){
			$this->setday((int) $elmts[0]);
			$this->setmonth((int) $elmts[1]);
			$this->setyear((int) $elmts[2]);
		}else{
			trigger_error("DateSys::setDate : La date est incorrect: Format (jj-mm-aaaa)", E_USER_WARNING);
		}
	}
	/**
		Retourne la date complète
		@param $param:string
		@return $date
	*/
	public function getDate($param = ""){ 
		$date = "";
		if($this->day < 10) $date .= "0".$this->day;
		else $date .= $this->day;
		if($param =="l"){
			$date .= " ".$this->getmonth('l')." ";
		}else{
			$date .= "-";
			if($this->month < 10) $date .= "0".$this->month;
			else $date .= $this->month;
				$date .= "-";
		}
		$date .= $this->year;
		return $date;

	}
	/**
		Retourne le nombre de day du month de l'objet
		@param void
		@return ..
	*/
	public function getNbDaysmonth(){
		return (int) date('d', mktime(0,0,0,($this->month+1), -1, $this->year));
	}
	/**
		Retourne true si le day est un samedi ou un dimanche
		@param $param:string
		@return $date
	*/
	public function isInWeekend(){
		return ($this->getDay('num') == 6 OR $this->getDay('num') == 7);
	}

}
?>