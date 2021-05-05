<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Category</h4>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Name 
						<?php if($order=="name" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/category/selectAllCategory.php") ?>&order=name&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="name" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/category/selectAllCategory.php") ?>&order=name&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th>Area</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$category = new Category();
					if($order != "" && $dir != "") {
						$categorys = $category -> selectAllOrder($order, $dir);
					} else {
						$categorys = $category -> selectAll();
					}
					$counter = 1;
					foreach ($categorys as $currentCategory) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCategory -> getName() . "</td>";
						echo "<td><a href='modalArea.php?idArea=" . $currentCategory -> getArea() -> getIdArea() . "' data-toggle='modal' data-target='#modalCategory'   style='color: #DF691A;'>" . $currentCategory -> getArea() -> getName() . " </a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/category/updateCategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Category'  style='color: #DF691A;' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByCategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journalcategory'  style='color: #DF691A;' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/insertJournalcategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journalcategory'  style='color: #DF691A;' ></span></a> ";
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
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
