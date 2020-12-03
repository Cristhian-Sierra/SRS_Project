<?php
$processed=false;
$search_date="";
if(isset($_POST['search_date'])){
	$search_date=$_POST['search_date'];
}
$search_time="";
if(isset($_POST['search_time'])){
	$search_time=$_POST['search_time'];
}
$hindex_filter="";
if(isset($_POST['hindex_filter'])){
	$hindex_filter=$_POST['hindex_filter'];
}
$references_filter="";
if(isset($_POST['references_filter'])){
	$references_filter=$_POST['references_filter'];
}
$country_filter="";
if(isset($_POST['country_filter'])){
	$country_filter=$_POST['country_filter'];
}
$category_filter="";
if(isset($_POST['category_filter'])){
	$category_filter=$_POST['category_filter'];
}
$area_filter="";
if(isset($_POST['area_filter'])){
	$area_filter=$_POST['area_filter'];
}
$quartile_filter="";
if(isset($_POST['quartile_filter'])){
	$quartile_filter=$_POST['quartile_filter'];
}
$sjr_filter="";
if(isset($_POST['sjr_filter'])){
	$sjr_filter=$_POST['sjr_filter'];
}
if(isset($_POST['insert'])){
	$newFilter_search = new Filter_search("", $search_date, $search_time, $hindex_filter, $references_filter, $country_filter, $category_filter, $area_filter, $quartile_filter, $sjr_filter);
	$newFilter_search -> insert();
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
		$logAdministrator = new LogAdministrator("","Create Filter_search", "Search_date: " . $search_date . "; Search_time: " . $search_time . "; Hindex_filter: " . $hindex_filter . "; References_filter: " . $references_filter . "; Country_filter: " . $country_filter . "; Category_filter: " . $category_filter . "; Area_filter: " . $area_filter . "; Quartile_filter: " . $quartile_filter . "; Sjr_filter: " . $sjr_filter, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Filter_search</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/filter_search/insertFilter_search.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Search_date*</label>
							<input type="text" class="form-control" name="search_date" value="<?php echo $search_date ?>" required />
						</div>
						<div class="form-group">
							<label>Search_time*</label>
							<input type="text" class="form-control" name="search_time" value="<?php echo $search_time ?>" required />
						</div>
						<div class="form-group">
							<label>Hindex_filter*</label>
							<input type="text" class="form-control" name="hindex_filter" value="<?php echo $hindex_filter ?>" required />
						</div>
						<div class="form-group">
							<label>References_filter*</label>
							<input type="text" class="form-control" name="references_filter" value="<?php echo $references_filter ?>" required />
						</div>
						<div class="form-group">
							<label>Country_filter*</label>
							<input type="text" class="form-control" name="country_filter" value="<?php echo $country_filter ?>" required />
						</div>
						<div class="form-group">
							<label>Category_filter*</label>
							<input type="text" class="form-control" name="category_filter" value="<?php echo $category_filter ?>" required />
						</div>
						<div class="form-group">
							<label>Area_filter*</label>
							<input type="text" class="form-control" name="area_filter" value="<?php echo $area_filter ?>" required />
						</div>
						<div class="form-group">
							<label>Quartile_filter*</label>
							<input type="text" class="form-control" name="quartile_filter" value="<?php echo $quartile_filter ?>" required />
						</div>
						<div class="form-group">
							<label>Sjr_filter*</label>
							<input type="text" class="form-control" name="sjr_filter" value="<?php echo $sjr_filter ?>" required />
						</div>
						<button type="submit" class="btn btn-info" name="insert">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
