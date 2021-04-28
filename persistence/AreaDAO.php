<?php
class AreaDAO{
	private $idArea;
	private $name;

	function AreaDAO($pIdArea = "", $pName = ""){
		$this -> idArea = $pIdArea;
		$this -> name = $pName;
	}

	function insert(){
		return "insert into Area(name)
				values('" . $this -> name . "')";
	}

	function update(){
		return "update Area set 
				name = '" . $this -> name . "'	
				where idArea = '" . $this -> idArea . "'";
	}

	function select() {
		return "select idArea, name
				from Area
				where idArea = '" . $this -> idArea . "'";
	}

	function selectAll() {
		return "select idArea, name
				from Area";
	}

	function selectAllOrder($orden, $dir){
		return "select idArea, name
				from Area
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idArea, name
				from Area
				where name like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Area
				where idArea = '" . $this -> idArea . "'";
	}

	function selectName(){
		return "select name from Area";
	}
}
?>
