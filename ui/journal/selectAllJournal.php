<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$error = 0;
if(isset($_GET['action']) && $_GET['action']=="delete"){
	$deleteJournal = new Journal($_GET['idJournal']);
	$deleteJournal -> select();
	if($deleteJournal -> delete()){
		$nameCountry = $deleteJournal -> getCountry() -> getName();
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
			$logAdministrator = new LogAdministrator("","Delete Journal", "Title: " . $deleteJournal -> getTitle() . ";; Issn: " . $deleteJournal -> getIssn() . ";; Sjr: " . $deleteJournal -> getSjr() . ";; Best_quartile: " . $deleteJournal -> getBest_quartile() . ";; Hindex: " . $deleteJournal -> getHindex() . ";; Total_docs: " . $deleteJournal -> getTotal_docs() . ";; Total_references: " . $deleteJournal -> getTotal_references() . ";; Total_cites: " . $deleteJournal -> getTotal_cites() . ";; Citable_docs: " . $deleteJournal -> getCitable_docs() . ";; Coverage: " . $deleteJournal -> getCoverage() . ";; Categories: " . $deleteJournal -> getCategories() . ";; Country: " . $nameCountry, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get the best Journals where SJR >=1, Hindex >=100 and total references >=1000</h4>
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
			<table class="table table-striped table-hover" id="JournalTableA">
				<thead class="thead-dark">
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
						<th scope="col">Citablee docs</th>
						<th scope="col">Coverage</th>
						<th scope="col" >All categories</th>
						<th scope="col">Country</th>
						<th scope="col">Function</th>
					</tr>
				</thead>
				</tbody>
					<?php
					$journal = new Journal();
					if($order != "" && $dir != "") {
						$journals = $journal -> selectAllOrder($order, $dir);
					} else {
						$journals = $journal -> selectAllA();
					}
					$counter = 1;
					foreach ($journals as $currentJournal) {
						echo "<tr><td>" . $currentJournal->getIdJournal() . "</td>";
						echo "<td>" ."<a href='https://www.scimagojr.com/journalsearch.php?q=".$currentJournal->getIssn()."' target='_blank'>". $currentJournal -> getTitle() ."</a>". "</td>";
						echo "<td>" . $currentJournal -> getIssn() . "</td>";
						echo "<td>" . $currentJournal -> getSjr() . "</td>";
						echo "<td>" . $currentJournal -> getBest_quartile() . "</td>";
						echo "<td>" . $currentJournal -> getHindex() . "</td>";
						echo "<td>" . $currentJournal -> getTotal_docs() . "</td>";
						echo "<td>" . $currentJournal -> getTotal_references() . "</td>";
						echo "<td>" . $currentJournal -> getTotal_cites() . "</td>";
						echo "<td>" . $currentJournal -> getCitable_docs() . "</td>";
						echo "<td>" . $currentJournal -> getCoverage() . "</td>";
						echo "<td>" . $currentJournal -> getCategories() . "</td>";
						echo "<td><a href='modalCountry.php?idCountry=" . $currentJournal -> getCountry() -> getIdCountry() . "' data-toggle='modal' data-target='#modalJournal' >" . $currentJournal -> getCountry() -> getName() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journal/updateJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Journal' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journal/selectAllJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "&action=delete' onclick='return confirm(\"Confirm to delete Journal: " . $currentJournal -> getTitle() . " " . $currentJournal -> getIssn() . "\")'><span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Journal' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journalcategory' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/insertJournalcategory.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journalcategory' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalJournal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


 <!--DATABLE JQUERY-->
 <script type="text/javascript">
 	$(document).ready( function () {
 		$('#JournalTableA').DataTable({
					//dom:'<"top"lfip> rt <"bottom"pi><"clear">',
					lengthMenu: [ [50, 500,-1],[50,500,"All"] ]
				});

 	} );
 </script>
