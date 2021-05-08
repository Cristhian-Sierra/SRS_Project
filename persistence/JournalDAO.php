<?php 
class JournalDAO {

	private $idJournal;
	private $title;
	private $issn;
	private $sjr;
	private $best_quartile;
	private $hindex;
	private $total_docs;
	private $total_references;
	private $total_cites;
	private $citable_docs;
	private $coverage;
	private $categories;
	private $country;

	function JournalDAO($pIdJournal = "", $pTitle = "", $pIssn = "", $pSjr = "", $pBest_quartile = "", $pHindex = "", $pTotal_docs = "", $pTotal_references = "", $pTotal_cites = "", $pCitable_docs = "", $pCoverage = "", $pCategories = "", $pCountry = ""){
		$this -> idJournal = $pIdJournal;
		$this -> title = $pTitle;
		$this -> issn = $pIssn;
		$this -> sjr = $pSjr;
		$this -> best_quartile = $pBest_quartile;
		$this -> hindex = $pHindex;
		$this -> total_docs = $pTotal_docs;
		$this -> total_references = $pTotal_references;
		$this -> total_cites = $pTotal_cites;
		$this -> citable_docs = $pCitable_docs;
		$this -> coverage = $pCoverage;
		$this -> categories = $pCategories;
		$this -> country = $pCountry;
	}

	function insert(){
		return "insert into Journal(title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry)
		values('" . $this -> title . "', '" . $this -> issn . "', '" . $this -> sjr . "', '" . $this -> best_quartile . "', '" . $this -> hindex . "', '" . $this -> total_docs . "', '" . $this -> total_references . "', '" . $this -> total_cites . "', '" . $this -> citable_docs . "', '" . $this -> coverage . "', '" . $this -> categories . "', '" . $this -> country . "')";
	}

	function insert_csv($pIdJournal, $pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage,$pCategories,$pCountry)
	{
		return  "insert into journal(idJournal,title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage,categories,country_idCountry)
		values('".$pIdJournal."','" . $pTitle . "', '" . $pIssn . "', '" . $pSjr . "', '" . $pBest_quartile . "', '" . $pHindex . "', '" . $pTotal_docs . "', '" . $pTotal_references . "', '" . $pTotal_cites . "', '" . $pCitable_docs . "', '" . $pCoverage . "','".$pCategories."','".$pCountry."')";
	}

	function  upgrade_csv($pIdJournal, $pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage,$pCategories,$pCountry)
	{
		return  "insert into Journal(idJournal,title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage,categories)
		values('".$pIdJournal."','" . $pTitle . "', '" . $pIssn . "', '" . $pSjr . "', '" . $pBest_quartile . "', '" . $pHindex . "', '" . $pTotal_docs . "', '" . $pTotal_references . "', '" . $pTotal_cites . "', '" . $pCitable_docs . "', '" . $pCoverage . "','".$pCategories."','".$pCountry."')";
	}

	function insert_idCountry($idCountry,$nameCountry){
		return "UPDATE journal,country SET country_idCountry='$idCountry'
		WHERE country.name=journal.country_idCountry AND country.name='$nameCountry'";
	}

	function update(){
		return "update Journal set 
		title = '" . $this -> title . "',
		issn = '" . $this -> issn . "',
		sjr = '" . $this -> sjr . "',
		best_quartile = '" . $this -> best_quartile . "',
		hindex = '" . $this -> hindex . "',
		total_docs = '" . $this -> total_docs . "',
		total_references = '" . $this -> total_references . "',
		total_cites = '" . $this -> total_cites . "',
		citable_docs = '" . $this -> citable_docs . "',
		coverage = '" . $this -> coverage . "',
		categories = '" . $this -> categories . "',
		country_idCountry = '" . $this -> country . "'	
		where idJournal = '" . $this -> idJournal . "'";
	}

	function select() {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from Journal
		where idJournal = '" . $this -> idJournal . "'";
	}

	function selectAll() {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from Journal";
	}

	function selectAllA() {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from Journal where sjr>=1 AND hindex>=100 AND total_references>=1000 ";
	}


	function selectAllC() {
		return "SELECT j.idJournal,j.title,j.issn,j.sjr,j.best_quartile,j.hindex,j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,co.idCountry 
		FROM Journal as j,Country as co
		WHERE j.country_idCountry=co.idCountry";
	}

	function selectAllByCountry() {
		return  "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from Journal
		where country_idCountry = '" . $this -> country . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from Journal
		order by " . $orden . " " . $dir;
	}

	function selectAllByCountryOrder($orden, $dir) {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal
		where country_idCountry = '" . $this -> country . "'
		order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal
		where title like '%" . $search . "%' or issn like '%" . $search . "%' or sjr like '%" . $search . "%' or best_quartile like '%" . $search . "%' or hindex like '%" . $search . "%' or total_docs like '%" . $search . "%' or total_references like '%" . $search . "%' or total_cites like '%" . $search . "%' or citable_docs like '%" . $search . "%' or coverage like '%" . $search . "%' or categories like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Journal
		where idJournal = '" . $this -> idJournal . "'";
	}

	function deleteAll(){
		return "delete from Journal";
	}

	public function searchPage($quantity, $page){
		return "SELECT j.idJournal,j.title,j.issn,j.sjr,j.best_quartile,j.hindex,j.total_docs,
		j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,co.name FROM Journal as j,Country as co  WHERE j.country_idCountry=co.idCountry 
		limit " . (($page-1) * $quantity) . ", " . $quantity;
	}

	public function searchQuantity(){
		return "SELECT count(j.idJournal) FROM Journal as j";
	}

	

}


?>
