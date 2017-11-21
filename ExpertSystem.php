<?php

abstract class Month
{
    const January = 0;
    const February = 1;
    const March = 2;
    const April = 3;
    const May = 4;
    const June = 5;
    const July = 6;
    const August = 7;
    const September = 8;
    const October = 9;
    const November = 10;
    const December = 11;
    // etc.
}

abstract class Holiday
{
    const Tidak = 0;
    const TahunBaru = 1;
    const Sekolah = 2;
    // etc.
}

abstract class Tipe
{
    const AlatTulis = 0;
    const Baju = 1;
    const AlatMasak = 2;
    const Elektronik = 3;
    // etc.
}

abstract class Demand
{
    const Turun = 0;
    const Naik = 1;
    // etc.
}

abstract class Tren
{
    const Turun = 0;
    const Naik = 1;
    // etc.
}

abstract class Result
{
    const Turun = 0;
    const Naik = 1;
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

    public $theMonth = defineMonth();

    public $theCategory = defineCategory();

    public function defineMonth()
    {
        if(isset($_POST['selectMonth'])) {   
            $monthStr = $_POST['selectMonth'];

            if ($monthStr = "January") {
                return 0;
            }
            if ($monthStr = "February") {
                return 1;
            }
            if ($monthStr = "March") {
                return 2;
            }
            if ($monthStr = "April") {
                return 3;
            }
            if ($monthStr = "May") {
                return 4;
            }
            if ($monthStr = "June") {
                return 5;
            }
            if ($monthStr = "July") {
                return 6;
            }
            if ($monthStr = "August") {
                return 7;
            }
            if ($monthStr = "September") {
                return 8;
            }
            if ($monthStr = "October") {
                return 9;
            }
            if ($monthStr = "November") {
                return 10;
            }
            if ($monthStr = "December") {
                return 11;
            }

        }

    }

    public function defineCategory() {
        if(isset($_POST['selectCat'])) {   
            $catStr = $_POST['selectCat'];

            if ($catStr = "AlatTulis") {
                return 0;
            }
            if ($catStr = "Baju") {
                return 1;
            }
            if ($catStr = "AlatMasak") {
                return 2;
            }
            if ($catStr = "Elektronik") {
                return 3;
            }

        }
    }
	
	public function determine($month, $tipe, $pastSales, $lrRes, $logRes)
	{
		$this->workingMemory["month"] = $month;
		$this->workingMemory["tipe"] = $tipe;
		$this->workingMemory["pastSales"] = $pastSales;
		$this->workingMemory["linearResult"] = $lrRes;
		$this->workingMemory["logisticResult"] = $logRes;
		
		echo "y";
		
		// Initialize existing rules
		for ($i = 0; $i < 15; $i++){
			array_push($this->existingRules, $i);
		}

		do {
			echo "debug1";
			foreach($this->existingRules as $v){
				if ($this->precondition($v) != -999){
					array_push($this->markedRules, $v);
				}
				echo "debug2";
			}
			
			foreach($this->markedRules as $v){
				$this->fireRules($v);
				echo "YES:".$v;
			}
			
			echo "debug3";
			$this->existingRules = array_diff($this->existingRules, $this->markedRules); $this->existingRules = array_values($this->existingRules);
			$this->markedRules = [];
		} while ($this->result == null);
		
		return $this->result;
	}
	
	private function precondition($int){
		switch ($int) {
			case 0:
				if (array_key_exists("month", $this->workingMemory)) return 0;
				break;
			case 1:
				if (array_key_exists("month", $this->workingMemory)) return $int;
				break;
			case 2:
				if (array_key_exists("month", $this->workingMemory)) return $int;
				break;
			case 3:
				if (array_key_exists("holiday", $this->workingMemory)) return $int;
				break;
			case 4:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return $int;
				break;
			case 5:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return $int;
				break;
			case 6:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return $int;
				break;
			case 7:
				if (array_key_exists("holiday", $this->workingMemory) && array_key_exists("tipe", $this->workingMemory)) return $int;
				break;
			case 8:
				if (array_key_exists("linearResult", $this->workingMemory) && array_key_exists("pastSales", $this->workingMemory)) return $int;
				break;
			case 9:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)) return $int;
				break;
			case 10:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)) return $int;
				break;
			case 11:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)&& array_key_exists("logisticResult", $this->workingMemory)) return $int;
				break;
			case 12:
				if (array_key_exists("tren", $this->workingMemory) && array_key_exists("demand", $this->workingMemory)&& array_key_exists("logisticResult", $this->workingMemory)) return $int;
				break;
			default:
				return -999;
		}
	}
	
	private function fireRules($int){
		
		switch ($int) {
			case 0:
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
		}
	}
}