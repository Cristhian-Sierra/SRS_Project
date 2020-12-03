<?php
$processed=false;
$idJournal = $_GET['idJournal'];
$updateJournal = new Journal($idJournal);
$updateJournal -> select();
$title="";
if(isset($_POST['title'])){
	$title=$_POST['title'];
}
$issn="";
if(isset($_POST['issn'])){
	$issn=$_POST['issn'];
}
$sjr="";
if(isset($_POST['sjr'])){
	$sjr=$_POST['sjr'];
}
$best_quartile="";
if(isset($_POST['best_quartile'])){
	$best_quartile=$_POST['best_quartile'];
}
$hindex="";
if(isset($_POST['hindex'])){
	$hindex=$_POST['hindex'];
}
$total_docs="";
if(isset($_POST['total_docs'])){
	$total_docs=$_POST['total_docs'];
}
$total_references="";
if(isset($_POST['total_references'])){
	$total_references=$_POST['total_references'];
}
$total_cites="";
if(isset($_POST['total_cites'])){
	$total_cites=$_POST['total_cites'];
}
$citable_docs="";
if(isset($_POST['citable_docs'])){
	$citable_docs=$_POST['citable_docs'];
}
$coverage="";
if(isset($_POST['coverage'])){
	$coverage=$_POST['coverage'];
}
$categories="";
if(isset($_POST['categories'])){
	$categories=$_POST['categories'];
}
$country="";
if(isset($_POST['country'])){
	$country=$_POST['country'];
}
if(isset($_POST['update'])){
	$updateJournal = new Journal($idJournal, $title, $issn, $sjr, $best_quartile, $hindex, $total_docs, $total_references, $total_cites, $citable_docs, $coverage, $categories, $country);
	$updateJournal -> update();
	$updateJournal -> select();
	$objCountry = new Country($country);
	$objCountry -> select();
	$nameCountry = $objCountry -> getName() ;
	$user_ip = getenv('REMOTE_ADDR');
	$agent = $_SERVER["HTTP_USER_AGENT"];
	$browser = "-";
	if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
		$browser = "Internet Explorer";
	} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Chrome";
	} else if (preg_match('/Edge\/\d+/', $agent) ) {
		$browser = "Edge";
	} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Firefox";
	} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Opera";
	} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Safari";
	}
	if($_SESSION['entity'] == 'Administrator'){
		$logAdministrator = new LogAdministrator("","Edit Journal", "Title: " . $title . "; Issn: " . $issn . "; Sjr: " . $sjr . "; Best_quartile: " . $best_quartile . "; Hindex: " . $hindex . "; Total_docs: " . $total_docs . "; Total_references: " . $total_references . "; Total_cites: " . $total_cites . "; Citable_docs: " . $citable_docs . "; Coverage: " . $coverage . "; Categories: " . $categories . "; Country: " . $nameCountry , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Edit Journal</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/journal/updateJournal.php") . "&idJournal=" . $idJournal ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Title*</label>
							<input type="text" class="form-control" name="title" value="<?php echo $updateJournal -> getTitle() ?>" required />
						</div>
						<div class="form-group">
							<label>Issn*</label>
							<input type="text" class="form-control" name="issn" value="<?php echo $updateJournal -> getIssn() ?>" required />
						</div>
						<div class="form-group">
							<label>Sjr*</label>
							<input type="text" class="form-control" name="sjr" value="<?php echo $updateJournal -> getSjr() ?>" required />
						</div>
						<div class="form-group">
							<label>Best_quartile</label>
							<input type="text" class="form-control" name="best_quartile" value="<?php echo $updateJournal -> getBest_quartile() ?>"/>
						</div>
						<div class="form-group">
							<label>Hindex</label>
							<input type="text" class="form-control" name="hindex" value="<?php echo $updateJournal -> getHindex() ?>"/>
						</div>
						<div class="form-group">
							<label>Total_docs</label>
							<input type="text" class="form-control" name="total_docs" value="<?php echo $updateJournal -> getTotal_docs() ?>"/>
						</div>
						<div class="form-group">
							<label>Total_references</label>
							<input type="text" class="form-control" name="total_references" value="<?php echo $updateJournal -> getTotal_references() ?>"/>
						</div>
						<div class="form-group">
							<label>Total_cites</label>
							<input type="text" class="form-control" name="total_cites" value="<?php echo $updateJournal -> getTotal_cites() ?>"/>
						</div>
						<div class="form-group">
							<label>Citable_docs</label>
							<input type="text" class="form-control" name="citable_docs" value="<?php echo $updateJournal -> getCitable_docs() ?>"/>
						</div>
						<div class="form-group">
							<label>Coverage</label>
							<input type="text" class="form-control" name="coverage" value="<?php echo $updateJournal -> getCoverage() ?>"/>
						</div>
						<div class="form-group">
							<label>Categories</label>
							<input type="text" class="form-control" name="categories" value="<?php echo $updateJournal -> getCategories() ?>"/>
						</div>
					<div class="form-group">
						<label>Country*</label>
						<select class="form-control" name="country">
							<?php
							$objCountry = new Country();
							$countrys = $objCountry -> selectAllOrder("name", "asc");
							foreach($countrys as $currentCountry){
								echo "<option value='" . $currentCountry -> getIdCountry() . "'";
								if($currentCountry -> getIdCountry() == $updateJournal -> getCountry() -> getIdCountry()){
									echo " selected";
								}
								echo ">" . $currentCountry -> getName() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
