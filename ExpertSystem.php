<?php

abstract class Month
{
	const January = 1;
    const February = 2;
    const March = 3;
    const April = 4;
    const May = 5;
    const June = 6;
    const July = 7;
    const August = 8;
    const September = 9;
    const October = 10;
    const November = 11;
    const December = 12;
    // etc.
}

abstract class Holiday
{
    const TahunBaru = 1;
    const Sekolah = 2;
    const Tidak = 3;
    // etc.
}

abstract class Tipe
{
    const Baju = 1;
    const AlatMasak = 2;
    const Elektronik = 3;
    const AlatTulis = 4;
    // etc.
}

abstract class Demand
{
    const Turun = 1;
    const Naik = 2;
    // etc.
}

abstract class Tren
{
    const Turun = 1;
    const Naik = 2;
    // etc.
}

abstract class Result
{
    const Turun = 1;
    const Naik = 2;
    // etc.
}

Class ExpertSystem
{
	private $result = null;
	
	/* private $month;
	
	private $holiday;
	
	private $tipe;
	
	private $pastSales;
	
	private $tren; */	
	
	private $workingMemory = [];
	
	// array for set of unfired rules
	private $existingRules = [];
	
	// array of rules that will be fired. Only rules that satisfied workingMemory that enter this array
	private $markedRules = [];
	
	public function determine($month, $tipe, $pastSales, $lrRes, $logRes)
	{
		if ($month == 0 || $tipe == 0){
			throw new Exception("No Zero Value in Enumeration");
		}
		$this->workingMemory["month"] = $month;
		$this->workingMemory["tipe"] = $tipe;
		$this->workingMemory["pastSales"] = $pastSales;
		$this->workingMemory["linearResult"] = $lrRes;
		$this->workingMemory["logisticResult"] = $logRes;
		
		// Initialize existing rules
		for ($i = 1; $i <= 13; $i++){
			array_push($this->existingRules, $i);
		}
		
		$i=0;
		foreach($this->existingRules as $v){
			$p = $this->precondition($v);
			if ($p != -999 && $p != null){
				$this->markedRules[$i] = $this->precondition($v);
				$i++;
			}
		}
		
		foreach($this->markedRules as $v){
			$this->fireRules($v);
		}
		
		$this->existingRules = array_diff($this->existingRules, $this->markedRules); $this->existingRules = array_values($this->existingRules);
		$this->markedRules = [];
		

		do {
			$i=0;
			foreach($this->existingRules as $v){
				$p = $this->precondition($v);
				if ($p != -999 && $p != null){
					$this->markedRules[$i] = $this->precondition($v);
					$i++;
				}
			}
			
			foreach($this->markedRules as $v){
				$this->fireRules($v);
			}
			
			$this->existingRules = array_diff($this->existingRules, $this->markedRules); $this->existingRules = array_values($this->existingRules);
			$this->markedRules = [];
		} while ($this->result == null);
		
		return $this->result;
	}
	
	private function precondition($int){
		switch ($int) {
			case 13:
				if (array_key_exists("month", $this->workingMemory)) return 13;
				break;
			case 1:
				if (array_key_exists("month", $this->workingMemory)) return 1;
				break;
			case 2:
				if (array_key_exists("month", $this->workingMemory)) return 2;
				break;
			case 3:
				if (array_key_exists("holiday", $this->workingMemory)) return 3;
				break;
			case 4:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return 4;
				break;
			case 5:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return 5;
				break;
			case 6:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return 6;
				break;
			case 7:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return 7;
				break;
			case 8:
				if (array_key_exists("linearResult", $this->workingMemory) && array_key_exists("pastSales", $this->workingMemory)) return 8;
				break;
			case 9:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)) return 9;
				break;
			case 10:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)) return 10;
				break;
			case 11:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)&& array_key_exists("logisticResult", $this->workingMemory)) return 11;
				break;
			case 12:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)&& array_key_exists("logisticResult", $this->workingMemory)) return 12;
				break;
			default:
				return -999;
				break;
		}
	}
	
	private function fireRules($int){
		
		switch ($int) {
			case 13:
				if ($this->workingMemory["month"] == Month::January) $this->workingMemory["holiday"] = Holiday::TahunBaru;
				break;
			case 1:
				if ($this->workingMemory["month"] == Month::June || $this->workingMemory["month"] == Month::December) $this->workingMemory["holiday"] = Holiday::Sekolah;
				break;
			case 2:
				if ($this->workingMemory["month"] != Month::January && $this->workingMemory["month"] != Month::June && $this->workingMemory["month"] != Month::December) $this->workingMemory["holiday"] = Holiday::Tidak;
				break;
			case 3:
				if ($this->workingMemory["holiday"] == Holiday::TahunBaru) $this->workingMemory["demand"] = Demand::Naik;
				break;
			case 4:
				if ($this->workingMemory["holiday"] == Holiday::Sekolah && ($this->workingMemory["tipe"] == Tipe::AlatTulis || $this->workingMemory["tipe"] == Tipe::Baju)) $this->workingMemory["demand"] = Demand::Naik;
				break;
			case 5:
				if ($this->workingMemory["holiday"] == Holiday::Sekolah && ($this->workingMemory["tipe"] == Tipe::AlatMasak || $this->workingMemory["tipe"] == Tipe::Elektronik)) $this->workingMemory["demand"] = Demand::Turun;
				break;
			case 6:
				if ($this->workingMemory["holiday"] == Holiday::Tidak && ($this->workingMemory["tipe"] == Tipe::AlatMasak || $this->workingMemory["tipe"] == Tipe::Elektronik)) $this->workingMemory["demand"] = Demand::Naik;
				break;
			case 7:
				if ($this->workingMemory["holiday"] == Holiday::Tidak && ($this->workingMemory["tipe"] == Tipe::AlatTulis || $this->workingMemory["tipe"] == Tipe::Baju)) $this->workingMemory["demand"] = Demand::Turun;
				break;
			case 8:
				$this->workingMemory["tren"] = $this->workingMemory["linearResult"] <= $this->workingMemory["pastSales"] ? Tren::Turun : Tren::Naik;
				break;
			case 9:
				if ($this->workingMemory["tren"] == Tren::Turun && $this->workingMemory["demand"] == Demand::Turun) $this->result = Result::Turun;
				break;
			case 10:
				if ($this->workingMemory["tren"] == Tren::Naik && $this->workingMemory["demand"] == Demand::Naik) $this->result = Result::Naik;
				break;
			case 11:
				if ($this->workingMemory["tren"] == Tren::Turun && $this->workingMemory["demand"] == Demand::Naik)
				{
					$this->result = $this->workingMemory["logisticResult"] == Result::Naik ? Result::Naik : Result::Turun;
				}
				break;
			case 12:
				if ($this->workingMemory["tren"] == Tren::Naik && $this->workingMemory["demand"] == Demand::Turun)
				{
					$this->result = $this->workingMemory["logisticResult"] == Result::Naik ? Result::Naik : Result::Turun;
				}
				break;
			default:
				break;
		}
	}
	
	public function getResult(){
		return $this->result;
	}
}