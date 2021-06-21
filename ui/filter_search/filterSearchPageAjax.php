<?php 
//$con=mysqli_connect('localhost','root','','srs');

$country=$_POST['country_filter'];
$area=$_POST['area_filter'];
$category=$_POST['category_filter'];
$quartile=$_POST['quartile_filter'];
$hindex=$_POST['hindex_filter'];
$references=$_POST['ref_filter'];
$sjr=$_POST['sjr_filter'];


?>

<!--class="table table-hover table-striped table-responsive-md"-->
<div class="container" >
	<div id="loadScreenJ" class="container">
		<img src="./img/load.gif" width="150px" height="150px" > 
	</div>
	<table class="table dt-responsive  table-dark " id="JournalTableS" >
		<thead >
			<tr>
				<th scope="col" >Rank</th>
				<th scope="col"> Title</th>
				<th scope="col"> Issn</th>
				<th scope="col">sjr</th>
				<th scope="col">Best_quartile</th>
				<th scope="col">H index</th>
				<th scope="col">Total documents</th>
				<th scope="col">Total references</th>
				<th scope="col">Total cites</th>
				<th scope="col">Cites per doc</th>
				<th scope="col">Coverage</th>
				<th scope="col" >All categories</th>
				<th scope="col">Country</th>
			</tr>
		</thead>
		<tbody>

			<?php
			//Select without filters
			
			if($area=="" && $country=="0"  && $quartile=="" ){
				$conn= new Connection();
				$con=$conn->openSRS();
				$journal=new JournalDAO();
				$sqlAll= $journal->selectWF($hindex,$references,$sjr);
				$resultAll=mysqli_query($con,$sqlAll);
				while ($ver=mysqli_fetch_row($resultAll)) {
					echo tableJ($ver[0],$ver[1],$ver[2],$ver[3],$ver[4],$ver[5],$ver[6],$ver[7],$ver[8],$ver[9],$ver[10],$ver[11],$ver[12]);
				}
				
						
			}

			if($area=="" && $category=="" && $quartile=="" ){
				$journal= new Journal();
				$selectCo= $journal->selectCo($country,$hindex,$references,$sjr);
				foreach($selectCo as $sCo) {
					echo tableJ($sCo->getIdJournal(),$sCo->getTitle(),$sCo->getIssn(),$sCo->getSjr(),$sCo->getBest_quartile(),$sCo->getHindex(),$sCo->getTotal_docs(),$sCo->getTotal_references(),$sCo->getTotal_cites(),$sCo->getCitable_docs(),$sCo->getCoverage(),$sCo-> getCategories(),$sCo-> getCountry()->getName());
				}

			}

			 if($country=="0"   && $quartile=="" && $category==""){
				$journal= new Journal();
				$selectAr= $journal->selectAr($area,$hindex,$references,$sjr);
				foreach($selectAr as $sA) {
					echo tableJ($sA->getIdJournal(),$sA->getTitle(),$sA->getIssn(),$sA->getSjr(),$sA->getBest_quartile(),$sA->getHindex(),$sA->getTotal_docs(),$sA->getTotal_references(),$sA->getTotal_cites(),$sA->getCitable_docs(),$sA->getCoverage(),$sA-> getCategories(),$sA->getCountry()->getName());
				}
			}

			 if($country=="0"  && $quartile==""  ){
				$journal= new Journal();
				$selectArCa= $journal->selectArCa($area,$category,$hindex,$references,$sjr);
				foreach($selectArCa as $sACa) {
					echo tableJ($sACa->getIdJournal(),$sACa->getTitle(),$sACa->getIssn(),$sACa->getSjr(),$sACa->getBest_quartile(),$sACa->getHindex(),$sACa->getTotal_docs(),$sACa->getTotal_references(),$sACa->getTotal_cites(),$sACa->getCitable_docs(),$sACa->getCoverage(),$sACa-> getCategories(),$sACa-> getCountry()->getName());
				}
						//echo $sqlCA;
			}	

			 if($area=="" && $country=="0" && $category=="" ){
				$journal= new Journal();
				$selectQ= $journal->selectQ($quartile,$hindex,$references,$sjr); 
				foreach($selectQ as $sQ) {
					echo tableJ($sQ->getIdJournal(),$sQ->getTitle(),$sQ->getIssn(),$sQ->getSjr(),$sQ->getBest_quartile(),$sQ->getHindex(),$sQ->getTotal_docs(),$sQ->getTotal_references(),$sQ->getTotal_cites(),$sQ->getCitable_docs(),$sQ->getCoverage(),$sQ-> getCategories(),$sQ-> getCountry()->getName());
				}
			}

			 if($quartile=="" ){
				$journal= new Journal();
				$selectACC= $journal->selectACC($area,$category,$country,$hindex,$references,$sjr); 
				foreach($selectACC as $sACC) {
					echo tableJ($sACC->getIdJournal(),$sACC->getTitle(),$sACC->getIssn(),$sACC->getSjr(),$sACC->getBest_quartile(),$sACC->getHindex(),$sACC->getTotal_docs(),$sACC->getTotal_references(),$sACC->getTotal_cites(),$sACC->getCitable_docs(),$sACC->getCoverage(),$sACC-> getCategories(),$sACC-> getCountry()->getName());
				}
			}

			if($quartile=="" && $category==""){
				$journal= new Journal();
				$selectACo= $journal->selectACo($area,$country,$hindex,$references,$sjr); 
				foreach($selectACo as $sACo) {
					echo tableJ($sACo->getIdJournal(),$sACo->getTitle(),$sACo->getIssn(),$sACo->getSjr(),$sACo->getBest_quartile(),$sACo->getHindex(),$sACo->getTotal_docs(),$sACo->getTotal_references(),$sACo->getTotal_cites(),$sACo->getCitable_docs(),$sACo->getCoverage(),$sACo-> getCategories(),$sACo-> getCountry()->getName());
				}
			}


			 if($category=="" ){
				$journal= new Journal();
				$selectACoQ= $journal->selectACoQ($area,$country,$quartile,$hindex,$references,$sjr); 
				foreach($selectACoQ as $sACoQ) {
					echo tableJ($sACoQ->getIdJournal(),$sACoQ->getTitle(),$sACoQ->getIssn(),$sACoQ->getSjr(),$sACoQ->getBest_quartile(),$sACoQ->getHindex(),$sACoQ->getTotal_docs(),$sACoQ->getTotal_references(),$sACoQ->getTotal_cites(),$sACoQ->getCitable_docs(),$sACoQ->getCoverage(),$sACoQ-> getCategories(),$sACoQ-> getCountry()->getName());
				}
			}

			if($country=="0" ){
				$journal= new Journal();
				$selectACaQ= $journal->selectACaQ($area,$category,$quartile,$hindex,$references,$sjr); 
				foreach($selectACaQ as $sACaQ) {
					echo tableJ($sACaQ->getIdJournal(),$sACaQ->getTitle(),$sACaQ->getIssn(),$sACaQ->getSjr(),$sACaQ->getBest_quartile(),$sACaQ->getHindex(),$sACaQ->getTotal_docs(),$sACaQ->getTotal_references(),$sACaQ->getTotal_cites(),$sACaQ->getCitable_docs(),$sACaQ->getCoverage(),$sACaQ-> getCategories(),$sACaQ-> getCountry()->getName());
				}
			}

			if($country=="0" && $category==""){
				$journal= new Journal();
				$selectAQ= $journal->selectAQ($area,$quartile,$hindex,$references,$sjr); 
				foreach($selectAQ as $sAQ) {
					echo tableJ($sAQ->getIdJournal(),$sAQ->getTitle(),$sAQ->getIssn(),$sAQ->getSjr(),$sAQ->getBest_quartile(),$sAQ->getHindex(),$sAQ->getTotal_docs(),$sAQ->getTotal_references(),$sAQ->getTotal_cites(),$sAQ->getCitable_docs(),$sAQ->getCoverage(),$sAQ-> getCategories(),$sAQ-> getCountry()->getName());
				}
			}

			 if($category=="" && $area==""){
				$journal= new Journal();
				$selectCoQ= $journal->selectCoQ($country,$quartile,$hindex,$references,$sjr);
				foreach($selectCoQ as $sCoQ) {
					echo tableJ($sCoQ->getIdJournal(),$sCoQ->getTitle(),$sCoQ->getIssn(),$sCoQ->getSjr(),$sCoQ->getBest_quartile(),$sCoQ->getHindex(),$sCoQ->getTotal_docs(),$sCoQ->getTotal_references(),$sCoQ->getTotal_cites(),$sCoQ->getCitable_docs(),$sCoQ->getCoverage(),$sCoQ-> getCategories(),$sCoQ-> getCountry()->getName());
				}

			}	

			else{
				$journal= new Journal();
				$selectF= $journal->selectAllF($area,$category,$country,$quartile,$hindex,$references,$sjr);
				foreach($selectF as $sF) {
					echo tableJ($sF->getIdJournal(),$sF->getTitle(),$sF->getIssn(),$sF->getSjr(),$sF->getBest_quartile(),$sF->getHindex(),$sF->getTotal_docs(),$sF->getTotal_references(),$sF->getTotal_cites(),$sF->getCitable_docs(),$sF->getCoverage(),$sF-> getCategories(),$sF-> getCountry()->getName());
				}
			}

			?>
		</tbody>
	</table>
