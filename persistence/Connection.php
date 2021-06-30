<?php
class Connection {
	private $mysqli;
	private $result;

	/**
	 * Open the conection 
	 */ 
	function open(){
		$this -> mysqli = new mysqli("localhost" ,"itiud_srs", 'C76Lae2sC*', "itiud_srs");
		//$this -> mysqli = new mysqli("localhost" ,"root", "", "srs");
		$this -> mysqli -> set_charset("utf8");
	}

	function openSRS(){
		return mysqli_connect("localhost", "itiud_srs", "C76Lae2sC*", "itiud_srs");
		//return mysqli_connect("localhost", "root", "", "srs");
	}
	function lastId(){
		return $this -> mysqli -> insert_id;
	}

	function run($query){
		$this -> result = $this -> mysqli -> query($query);
	}

	function close(){
		$this -> mysqli -> close();
	}

	function numRows(){
		return ($this -> result != null)?$this -> result -> num_rows : 0;
	}

	function fetchRow(){
		return $this -> result -> fetch_row();
	}

	function querySuccess(){
		return $this -> result === TRUE;
	}
}
?>
