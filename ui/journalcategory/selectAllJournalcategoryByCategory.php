<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$category = new Category($_GET['idCategory']); 
$category -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteJournalcategory = new Journalcategory($_GET['idJournalcategory']);
	$deleteJournalcategory -> select();
	if($deleteJournalcategory -> delete()){
		$nameCategory = $deleteJournalcategory -> getCategory() -> getName();
		$nameJournal = $deleteJournalcategory -> getJournal() -> getTitle() . " " . $deleteJournalcategory -> getJournal() -> getIssn();
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
			$logAdministrator = new LogAdministrator("","Delete Journalcategory", "Category: " . $nameCategory . ";; Journal: " . $nameJournal, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Journalcategory of Category: <em><?php echo $category -> getName() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th>Category</th>
						<th>Journal</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$journalcategory = new Journalcategory("", $_GET['idCategory'], "");
					if($order!="" && $dir!="") {
						$journalcategorys = $journalcategory -> selectAllByCategoryOrder($order, $dir);
					} else {
						$journalcategorys = $journalcategory -> selectAllByCategory();
					}
					$counter = 1;
					foreach ($journalcategorys as $currentJournalcategory) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td><a href='modalCategory.php?idCategory=" . $currentJournalcategory -> getCategory() -> getIdCategory() . "' data-toggle='modal' data-target='#modalJournalcategory' >" . $currentJournalcategory -> getCategory() -> getName() . "</a></td>";
						echo "<td><a href='modalJournal.php?idJournal=" . $currentJournalcategory -> getJournal() -> getIdJournal() . "' data-toggle='modal' data-target='#modalJournalcategory' >" . $currentJournalcategory -> getJournal() -> getTitle() . " " . $currentJournalcategory -> getJournal() -> getIssn() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/updateJournalcategory.php") . "&idJournalcategory=" . $currentJournalcategory -> getIdJournalcategory() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Journalcategory' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByCategory.php") . "&idCategory=" . $_GET['idCategory'] . "&idJournalcategory=" . $currentJournalcategory -> getIdJournalcategory() . "&action=delete' onclick='return confirm(\"Confirm to delete Journalcategory\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Journalcategory' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalJournalcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
