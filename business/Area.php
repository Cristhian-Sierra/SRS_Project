<?php
require_once ("persistence/AreaDAO.php");
require_once ("persistence/Connection.php");

class Area {
	private $idArea;
	private $name;
	private $areaDAO;
	private $connection;

	function getIdArea() {
		return $this -> idArea;
	}

	function setIdArea($pIdArea) {
		$this -> idArea = $pIdArea;
	}

	function getName() {
		return $this -> name;
	}

	function setName($pName) {
		$this -> name = $pName;
	}

	function Area($pIdArea = "", $pName = ""){
		$this -> idArea = $pIdArea;
		$this -> name = $pName;
		$this -> areaDAO = new AreaDAO($this -> idArea, $this -> name);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idArea = $result[0];
		$this -> name = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> selectAll());
		$areas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($areas, new Area($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $areas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> selectAllOrder($order, $dir));
		$areas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($areas, new Area($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $areas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> search($search));
		$areas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($areas, new Area($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $areas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function selectName(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaDAO -> selectName());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> name = $result[0];
	}


}
?>
