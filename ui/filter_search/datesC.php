
<?php 

$areaC=$_POST['area_category'];
$category= new Category();
$cat= $category->datesC($areaC);

$cadena='<option value="0"> All categories </option>';

   foreach ($cat as $ca) {
    	$cadena=$cadena.'<option value="'.$ca->getIdCategory().'"> '.$ca->getName().'</option>';
 	}
echo  $cadena;
?>





 <?php 
/*$con=mysqli_connect('localhost','root','','srs');
$area=$_POST['area_category'];

$sql="select ca.idCategory, ca.area_idArea,ca.name from category as ca,area as a where ca.area_idArea=a.idArea AND a.idArea='$area'";

$result=mysqli_query($con,$sql);


$cadena='<option value="">All categories</option>';
$cadena1='<option>All categories</option>';

if($area==""){

    $cadena=$cadena;
}
else{
    while ($ver=mysqli_fetch_row($result)) {
        $cadena=$cadena.'<option value= "'.$ver[0].'">'.utf8_encode($ver[2]).'</option>';


    }


}

echo  $cadena;


*/
?>