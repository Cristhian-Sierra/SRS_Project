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
		return "insert into Category(name, area_idArea)
				values('" . $this -> name . "', '" . $this -> area . "')";
	}

	function update(){
		return "update Category set 
				name = '" . $this -> name . "',
				area_idArea = '" . $this -> area . "'	
				where idCategory = '" . $this -> idCategory . "'";
	}

	function select() {
		return "select idCategory, name, area_idArea
				from Category
				where idCategory = '" . $this -> idCategory . "'";
	}

	function selectAll() {
		return "select idCategory, name, area_idArea
				from Category";
	}

	function selectAllByArea() {
		return "select idCategory, name, area_idArea
				from Category
				where area_idArea = '" . $this -> area . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idCategory, name, area_idArea
				from Category
				order by " . $orden . " " . $dir;
	}

	function selectAllByAreaOrder($orden, $dir) {
		return "select idCategory, name, area_idArea
				from Category
				where area_idArea = '" . $this -> area . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCategory, name, area_idArea
				from Category
				where name like '%" . $search . "%'";
	}

	function searchCatA($search){
		return "select c.name from category as c,area as a  where c.area_idArea='".$search."' ";
		

	}

	function datesC($areaC){
		return "select ca.idCategory,
			 ca.area_idArea,ca.name 
		from category as ca, area as a
		where a.idArea=ca.area_idArea AND a.idArea='".$areaC."'"; 

	}
	
}
?>
