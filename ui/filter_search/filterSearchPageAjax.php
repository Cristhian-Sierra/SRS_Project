<?php 
//$con=mysqli_connect('localhost','root','','srs');
$country=$_POST['country_filter'];
$area=$_POST['area_filter'];
$category=$_POST['category_filter'];
$quartile=$_POST['quartile_filter'];
$hindex=$_POST['hindex_filter'];
$references=$_POST['ref_filter'];
$sjr=$_POST['sjr_filter'];


$journal= new Journal();
$selectF= $journal->selectAllF($area,$category,$country,$quartile,$hindex,$references,$sjr);
$selectWF= $journal->selectWF($hindex,$references,$sjr);
$selectAr= $journal->selectAr($area,$hindex,$references,$sjr);
$selectArCa= $journal->selectArCa($area,$category,$hindex,$references,$sjr);
$selectCo= $journal->selectCo($country,$hindex,$references,$sjr);
$selectQ= $journal->selectQ($quartile,$hindex,$references,$sjr);
$selectACC= $journal->selectACC($area,$category,$country,$hindex,$references,$sjr);
$selectACo= $journal->selectACo($area,$country,$hindex,$references,$sjr);
$selectACoQ= $journal->selectACoQ($area,$country,$quartile,$hindex,$references,$sjr);
$selectACaQ= $journal->selectACaQ($area,$category,$quartile,$hindex,$references,$sjr);
$selectAQ= $journal->selectAQ($area,$quartile,$hindex,$references,$sjr);
$selectCoQ= $journal->selectCoQ($country,$quartile,$hindex,$references,$sjr);

     	
 
?>

	<!--class="table table-hover table-striped table-responsive-md"-->
		<div id="container">
			<table class="table dt-responsive  table-dark " id="JournalTableS">
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
			
					//echo $sqlF;
					
					if($area=="" && $country==""  && $quartile=="" ){
						foreach($selectWF as $swF) {
							echo tableJ($swF->getIdJournal(),$swF->getTitle(),$swF->getIssn(),$swF->getSjr(),$swF->getBest_quartile(),$swF->getHindex(),$swF->getTotal_docs(),$swF->getTotal_references(),$swF->getTotal_cites(),$swF->getCitable_docs(),$swF->getCoverage(),$swF-> getCategories(),$swF->getCountry()->getName());
						}
					//	echo ".";

					}

					else if($area=="" && $category=="" && $quartile=="" ){
							foreach($selectCo as $sCo) {
							echo tableJ($sCo->getIdJournal(),$sCo->getTitle(),$sCo->getIssn(),$sCo->getSjr(),$sCo->getBest_quartile(),$sCo->getHindex(),$sCo->getTotal_docs(),$sCo->getTotal_references(),$sCo->getTotal_cites(),$sCo->getCitable_docs(),$sCo->getCoverage(),$sCo-> getCategories(),$sCo-> getCountry()->getName());
						}

					}

					else if($country==""   && $quartile=="" && $category==""){
						foreach($selectAr as $sA) {
							echo tableJ($sA->getIdJournal(),$sA->getTitle(),$sA->getIssn(),$sA->getSjr(),$sA->getBest_quartile(),$sA->getHindex(),$sA->getTotal_docs(),$sA->getTotal_references(),$sA->getTotal_cites(),$sA->getCitable_docs(),$sA->getCoverage(),$sA-> getCategories(),$sA->getCountry()->getName());
						}
					}

					else if($country==""  && $quartile==""  ){
						foreach($selectArCa as $sACa) {
							echo tableJ($sACa->getIdJournal(),$sACa->getTitle(),$sACa->getIssn(),$sACa->getSjr(),$sACa->getBest_quartile(),$sACa->getHindex(),$sACa->getTotal_docs(),$sACa->getTotal_references(),$sACa->getTotal_cites(),$sACa->getCitable_docs(),$sACa->getCoverage(),$sACa-> getCategories(),$sACa-> getCountry()->getName());
						}
						//echo $sqlCA;
					}	

					else if($area=="" && $country=="" && $category=="" ){ 
						foreach($selectQ as $sQ) {
							echo tableJ($sQ->getIdJournal(),$sQ->getTitle(),$sQ->getIssn(),$sQ->getSjr(),$sQ->getBest_quartile(),$sQ->getHindex(),$sQ->getTotal_docs(),$sQ->getTotal_references(),$sQ->getTotal_cites(),$sQ->getCitable_docs(),$sQ->getCoverage(),$sQ-> getCategories(),$sQ-> getCountry()->getName());
						}
					}

					else if($quartile=="" ){ 
						foreach($selectACC as $sACC) {
							echo tableJ($sACC->getIdJournal(),$sACC->getTitle(),$sACC->getIssn(),$sACC->getSjr(),$sACC->getBest_quartile(),$sACC->getHindex(),$sACC->getTotal_docs(),$sACC->getTotal_references(),$sACC->getTotal_cites(),$sACC->getCitable_docs(),$sACC->getCoverage(),$sACC-> getCategories(),$sACC-> getCountry()->getName());
						}
					}

					 if($quartile=="" && $category==""){ 
						foreach($selectACo as $sACo) {
							echo tableJ($sACo->getIdJournal(),$sACo->getTitle(),$sACo->getIssn(),$sACo->getSjr(),$sACo->getBest_quartile(),$sACo->getHindex(),$sACo->getTotal_docs(),$sACo->getTotal_references(),$sACo->getTotal_cites(),$sACo->getCitable_docs(),$sACo->getCoverage(),$sACo-> getCategories(),$sACo-> getCountry()->getName());
						}
					}


					else if($category=="" ){ 
						foreach($selectACoQ as $sACoQ) {
							echo tableJ($sACoQ->getIdJournal(),$sACoQ->getTitle(),$sACoQ->getIssn(),$sACoQ->getSjr(),$sACoQ->getBest_quartile(),$sACoQ->getHindex(),$sACoQ->getTotal_docs(),$sACoQ->getTotal_references(),$sACoQ->getTotal_cites(),$sACoQ->getCitable_docs(),$sACoQ->getCoverage(),$sACoQ-> getCategories(),$sACoQ-> getCountry()->getName());
						}
					}

					else if($country=="" ){ 
						foreach($selectACaQ as $sACaQ) {
							echo tableJ($sACaQ->getIdJournal(),$sACaQ->getTitle(),$sACaQ->getIssn(),$sACaQ->getSjr(),$sACaQ->getBest_quartile(),$sACaQ->getHindex(),$sACaQ->getTotal_docs(),$sACaQ->getTotal_references(),$sACaQ->getTotal_cites(),$sACaQ->getCitable_docs(),$sACaQ->getCoverage(),$sACaQ-> getCategories(),$sACaQ-> getCountry()->getName());
						}
					}
						
					 if($country=="" && $category==""){ 
							foreach($selectAQ as $sAQ) {
							echo tableJ($sAQ->getIdJournal(),$sAQ->getTitle(),$sAQ->getIssn(),$sAQ->getSjr(),$sAQ->getBest_quartile(),$sAQ->getHindex(),$sAQ->getTotal_docs(),$sAQ->getTotal_references(),$sAQ->getTotal_cites(),$sAQ->getCitable_docs(),$sAQ->getCoverage(),$sAQ-> getCategories(),$sAQ-> getCountry()->getName());
						}
					}	
	

					else{

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