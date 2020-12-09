
<?php 
    require_once ('business/Area.php');
    require_once ('business/Areacategory.php');
    require_once ('business/Category.php');
    require_once ('business/Country.php');
    

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
    
    if(isset($_POST['AreaC'])){
        $AreaC=$_POST['AreaC'];
        $areaCat= new Areacategory($AreaC);
        $cadena = $areaCat ->select();
       
    }
   
   
  
?>

<div align="center">
	<?php include("ui/header.php"); ?>
</div>

<div class="container">
    <form action="index.php?pid=<?php echo base64_encode("ui/filterSearchPage.php") ?>" method="POST">
        <select  id ="areaList" name="areaList" >
                <?php 
                    $i=1;
                    foreach($areasF as $aF ){
                        ?>
                        <option value= "<?php echo $aF->getIdArea() ?>"> <?php echo $aF->getName() ?> </option >;                   
                    <?php     
                    }
                    ?>
        </select>  
       <select name="categoryList" id="categoryList">
       <?php  if(isset($_POST['AreaC'])){
            echo $cadena;
               
    }?>
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
            <option value="0">Quartile</option>
            <option value="1">Q1</option>
            <option value="2">Q2</option>
            <option value="3">Q3</option>
            <option value="4">Q4</option>
            <option value="5">Without quartile</option>
            
        </select>
        <select name="" id="">
            <option value="0">H index</option>
            <option value="1">0-200</option>
            <option value="2">201-400</option>
            <option value="3">401-600</option>
            <option value="4">601-801</option>
            <option value="5">800 or more</option>
        </select>

        <input type="submit" class="btn btn-dark" value="Search with filters">	
    </form>
  </div>
  
  <script type="text/javascript">
	$(document).ready(function(){
		$('#areaList').val(1);
		chargeList();

		$('#areaList').change(function(){
			chargeList();
		});
	})
</script>
<script type="text/javascript">
	function chargeList(){
		$.ajax({
			type:"POST",
			url:"index.php?pid=<?php echo base64_encode("ui/filterSearchPage.php") ?>",
			data:"AreaC=" + $('#areaList').val(),
			success:function(r){
				$('#categoryList').html(r);
			}
		});
	}
</script>

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