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

Class ExpertSystem
{
	private $result = null;
	
	
	public function getMonth(){
		$today = Month::January;
		echo $today;
	}
	
	public function getResult(){
		echo $this->result;
	}
}