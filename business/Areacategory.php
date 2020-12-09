<?php 
require_once ("persistence/AreacategoryDAO.php");
require_once ("persistence/Connection.php");

//idCategory, area_idArea,nam

class Areacategory{
    
    private $AreaC;
    private $areacategoryDAO;
    private $connection;
    
    function Areacategory($AreaC=""){
        $this->AreaC= $AreaC;
    }
    
    
    function select(){
        $this -> connection = new Connection();
        $this -> connection -> open();
        $this-> areacategoryDAO = new AreacategoryDAO($this->$AreaC);
        $this -> connection -> run($this ->areacategoryDAO->select());
       // $result = $this -> connection -> fetchRow();
        $cadena="<label>Category List</label>";
        while ($result = $this -> connection -> fetchRow()){
          //  array_push($categorys, new Category("",$search));
            $cadena=$cadena.'<option value='.$result[0].'>'.utf8_encode($result[2]).'</option>';
        }
       
        $this -> conexion -> cerrar();
        return $cadena;
    }
    
 
    
   
    
    
   /* while ($ver=mysqli_fetch_row($result)) {
        $cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
    }*/
    
 //   echo  $cadena;
}




?>