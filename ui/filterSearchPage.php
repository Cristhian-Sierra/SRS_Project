
<?php 
    require_once ('business/Area.php');
    require_once ('business/Areacategory.php');
    require_once ('business/Category.php');
    require_once ('business/Country.php');
    require_once ('business/Filter_search.php');
    require_once ('business/Journal.php');
    

    $areaFilter= new Area();//Instance from business in the Area class
    $areasF=$areaFilter->selectAll();//Method that get all the dates from db table Area

    $categoryFilter= new Category();//Instance from business in the Category class
    $categoriesF=$categoryFilter->selectAll();//Method that get all the dates from db table Category

    $countryFilter= new Country();//Instance from business in the Country class
    $countrysF=$countryFilter->selectAll();//Method that get all the dates from db table Country
    

    $journalFilter = new Journal();
    $journalsF= $journalFilter->selectAll();
    
   

    /*$AreaC="";
    if(isset($_POST["AreaC"])){ //Conditinal to determinate the category list
        $AreaC=$_POST["AreaC"];
        $areaCat= new Areacategory($AreaC);
        $cadena = $areaCat ->select();
        echo $cadena;
       
    }*/

    //date_default_timezone_set('UTC');
    date_default_timezone_set("America/Bogota");
    $date = date("Y-m-d");
    $time = date("H:i a");

   
     $area="";
    if(isset($_POST["areas"])){
        $area=$_POST["areas"];

    }

    $category="";
    if(isset($_POST["categories"])){
        $category=$_POST["categories"];
    }

    $country="";
    if(isset($_POST["countries"])){
        $country=$_POST["countries"];
        
    }      

    $hindex="";
    if(isset($_POST["Action"])){    //This conditional is of the button that makes insert in the db
        //$hindex=$_POST["hindex"];
        
        switch($_POST["hindex"])//Switch case from hindex select
        {
            case 1:
                $hindex = 0;
                break;
            case 2:
                $hindex = 201 ;
                break;
            case 3:
                $hindex =401 ;
                break;
            case 4:
                $hindex =601;
                break;
            case 5:
                $hindex =801;
                break;
            default:
               
                break;
        }

        $sjr="";
        switch($_POST["sjr"]) //Switch case from sjr select
        {
            case 1:
                $sjr = 1;
                break;
            case 2:
                $sjr = 21;
                break;
            case 3:
                $sjr =41 ;
                break;
            case 4:
                $sjr =61;
                break;
            case 5:
                $sjr =81;
                break;
            default:
               
                break;
        }

        $references="";
        switch($_POST["references"]) //Switch case from references select
        {
            case 1:
                $references = 0;
                break;
            case 2:
                $references = 2001;
                break;
            case 3:
                $references =10001 ;
                break;
            case 4:
                $references =100001;
                break;
            case 5:
                $references =500001 ;
                break;
            default:
               
                break;
        }

        $quartile="";
        switch($_POST["quartile"]) //Switch case from quartile select
        {
            case 1:
                $quartile = "Q1";
                break;
            case 2:
                $quartile = "Q2";
                break;
            case 3:
                $quartile ="Q3";
                break;
            default:
                
                break;
        }

        $filterSClass = new Filter_search("",$date,$time,$hindex,$references,$country,$category,$area,$quartile,$sjr);
        $filterSClass->insert();
     
        $filterResult= new Filter_search("","","",$hindex,$references,$country,$category,$area,$quartile,$sjr);
        $filterR= $filterResult->selectF();
        foreach ($filterR as $fR) {
            echo "Uno".$fR->getHindex_filter();
        }
        
    }

//This is for pagination 
    
    $quantity = 900;
    if(isset($_GET["quantity"])){
    	$quantity = $_GET["quantity"];
    }
    $page = 1;
    if(isset($_GET["page"])){
    	$page = $_GET["page"];
    }
    $journalsP = $journalFilter -> searchPage($quantity, $page);
    $journalsR = $journalFilter -> searchQuantity();
    $totalPages = intval($journalsR/$quantity);
    if($journalsR%$quantity != 0){
    	$totalPages++;
    }
    $lastPage = ($totalPages == $page); 
?>

<div align="center">
	<?php include("ui/header.php"); ?>
</div>

