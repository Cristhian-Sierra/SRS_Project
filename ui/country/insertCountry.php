<?php
$processed=false;
$name="";
if(isset($_POST['name'])){
	$name=$_POST['name'];
}
$region="";
if(isset($_POST['region'])){
	$region=$_POST['region'];
}
$documents="";
if(isset($_POST['documents'])){
	$documents=$_POST['documents'];
}
$citable_docs="";
if(isset($_POST['citable_docs'])){
	$citable_docs=$_POST['citable_docs'];
}
$citations="";
if(isset($_POST['citations'])){
	$citations=$_POST['citations'];
}
$self_citations="";
if(isset($_POST['self_citations'])){
	$self_citations=$_POST['self_citations'];
}
$citations_per_doc="";
if(isset($_POST['citations_per_doc'])){
	$citations_per_doc=$_POST['citations_per_doc'];
}
$hindex="";
if(isset($_POST['hindex'])){
	$hindex=$_POST['hindex'];
}
if(isset($_POST['insert'])){
	$newCountry = new Country("", $name, $region, $documents, $citable_docs, $citations, $self_citations, $citations_per_doc, $hindex);
	$newCountry -> insert();
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
		$logAdministrator = new LogAdministrator("","Create Country", "Name: " . $name . "; Region: " . $region . "; Documents: " . $documents . "; Citable_docs: " . $citable_docs . "; Citations: " . $citations . "; Self_citations: " . $self_citations . "; Citations_per_doc: " . $citations_per_doc . "; Hindex: " . $hindex, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Country</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/country/insertCountry.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Name*</label>
							<input type="text" class="form-control" name="name" value="<?php echo $name ?>" required />
						</div>
						<div class="form-group">
							<label>Region</label>
							<input type="text" class="form-control" name="region" value="<?php echo $region ?>"/>
						</div>
						<div class="form-group">
							<label>Documents</label>
							<input type="text" class="form-control" name="documents" value="<?php echo $documents ?>"/>
						</div>
						<div class="form-group">
							<label>Citable_docs</label>
							<input type="text" class="form-control" name="citable_docs" value="<?php echo $citable_docs ?>"/>
						</div>
						<div class="form-group">
							<label>Citations</label>
							<input type="text" class="form-control" name="citations" value="<?php echo $citations ?>"/>
						</div>
						<div class="form-group">
							<label>Self_citations</label>
							<input type="text" class="form-control" name="self_citations" value="<?php echo $self_citations ?>"/>
						</div>
						<div class="form-group">
							<label>Citations_per_doc</label>
							<input type="text" class="form-control" name="citations_per_doc" value="<?php echo $citations_per_doc ?>"/>
						</div>
						<div class="form-group">
							<label>Hindex</label>
							<input type="text" class="form-control" name="hindex" value="<?php echo $hindex ?>"/>
						</div>
						<button type="submit" class="btn btn-info" name="insert">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
