<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$country = new Country($_GET['idCountry']); 
$country -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
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
			<h4 class="card-title">Get All Journal of Country: <em><?php echo $country -> getName() ?></em></h4>
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
						<th nowrap>Title 
						<?php if($order=="title" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=title&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="title" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=title&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Issn 
						<?php if($order=="issn" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=issn&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="issn" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=issn&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Sjr 
						<?php if($order=="sjr" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=sjr&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="sjr" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=sjr&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Best_quartile 
						<?php if($order=="best_quartile" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=best_quartile&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="best_quartile" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=best_quartile&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Hindex 
						<?php if($order=="hindex" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=hindex&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="hindex" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=hindex&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Total_docs 
						<?php if($order=="total_docs" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=total_docs&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="total_docs" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=total_docs&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Total_references 
						<?php if($order=="total_references" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=total_references&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="total_references" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=total_references&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Total_cites 
						<?php if($order=="total_cites" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=total_cites&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="total_cites" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=total_cites&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Citable_docs 
						<?php if($order=="citable_docs" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=citable_docs&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="citable_docs" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=citable_docs&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Coverage 
						<?php if($order=="coverage" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=coverage&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="coverage" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=coverage&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Categories 
						<?php if($order=="categories" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=categories&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="categories" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/journal/selectAllJournalByCountry.php") ?>&idCountry=<?php echo $_GET['idCountry'] ?>&order=categories&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Country</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$journal = new Journal("", "", "", "", "", "", "", "", "", "", "", "", $_GET['idCountry']);
					if($order!="" && $dir!="") {
						$journals = $journal -> selectAllByCountryOrder($order, $dir);
					} else {
						$journals = $journal -> selectAllByCountry();
					}
					$counter = 1;
					foreach ($journals as $currentJournal) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentJournal -> getTitle() . "</td>";
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
							echo "<a href='index.php?pid=" . base64_encode("ui/journal/selectAllJournalByCountry.php") . "&idCountry=" . $_GET['idCountry'] . "&idJournal=" . $currentJournal -> getIdJournal() . "&action=delete' onclick='return confirm(\"Confirm to delete Journal: " . $currentJournal -> getTitle() . " " . $currentJournal -> getIssn() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Journal' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByJournal.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journalcategory' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/insertJournalcategory.php") . "&idJournal=" . $currentJournal -> getIdJournal() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journalcategory' ></span></a> ";
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
