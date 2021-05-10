<?php
require_once ("persistence/CategoryDAO.php");
require_once ("persistence/Connection.php");

class Category {
	private $idCategory;
	private $name;
	private $area;
	private $categoryDAO;
	private $connection;

	function getIdCategory() {
		return $this -> idCategory;
	}

	function setIdCategory($pIdCategory) {
		$this -> idCategory = $pIdCategory;
	}

	function getName() {
		return $this -> name;
	}

	function setName($pName) {
		$this -> name = $pName;
	}

	function getArea() {
		return $this -> area;
	}

	function setArea($pArea) {
		$this -> area = $pArea;
	}

	function Category($pIdCategory = "", $pName = "", $pArea = ""){
		$this -> idCategory = $pIdCategory;
		$this -> name = $pName;
		$this -> area = $pArea;
		$this -> categoryDAO = new CategoryDAO($this -> idCategory, $this -> name, $this -> area);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCategory = $result[0];
		$this -> name = $result[1];
		$area = new Area($result[2]);
		$area -> select();
		$this -> area = $area;
	}
		function selectName(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> selectName());
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($categorys, new Category($result[0]));
		}
		$this -> connection -> close();
		return $categorys;
	}


	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> selectAll());
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$area = new Area($result[2]);
			$area -> select();
			array_push($categorys, new Category($result[0], $result[1], $area));
		}
		$this -> connection -> close();
		return $categorys;
	}

	function selectAllByArea(){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> selectAllByArea());
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$area = new Area($result[2]);
			$area -> select();
			array_push($categorys, new Category($result[0], $result[1], $area));
		}
		$this -> connection -> close();
		return $categorys;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> selectAllOrder($order, $dir));
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$area = new Area($result[2]);
			$area -> select();
			array_push($categorys, new Category($result[0], $result[1], $area));
		}
		$this -> connection -> close();
		return $categorys;
	}

	function selectAllByAreaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> selectAllByAreaOrder($order, $dir));
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$area = new Area($result[2]);
			$area -> select();
			array_push($categorys, new Category($result[0], $result[1], $area));
		}
		$this -> connection -> close();
		return $categorys;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> search($search));
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$area = new Area($result[2]);
			$area -> select();
			array_push($categorys, new Category($result[0], $result[1], $area));
		}
		$this -> connection -> close();
		return $categorys;
	}


		function datesC($pArea){
		$this -> connection -> open();
		$this -> connection -> run($this -> categoryDAO -> datesC($pArea));
		$categorys = array();
		while ($result = $this -> connection -> fetchRow()){
			$area = new Area($result[2]);
			$area -> select();
			array_push($categorys, new Category($result[0], $result[1], $area));
		}
		$this -> connection -> close();
		return $categorys;
	}

}
?>
