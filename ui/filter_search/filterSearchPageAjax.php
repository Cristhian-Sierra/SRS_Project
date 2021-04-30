<?php 
$con=mysqli_connect('localhost','root','','srs');
$country=$_POST['country_filter'];
$area=$_POST['area_filter'];
$category=$_POST['category_filter'];
$quartile=$_POST['quartile_filter'];
$hindex=$_POST['hindex_filter'];
$references=$_POST['ref_filter'];
$sjr=$_POST['sjr_filter'];
  
			//Selcet with all filters
$sqlF="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country') AND (ca.idCategory='$category') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') AND (j.best_quartile='$quartile') order by j.idJournal";


        //Select without filters
$sqlAll="SELECT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co WHERE co.idCountry=j.country_IdCountry AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr')  order by j.idJournal";

        //Select with area
$sqlA="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";


        //Select with area and category filter
$sqlCA="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (ca.idCategory='$category') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

        //Select with country filter
$sqlCountry=" SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, 
j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country 
FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc 
WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) 
AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) 
AND (co.idCountry='$country') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

        //Select with quartile filter
$sqlQ="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.citable_docs,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (j.best_quartile='$quartile') AND (j.hindex>='$sjr') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

        //select with area, category, country
$sqlACC="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country') AND (ca.idCategory='$category') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

         //select with area, country
$sqlACo="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country')  AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr')";

         //select with area, country,quartile
$sqlACoQ="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country')  AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

//select area,category, quartile
$sqlACaQ="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (ca.idCategory='$category') AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

//select area, quartile
$sqlAQ="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

//select with country. quartile
$sqlCoQu="SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (co.idCountry='$country') AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

        	
 
?>

	<!--class="table table-hover table-striped table-responsive-md"-->
		<div id="container">
			<table class="table dt-responsive  table-dark "  id="JournalTableS">
				<thead  class="thead-dark">
					<tr>
						<th scope="col">Rank</th>
						<th scope="col"> Title</th>
						<th scope="col"> Issn</th>
						<th scope="col">sjr</th>
						<th scope="col">Best_quartile</th>
						<th scope="col">H index</th>
						<th scope="col">Total documents</th>
						<th scope="col">Total references</th>
						<th scope="col">Total cites</th>
						<th scope="col">Coverage</th>
						<th scope="col" >All categories</th>
						<th scope="col">Country</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$resultF=mysqli_query($con,$sqlF);
					$resultA=mysqli_query($con,$sqlA);
					$resultCA=mysqli_query($con,$sqlCA);
					$resultCountry=mysqli_query($con,$sqlCountry);
					$resultQ=mysqli_query($con,$sqlQ);
					$resultACC=mysqli_query($con,$sqlACC);
					$resultAll=mysqli_query($con,$sqlAll);
					$resultAreaCo=mysqli_query($con,$sqlACo);
					$resultACoQ=mysqli_query($con,$sqlACoQ);
					$resultACaQ=mysqli_query($con,$sqlACaQ);
					$resultAQ=mysqli_query($con,$sqlAQ);




					//echo $sqlF;
					
					if($area=="" && $country==""  && $quartile=="" ){
						while ($ver=mysqli_fetch_row($resultAll)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					//	echo ".";

					}

					else if($area=="" && $category=="" && $quartile=="" ){
						while ($ver=mysqli_fetch_row($resultCountry)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}

					}

					else if($country==""   && $quartile=="" && $category==""){
						while ($ver=mysqli_fetch_row($resultA)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}

					else if($country==""  && $quartile=="" ){
						while ($ver=mysqli_fetch_row($resultCA)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
						//echo $sqlCA;
					}	

					else if($area=="" && $country=="" && $category=="" ){ 
						while ($ver=mysqli_fetch_row($resultQ)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}

					else if($quartile=="" ){ 
						while ($ver=mysqli_fetch_row($resultACC)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}

					 if($quartile=="" && $category==""){ 
						while ($ver=mysqli_fetch_row($resultAreaCo)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}


					else if($category=="" ){ 
						while ($ver=mysqli_fetch_row($resultACoQ)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}

					else if($country=="" ){ 
						while ($ver=mysqli_fetch_row($resultACaQ)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}
						
					 if($country=="" && $category==""){ 
						while ($ver=mysqli_fetch_row($resultAQ)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}
					}	
	

					else{

						while ($ver=mysqli_fetch_row($resultF)) {
							echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11]);
						}	
					}

					?>
				</tbody>
			</table>
		</div>

<?php 

	function tableJ($idJournal,$title,$issn,$sjr,$quartile,$hindex,$document,$refs,$cites,$coverage,$category,$country){

		return 
		"<tr>	
		<td>".$idJournal."</td>
		<td>"."<a href='https://www.scimagojr.com/journalsearch.php?q=".$issn."' target='_blank'>".$title."</a>"."</td>
		<td>".$issn."</td>
		<td>".$sjr."</td>
		<td>".$quartile."</td>
		<td>".$hindex."</td>
		<td>".$document."</td>
		<td>".$refs."</td>
		<td>".$cites."</td>
		<td>".$coverage."</td>
		<td>".$category."</td>
		<td>".$country."</td>
		</tr>";

		
	}

 ?>

 <!--DATABLE JQUERY-->
 <script type="text/javascript">
 	$(document).ready( function () {
 		var tbl = $('#JournalTableS');
		var settings={};
 		$('#JournalTableS').DataTable({
 					responsive: "true",
					dom:'Bfrtlip',
					lengthMenu: [ [50, 500,-1],[50,500,"All"] ],
					buttons: [
					{
						extend: 'pdfHtml5',
						text: '<i class="fas fa-file-pdf">',
						titleAttr: 'Export to PDF',
						className:'btn btn-danger',
						exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,7,11]
                    }
					}
					]
				});
 		
 	});


 </script>

	


<?php
/*$quartile=$_POST['quartile_filter'];
$hindex=$_POST['hindex_filter'];
$references=$_POST['references_filter'];
$sjr=$_POST['sjr_filter'];


 $hindexRangeArr="";
 $orderSQL="";
 $hindexRangeSQL="";

        $hindexRangeArr = explode('-', $hindex);
       // $hindexRangeSQL = "j.hindex BETWEEN '".$hindexRangeArr[0]."' AND '".$hindexRangeArr[1]."'";
        $orderSQL = "ORDER BY j.hindex DESC";
*/  

?>