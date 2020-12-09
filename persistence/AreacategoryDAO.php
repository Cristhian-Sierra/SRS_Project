<?php
class AreacategoryDAO{
	private $AreaC;
	
	function AreacategoryDAO($AreaC){
	   $this->AreaC; 
	}

	function select() {
	  return  "SELECT idCategory, area_idArea,name from category
		where area_idArea='.$this->AreaC.'";
	}


}
?>
