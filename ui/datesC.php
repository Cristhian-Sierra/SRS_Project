<?php 
$conexion=mysqli_connect('localhost','root','','srs');
$areaC=$_POST['area'];

	$sql="SELECT idCategory, area_idArea,name from category 
		where area_idArea='$areaC'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label>Category List</label>"; 
			

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena;
	

?>