
<?php 

$areaC=$_POST['area_category'];
$category= new Category();
$cat= $category->datesC($areaC);
$cadena='<option value="0"> All categories </option>';
//$categV=$_POST['areas'];

foreach ($cat as $ca) {
    $cadena=$cadena.'<option value="'.$ca->getIdCategory().'"> '.$ca->getName().'</option>';
}
echo  $cadena;
?>


