<?php 
session_start();
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/Area.php");
require("business/Category.php");
require("business/Journalcategory.php");
require("business/Journal.php");
require("business/Country.php");
require("business/Filter_search.php");
ini_set("display_errors","1");
date_default_timezone_set("America/Bogota");
$webPagesNoAuthentication = array(
	'ui/recoverPassword.php',
	'ui/filter_search/filterSearchPage.php',
	'ui/filter_search/datesC.php',
	'ui/filter_search/getHindexFilter.php',
	'ui/filter_search/filterSearchPageAjax.php',
	'ui/filter_search/PDFSearchs.php'


);
$webPages = array(
	'ui/sessionAdministrator.php',
	'ui/administrator/insertAdministrator.php',
	'ui/administrator/updateAdministrator.php',
	'ui/administrator/selectAllAdministrator.php',
	'ui/administrator/searchAdministrator.php',
	'ui/administrator/updateProfileAdministrator.php',
	'ui/administrator/updatePasswordAdministrator.php',
	'ui/administrator/updateProfilePictureAdministrator.php',
	'ui/administrator/updatePictureAdministrator.php',
	'ui/logAdministrator/searchLogAdministrator.php',
	'ui/area/insertArea.php',
	'ui/area/updateArea.php',
	'ui/area/selectAllArea.php',
	'ui/area/searchArea.php',
	'ui/category/selectAllCategoryByArea.php',
	'ui/category/insertCategory.php',
	'ui/category/updateCategory.php',
	'ui/category/selectAllCategory.php',
	'ui/category/searchCategory.php',
	'ui/journalcategory/selectAllJournalcategoryByCategory.php',
	'ui/journalcategory/insertJournalcategory.php',
	'ui/journalcategory/updateJournalcategory.php',
	'ui/journalcategory/selectAllJournalcategory.php',
	'ui/journalcategory/searchJournalcategory.php',
	'ui/journal/insertJournal.php',
	'ui/journal/updateJournal.php',
	'ui/journal/selectAllJournal.php',
	'ui/journal/searchJournal.php',
	'ui/journalcategory/selectAllJournalcategoryByJournal.php',
	'ui/country/insertCountry.php',
	'ui/country/updateCountry.php',
	'ui/country/selectAllCountry.php',
	'ui/country/searchCountry.php',
	'ui/journal/selectAllJournalByCountry.php',
	'ui/filter_search/insertFilter_search.php',
	'ui/filter_search/updateFilter_search.php',
	'ui/filter_search/selectAllFilter_search.php',
	'ui/filter_search/searchFilter_search.php',
	'ui/journal/upload.php',
	'ui/journalcategory/relationsJC.php'

	
);
if(isset($_GET['logOut'])){
	$_SESSION['id']="";
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SRS</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" type="image/png" href="img/logo.png" />
		<link href="https://bootswatch.com/4/superhero/bootstrap.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="ui/css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />

		<!--AJAX & jQUERY-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

		<!-- datatable-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.css"/>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>

		<!--pushJs-->
		<script type="text/javascript" src="push.js/push.min.js"></script>



		<script charset="utf-8">
			$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
	</head>
	<body>
		<?php
		if(empty($_GET['pid'])){
			include('ui/home.php' );
		}else{
			$pid=base64_decode($_GET['pid']);
			if(in_array($pid, $webPagesNoAuthentication)){
				include($pid);
			}else{
				if($_SESSION['id']==""){
					header("Location: index.php");
					die();
				}
				if($_SESSION['entity']=="Administrator"){
					include('ui/menuAdministrator.php');
				}
				if (in_array($pid, $webPages)){
					include($pid);
				}else{
					include('ui/error.php');
				}
			}
		}
		?>
		<div class="text-center text-muted">ITI &copy; <?php echo date("Y")?></div>
	</body>
</html>

