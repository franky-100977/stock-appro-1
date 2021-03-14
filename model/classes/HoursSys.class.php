<?php
/* One class to manage hour in application */

class HoursSys{
	protected $hours, $minutes, $seconds;

	public function __construct($hours = 0, $minutes = 0, $seconds = 0){
		if(is_string($hours) AND $minutes == 0 AND $seconds == 0){
			$this->setCompleteHour($hours);
		}else{
			$this->sethours($hours);
			$this->setMinutes($minutes);
			$this->setseconds($seconds);
		}
	}
	// GETTERS
	public function gethours(){return $this->hours;}
	public function getMinutes(){return $this->minutes;}
	public function getSeconds(){return $this->seconds;}
	//SETTERS
	public function sethours($hours){
		if(is_int($hours) AND $hours >= 0){
			$this->hours = $hours;
		}else{
			trigger_error("L'hours doit etre un entier strictement positif inférieur ou égal à 24", E_USER_WARNING);
		}
	}
	public function setMinutes($minutes){
		if(is_int($minutes) AND $minutes >= 0 AND $minutes <=59){
			$this->minutes = $minutes;
		}else{
			trigger_error("La minute doit etre un entier  positif inférieur ou égal à 59", E_USER_WARNING);
		}
	}
	public function setseconds($seconds){
		if(is_int($seconds) AND ($seconds < 59)){
			$this->seconds = $seconds;
		}else{
			trigger_error("La seconde doit etre un entier  positif inférieur ou égal à 59", E_USER_WARNING);
		}
	}
	// Autres fonctions
	public function setCompleteHour($hours){
		$elmts = explode(' H ', $hours);
		if(count($elmts) == 2){
			$this->sethours((int) $elmts[0]);
			$this->setMinutes((int) $elmts[1]);
			$this->setseconds(0);
		}else{
			trigger_error("hoursSys::setCompleteHour : L'hours' est incorrect: Format (hh H mm)", E_USER_WARNING);
		}
	}
	public function gethoursComplet(){ 
		$hours = "";
		if($this->hours < 10) 
			$hours .= "0".$this->hours;
		else 
			$hours .= $this->hours;
		$hours .= " H ";
		if($this->minutes < 10) 
			$hours .= "0".$this->minutes;
		else 
			$hours .= $this->minutes;
		if($this->seconds > 0){
			$hours .= " min ".$this->seconds." sec";
		}
		return $hours;

	}
	/*
		OPERATEURS
	*/
	public function plus(hoursSys $toAdd){
		$h = $this->hours + $toAdd->gethours();
		$m = $this->minutes + $toAdd->getMinutes();
		$s = $this->seconds + $toAdd->getSeconds();
		if($s > 59){ $m += (int) ($s/60); $s = $s%60;}
				if($m > 59){$h += (int) ($m/60);$m = $m%60;}
		$this->sethours($h);
		$this->setMinutes($m);
		$this->setseconds($s);
	}
	public function moins(hoursSys $toRemove){
		$h = $this->hours - $toRemove->gethours();
		$m = $this->minutes - $toRemove->getMinutes();
		$s = $this->seconds - $toRemove->getSeconds();
		if($h >= 0){
			if($m >= 0){
				if($s >= 0){
					if($s > 59){ $m += (int) ($s/60); $s = $s%60;}
					if($m > 59){$h += (int) ($m/60);$m = $m%60;}
				}else{
					if($m > 0){
						$m -= 1;
						$s = 60 - $toRemove->getSeconds() + $this->seconds;
					}else{
						trigger_error("L'hours à soustraire est plus grande",E_USER_WARNING);
					}
				}
			}else{
				if($h > 0){
					$h -= 1;
					$m = 60 - $toRemove->getMinutes() + $this->minutes;
				}else{
					trigger_error("L'hours à soustraire est plus grande",E_USER_WARNING);
				}
			}
		}else{
			trigger_error("L'hours à soustraire est plus grande", E_USER_WARNING);
		}
		$this->sethours($h);
		$this->setMinutes($m);
		$this->setseconds($s);
	}
}
?>