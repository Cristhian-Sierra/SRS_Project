<?php
class AreaDAO{
	private $idArea;
	private $name;

	function AreaDAO($pIdArea = "", $pName = ""){
		$this -> idArea = $pIdArea;
		$this -> name = $pName;
	}

	function insert(){
		return "insert into area(name)
				values('" . $this -> name . "')";
	}

	function update(){
		return "update area set 
				name = '" . $this -> name . "'	
				where idArea = '" . $this -> idArea . "'";
	}

	function select() {
		return "select idArea, name
				from area
				where idArea = '" . $this -> idArea . "'";
	}

	function selectAll() {
		return "select idArea, name
				from area";
	}

	function selectAllOrder($orden, $dir){
		return "select idArea, name
				from area
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idArea, name
				from area
				where name like '%" . $search . "%'";
	}

	function delete(){
		return "delete from area
				where idArea = '" . $this -> idArea . "'";
	}

	function selectName(){
		return "select name from area";
	}
}
?>
