
<?php 
$cadena ="";

if(isset($_POST["category"])){
    $areaC=$_POST['area_category'];
    $category= new Category((int)$_POST["category"]);
    $cat= $category->datesC($areaC);
    $cadena='<option value="0" selected> "'.$_POST["category"].'" </option>';
    
    
    foreach ($cat as $ca) {
        if ($ca->getIdCategory()==$valorCa){
            $cadena=$cadena.'<option value="'.$ca->getIdCategory().'" selected> '.$ca->getName().'</option>';
        }
        else{
            $cadena=$cadena.'<option value="'.$ca->getIdCategory().'"> '.$ca->getName().'</option>';
        }
        
    }

}else{
    $areaC=$_POST['area_category'];
    $category= new Category();
    $cat= $category->datesC($areaC);
    $cadena='<option value="0"> All categories </option>';
    
    
    foreach ($cat as $ca) {
        if ($ca->getIdCategory()==$valorCa){
            $cadena=$cadena.'<option value="'.$ca->getIdCategory().'" selected> '.$ca->getName().'</option>';
        }
        else{
            $cadena=$cadena.'<option value="'.$ca->getIdCategory().'"> '.$ca->getName().'</option>';
        }
        
    }


}

echo  $cadena;
?>