</div>

<?php 

function tableJ($idJournal,$title,$issn,$sjr,$quartile,$hindex,$document,$refs,$cites,$citesdoc,$coverage,$category,$country){

	return 
	"<tr>	
	<td>".$idJournal."</td>
	<td>"."<a href='https://www.scimagojr.com/journalsearch.php?q=".$issn."' target='_blank' style='color: #DF691A;'> ".$title."</a>"."</td>
	<td>".$issn."</td>
	<td>".$sjr."</td>
	<td>".$quartile."</td>
	<td>".$hindex."</td>
	<td>".$document."</td>
	<td>".$refs."</td>
	<td>".$cites."</td>
	<td>".$citesdoc."</td>
	<td>".$coverage."</td>
	<td>".$category."</td>
	<td>".$country."</td>
	</tr>";


}

?>



<!--DATABLE JQUERY-->
<script type="text/javascript">
	$(document).ready( function () {
		var screen=$('#loadScreenJ');
		loadScreen(screen);
		$('#JournalTableS').DataTable({
			responsive: "true",
 					//dom: '<"top"Bf>irt<"bottom"lp><"clear">',
 					dom:'Bfrtip',
 					lengthMenu: [ [50, 500,-1],[50,500,"All"] ],
 					buttons: [
 					{

 						extend: 'pdfHtml5',
 						text: '<i class="fas fa-file-pdf">',
 						titleAttr: 'Dowload to PDF',
 						pageSize: 'LETTER',
  						pageOrientation: 'landscape',
 						image:'img/logo.png',
 						className:'btn btn-danger',
 						exportOptions: {
 							columns: [ 0, 1, 2, 3,4,5,7,11]
 						}
 					},
 					{
 						extend: 'excelHtml5',
 						text: '<i class="fas fa-file-excel">',
 						titleAttr: 'Dowload to xlsx',
 						className:'btn btn-success'
 					},
 					{
 						extend: 'csv',
 						text: '<i class="fas fa-file-csv">',
 						titleAttr: 'Dowload to CSV',
 						className:'btn btn-clear'
 					}


 					]

 				});

	});


</script>

<script >
	function loadScreen(screen){
		$(document)
		.ajaxStart(function(){
			screen.fadeIn();
		})
		.ajaxStop(function(){
			screen.fadeOut();
		});
	}
</script>