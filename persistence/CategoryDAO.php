<?php
class CategoryDAO{
	private $idCategory;
	private $name;
	private $area;

	function CategoryDAO($pIdCategory = "", $pName = "", $pArea = ""){
		$this -> idCategory = $pIdCategory;
		$this -> name = $pName;
		$this -> area = $pArea;
	}

	function insert(){
		return "insert into category(name, area_idArea)
				values('" . $this -> name . "', '" . $this -> area . "')";
	}

	function update(){
		return "update category set 
				name = '" . $this -> name . "',
				area_idArea = '" . $this -> area . "'	
				where idCategory = '" . $this -> idCategory . "'";
	}

	function select() {
		return "select idCategory, name, area_idArea
				from category
				where idCategory = '" . $this -> idCategory . "'";
	}

	function selectName() {
		return "select name
				from category";
	}

	function selectAll() {
		return "select idCategory, name, area_idArea
				from category";
	}

	function selectAllByArea() {
		return "select idCategory, name, area_idArea
				from category
				where area_idArea = '" . $this -> area . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idCategory, name, area_idArea
				from category
				order by " . $orden . " " . $dir;
	}

	function selectAllByAreaOrder($orden, $dir) {
		return "select idCategory, name, area_idArea
				from category
				where area_idArea = '" . $this -> area . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCategory, name, area_idArea
				from category
				where name like '%" . $search . "%'";
	}

	

	function datesC($areaC){
		return "select ca.idCategory,ca.name 
		from category as ca, area as a
		where a.idArea=ca.area_idArea AND a.idArea='".$areaC."'"; 

	}
	
}
?>
