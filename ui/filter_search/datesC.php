<?php 
$con=mysqli_connect('localhost','root','','srs');
$area=$_POST['area_category'];

$sql="select ca.idCategory, ca.area_idArea,ca.name from category as ca,area as a where ca.area_idArea=a.idArea AND a.idArea='$area'";

$result=mysqli_query($con,$sql);

$cadena="";

$cadena=$cadena.'<option value="">Category</option>';


while ($ver=mysqli_fetch_row($result)) {
	$cadena=$cadena.'<option value= "'.$ver[0].'">'.utf8_encode($ver[2]).'</option>';
	

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