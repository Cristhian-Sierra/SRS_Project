<?php
$administrator = new Administrator($_SESSION['id']);
$administrator -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrator.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Create</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/insertAdministrator.php") ?>">Administrator</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/area/insertArea.php") ?>">Area</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/category/insertCategory.php") ?>">Category</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/journal/insertJournal.php") ?>">Journal</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/country/insertCountry.php") ?>">Country</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/filter_search/insertFilter_search.php") ?>">Filter_search</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Get All</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>">Administrator</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/area/selectAllArea.php") ?>">Area</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/category/selectAllCategory.php") ?>">Category</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournal.php") ?>">Journal</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/country/selectAllCountry.php") ?>">Country</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/filter_search/selectAllFilter_search.php") ?>">Filter_search</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Search</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/searchAdministrator.php") ?>">Administrator</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/area/searchArea.php") ?>">Area</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/category/searchCategory.php") ?>">Category</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/journal/searchJournal.php") ?>">Journal</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/country/searchCountry.php") ?>">Country</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/filter_search/searchFilter_search.php") ?>">Filter_search</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Log</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logAdministrator/searchLogAdministrator.php") ?>">Log Administrator</a>
				</div>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Reports</a>
				<div class="dropdown-menu">
					<a class="dropdown-item"href='index.php?pid=<?php echo base64_encode("ui/filter_search/PDFSearchs.php") ?>'  target="_blank">PDF</a>
				</div>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Update SRS</a>
				<div class="dropdown-menu">
					<a class="dropdown-item"href='index.php?pid=<?php echo base64_encode("ui/journal/upload.php") ?>'  target="_blank">Upload CSV</a>
					<a class="dropdown-item"href='index.php?pid=<?php echo base64_encode("ui/journalcategory/relationsJC.php") ?>'  target="_blank">Make relations with JC</a>
				</div>
			</li>
		</ul>


		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Administrator: <?php echo $administrator -> getName() . " " . $administrator -> getLastName() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfileAdministrator.php") ?>">Edit Profile</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updatePasswordAdministrator.php") ?>">Edit Password</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfilePictureAdministrator.php") ?>">Edit Picture</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Log Out</a>
			</li>
		</ul>
	</div>
</nav>




