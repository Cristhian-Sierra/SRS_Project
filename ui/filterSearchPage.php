<?php 
    require_once ('./business/Filter_search.php');
    require_once ('./business/Area.php');
    require_once ('./business/Category.php');
    require_once ('./business/Country.php');
    

    $areaFilter= new Area();//Instance from business in the Area class
    $areasF=$areaFilter->selectAll();//Method that get all the dates from db table Area

    $categoryFilter= new Category();//Instance from business in the Category class
    $categorysF=$categoryFilter->selectAll();//Method that get all the dates from db table Category

    $countryFilter= new Country();//Instance from business in the Country class
    $countrysF=$countryFilter->selectAll();//Method that get all the dates from db table Country

    if(isset($_POST['area'])){
        $estado=$_POST['area'];
        echo $estado;
    }


?>

<div align="center">
	<?php include("ui/header.php"); ?>
</div>

<div class="container">
    <form action="index.php?pid=<?php echo base64_encode("ui/filterSearchPage.php") ?>" method="POST">
        <select name="area" >
            
                <?php 
                    $i=1;
                    foreach($areasF as $aF ){
                        ?>
                        <option value= "<?php echo $aF->getName() ?>"> <?php echo $aF->getName() ?> </option >;                   
                    <?php     
                    }
                    ?>
        </select>
        
        <select >
            
            <?php 
                $i=1;
                foreach($categorysF as $caF ){
                echo '<option  >' .$caF->getName().'</option >';
                $i++;}
            ?>
            
        </select>
        <select >
            
            <?php 
                $i=1;
                foreach($countrysF as $coF ){
                echo '<option  >' .$coF->getName().'</option >';
                $i++;}
            ?>
        </select>
        <select >
            
            <?php 
                echo '<option  >' .Q1.'</option >';
                echo '<option  >' .Q2.'</option >';
                echo '<option  >' .Q3.'</option >';
                echo '<option  >' .Q4.'</option >';
                
            ?>
            
        </select>
        <input type="submit" class="btn btn-dark" value="Search with filters">	
    </form>

  </div>


<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col"> Title</th>
            <th scope="col">issn</th>
            <th scope="col">sjr</th>
            <th scope="col">Best_quartile</th>
            <th scope="col">H index</th>
            <th scope="col">Total documents</th>
            <th scope="col">Total references</th>
            <th scope="col">Total cites</th>
            <th scope="col">Citable docs</th>
            <th scope="col">Country</th>
            <th scope="col">Coverage</th>
            <th scope="col">All categories</th>
            </tr>
        </thead>         
    </table>
</div>