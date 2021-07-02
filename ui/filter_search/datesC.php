
<?php 

$areaC=$_POST['area_category'];
$category= new Category();
$cat= $category->datesC($areaC);

$cadena='<option value="0"> All categories </option>';

foreach ($cat as $ca) {
    if ($areaC==$ca->getArea()->getIdArea()){
        $cadena=$cadena.'<option value="'.$ca->getIdCategory().'" selected> '.$ca->getName().'</option>';
    }
    else{     
        $cadena=$cadena.'<option value="'.$ca->getIdCategory().'"> '.$ca->getName().'</option>';
    }
}
echo  $cadena;
?>


