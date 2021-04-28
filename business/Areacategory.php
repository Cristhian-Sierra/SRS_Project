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
        //$cadena="<select id='categories' name='categories'> </select>";
        while ($result = $this -> connection -> fetchRow()){
          //  array_push($categorys, new Category("",$search));
        
            $cadena=$cadena."<option value=".$result[0].">".$result[2]."</option>";
        }
       
        $this -> conection -> close();
        return $cadena;
    }
    
 
}




?>