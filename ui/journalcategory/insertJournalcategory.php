<?php
$processed=false;
$category="";
if(isset($_POST['category'])){
	$category=$_POST['category'];
}
if(isset($_GET['idCategory'])){
	$category=$_GET['idCategory'];
}
$journal="";
if(isset($_POST['journal'])){
	$journal=$_POST['journal'];
}
if(isset($_GET['idJournal'])){
	$journal=$_GET['idJournal'];
}
if(isset($_POST['insert'])){
	$newJournalcategory = new Journalcategory("", $category, $journal);
	$newJournalcategory -> insert();
	$objCategory = new Category($category);
	$objCategory -> select();
	$nameCategory = $objCategory -> getName() ;
	$objJournal = new Journal($journal);
	$objJournal -> select();
	$nameJournal = $objJournal -> getTitle() . " " . $objJournal -> getIssn() ;
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
		$logAdministrator = new LogAdministrator("","Create Journalcategory", "Category: " . $nameCategory . ";; Journal: " . $nameJournal , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Journalcategory</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/journalcategory/insertJournalcategory.php") ?>" class="bootstrap-form needs-validation"   >
					<div class="form-group">
						<label>Category*</label>
						<select class="form-control" name="category">
							<?php
							$objCategory = new Category();
							$categorys = $objCategory -> selectAllOrder("name", "asc");
							foreach($categorys as $currentCategory){
								echo "<option value='" . $currentCategory -> getIdCategory() . "'";
								if($currentCategory -> getIdCategory() == $category){
									echo " selected";
								}
								echo ">" . $currentCategory -> getName() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Journal*</label>
						<select class="form-control" name="journal">
							<?php
							$objJournal = new Journal();
							$journals = $objJournal -> selectAllOrder("title", "asc");
							foreach($journals as $currentJournal){
								echo "<option value='" . $currentJournal -> getIdJournal() . "'";
								if($currentJournal -> getIdJournal() == $journal){
									echo " selected";
								}
								echo ">" . $currentJournal -> getTitle() . " " . $currentJournal -> getIssn() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="insert">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
