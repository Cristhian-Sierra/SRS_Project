<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$area = new Area($_GET['idArea']); 
$area -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Category of Area: <em><?php echo $area -> getName() ?></em></h4>
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
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/category/selectAllCategoryByArea.php") ?>&idArea=<?php echo $_GET['idArea'] ?>&order=name&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="name" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/category/selectAllCategoryByArea.php") ?>&idArea=<?php echo $_GET['idArea'] ?>&order=name&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Area</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$category = new Category("", "", $_GET['idArea']);
					if($order!="" && $dir!="") {
						$categorys = $category -> selectAllByAreaOrder($order, $dir);
					} else {
						$categorys = $category -> selectAllByArea();
					}
					$counter = 1;
					foreach ($categorys as $currentCategory) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCategory -> getName() . "</td>";
						echo "<td><a href='modalArea.php?idArea=" . $currentCategory -> getArea() -> getIdArea() . "' data-toggle='modal' data-target='#modalCategory' >" . $currentCategory -> getArea() -> getName() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/category/updateCategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Category' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/selectAllJournalcategoryByCategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Journalcategory' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/journalcategory/insertJournalcategory.php") . "&idCategory=" . $currentCategory -> getIdCategory() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Journalcategory' ></span></a> ";
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
