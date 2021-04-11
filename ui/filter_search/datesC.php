<?php 
$con=mysqli_connect('localhost','root','','srs');
$area=$_POST['area_category'];

	$sql="SELECT idCategory,
			 area_idArea,name 
		from category
		where area_idArea='$area'";

	$result=mysqli_query($con,$sql);

	$cadena="";
    if($area==""){
    	$cadena=$cadena.'<option>Category</option>';
    }
    else{
    	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

}
	echo  $cadena;
	


	

?>