<div class="container" >
	<form action="index.php?pid=<?php echo base64_encode("ui/filterSearchPage.php") ?>" method="POST">
        <select name="areas" id="areas" required>
            <option  value="" > Area</option >
            <?php 
            $i=1;
            foreach($areasF as $aF ){?>
                <option value= "<?php echo $aF->getIdArea() ?>"> <?php echo $aF->getName() ?> </option >;
                <?php
                $i++;}
                ?>
        </select>

         <!--<select name="categories" id="categories" required>
            <option  value="">Category</option >;
            <?php 
            /*$i=1;
            foreach($categoriesF as $cF ){
                echo "<option>" . utf8_encode($cF->getName())."</option >";
                $i++;}*/
                ?>
        </select>-->

        <select name="categories" id="categories" required="">
            <option  value="">Category</option >
        </select>

		<select  name="countries" id="countries"required>
			<option  value=""> Country</option >;
			<?php 
			$i=1;
			foreach($countrysF as $coF ){
				echo "<option  >" . utf8_encode($coF->getName())."</option >";
				$i++;}
				?>
		</select>

		<select  name="quartile" id="quartile" required>
            <option value="">Quartile</option>
            <option value="1">Q1</option>
            <option value="2">Q2</option>
            <option value="3">Q3</option>
          
        </select>
		            
		<select name="hindex" id="hindex" required>
			<option value="">H index</option>
			<option value="1">0-200</option>
			<option value="2">201-400</option>
			<option value="3">401-600</option>
			<option value="4">601-800</option>
			<option value="5">801 or more</option>
		</select>

		<select name="sjr" id="sjr" required>
			<option value="">SJR</option>
			<option value="1">1-20</option>
			<option value="2">21-40</option>
			<option value="3">41-60</option>
			<option value="4">61-80</option>
			<option value="5">80 or more</option>
		</select>

		<select  name="references" id="references" required>
			<option value="">References</option>
			<option value="1">0-1000</option>
			<option value="2">1001-10000</option>
			<option value="3">10001-100000</option>
			<option value="4">100001-500000</option>
			<option value="5">500001 or more</option>
		</select>
		<br> <br>
		<div class="form-group">
			<input type="submit" class="btn btn-dark" value="Search with filters" name="Action">	
		</div>        
	</form>    
  </div>
<script type="text/javascript">
    $(document).ready(function(){
       // $('#areas').val(1);
        chargeList();

        $('#areas').change(function(){
            chargeList();
        });
    })
</script>
<script type="text/javascript">
    function chargeList(){
        $.ajax({
            type:"POST",
            url:"index.php?pid=<?php echo base64_encode("ui/datesC.php") ?>",
            data:"area_category=" + $('#areas').val(),
            success:function(r){
                $('#categories').html(r);
            }
        });
    }
</script>

<div class="container"><!-- Pagination div-->
	<div class="row"> 
		<div class="col-md-9"></div>
		<div class="col-md-3">
		    <nav aria-label="Page navigation Journals">
		    	<ul class="pagination">
		            <li class="page-item <?php echo ($page==1)?"disabled": ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("ui/filterSearchPage.php") . "&page=" . ($page-1) . "&quantity=" . $quantity ?>"> &lt;&lt; </a></li>
		            <?php 
		            for($i=1; $i<=$totalPages; $i++){
		            	if($i==$page){
		            		echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
		            	}else{
		            		echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("ui/filterSearchPage.php") . "&page=" . $i . "&quantity=" . $quantity . "'>" . $i . "</a></li>";
		            	}        						            						    
		            }        						
		            ?>
		            <li class="page-item <?php echo ($lastPage)?"disabled": ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("ui/filterSearchPage.php") . "&page=" . ($page+1) . "&quantity=" . $quantity ?>"> &gt;&gt; </a></li>
		        </ul>
		    </nav>
            <select id="quantity" >
                <option value="900" <?php echo ($quantity==900)?"selected":"" ?>>900</option>
                <option value="1800" <?php echo ($quantity==1800)?"selected":"" ?>>1800</option>
                <option value="2700" <?php echo ($quantity==2700)?"selected":"" ?>>2700</option>
                <option value="4000" <?php echo ($quantity==4000)?"selected":"" ?>>4000</option>
            </select> 
		</div>
		    
    </div>
     
     <!--Table's Structure-->
     <div class="text-right">Searchs <?php echo (($page-1)*$quantity+1) ?> to <?php echo (($page-1)*$quantity)+count($journalsP) ?> of <?php echo $journalsR ?> registers searched</div>
    <table class="table table-hover table-striped table-responsive-md">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col"> Title</th>
            <th scope="col"> Issn</th>
            <th scope="col">sjr</th>
            <th scope="col">Best_quartile</th>
            <th scope="col">H index</th>
            <th scope="col">Total documents</th>
            <th scope="col">Total references</th>
            <th scope="col">Total cites</th>
            <th scope="col">Coverage</th>
            <th scope="col">All categories</th>
            <th scope="col">Country</th>
            </tr>
        </thead>
        <tbody>
        <?php 
	    $i=1;
		foreach($journalsP as $jP){
            echo "<tr>";
            echo "<td>" . $jP->getIdJournal() . "</td>";
            echo "<td>" . $jP ->  getTitle() . "</td>";
            echo "<td>" . $jP ->  getIssn() . "</td>";
            echo "<td>" . $jP  -> getSjr() . "</td>";
            echo "<td>" . $jP  -> getBest_quartile() . "</td>";
            echo "<td>" . $jP  -> getHindex(). "</td>";
            echo "<td>" . $jP  ->  getTotal_docs() . "</td>";
            echo "<td>" . $jP  ->  getTotal_references() . "</td>";
            echo "<td>" . $jP  ->  getTotal_cites() . "</td>";
            echo "<td>" . $jP  ->  getCoverage() . "</td>";
            echo "<td>" . $jP  -> getCategories(). "</td>";
            echo "<td>" . $jP  -> getCountry(). "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
        </tbody>
                                   
    </table>
</div>

<script>
    $("#quantity").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("ui/filterSearchPage.php") ?>&quantity=" + $(this).val();     
        location.replace(url);
    });
</script>


