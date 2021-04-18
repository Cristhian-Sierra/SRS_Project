<?php 
$con=mysqli_connect('localhost','root','','srs');
$area=$_POST['area_category'];

	$sql="SELECT ca.idCategory,
			 ca.area_idArea,ca.name 
		from category as ca, area as a
		where a.idArea=ca.area_idArea AND a.name='$area' ";

	$result=mysqli_query($con,$sql);

	$cadena="";
    if($area==""){
    	$cadena=$cadena.'<option>Category</option>';
    }
    else{
    	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value= "'.$ver[2].'">'.utf8_encode($ver[2]).'</option>';
	}

}
	echo  $cadena;

	

?>


<?php 
/*	
$areaC=$_POST['area_category'];
$category= new Category();
$cat= $category->datesC($areaC);


	$cadena="";
    if($areaC==""){
    	$cadena=$cadena.'<option>Category</option>';
    }
    else{
    	foreach ($cat as $ca) {

    	 	$cadena=$cadena.'<option value= "'.utf8_encode($ca->getName()).'">'.$ca->getName().'</option>';
    	 }  
		
	

}
	echo  $cadena;
*/

 ?>