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
		return "insert into journal(title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry)
		values('" . $this -> title . "', '" . $this -> issn . "', '" . $this -> sjr . "', '" . $this -> best_quartile . "', '" . $this -> hindex . "', '" . $this -> total_docs . "', '" . $this -> total_references . "', '" . $this -> total_cites . "', '" . $this -> citable_docs . "', '" . $this -> coverage . "', '" . $this -> categories . "', '" . $this -> country . "')";
	}

	function insert_csv($pIdJournal,$pTitle, $pIssn, $pSjr, $pBest_quartile, $pHindex, $pTotal_docs, $pTotal_references, $pTotal_cites, $pCitable_docs, $pCoverage,$pCategories,$pCountry)
	{
		return  "insert into journal(idJournal,title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage,categories,country_idCountry)
		values('".$pIdJournal."', '" . $pTitle . "','" . $pIssn . "', '" . $pSjr . "', '" . $pBest_quartile . "', '" . $pHindex . "', '" . $pTotal_docs . "', '" . $pTotal_references . "', '" . $pTotal_cites . "', '" . $pCitable_docs . "', '" . $pCoverage . "','".$pCategories."','".$pCountry."')";
	}

	function insert_csvT($idJournal,$pTitle)
	{
		return  "update journal SET title='$pTitle' where idJournal='$idJournal'";
	}


	function insert_idCountry($idCountry,$nameCountry){
		return "UPDATE journal,country SET country_idCountry='$idCountry'
		WHERE country.name=journal.country_idCountry AND country.name='$nameCountry'";
	}



	function update(){
		return "update journal set 
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
		from journal
		where idJournal = '" . $this -> idJournal . "'";
	}

	function selectAll() {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal";
	}

	function selectAllA() {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal where sjr>=1 AND hindex>=100 AND total_references>=1000 ";
	}


	function selectAllC() {
		return "SELECT j.idJournal,j.title,j.issn,j.sjr,j.best_quartile,j.hindex,j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,co.idCountry 
		FROM journal as j,country as co
		WHERE j.country_idCountry=co.idCountry";
	}

	function selectAllByCountry() {
		return  "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal
		where country_idCountry = '" . $this -> country . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal
		order by " . $orden . " " . $dir;
	}

	function selectAllByCountryOrder($orden, $dir) {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal
		where country_idCountry = '" . $this -> country . "'
		order by " . $orden . " " . $dir;
	}

	function selectQuartile() {
		return "select DISTINCT best_quartile from journal";
	}

	function search($search) {
		return "select idJournal, title, issn, sjr, best_quartile, hindex, total_docs, total_references, total_cites, citable_docs, coverage, categories, country_idCountry
		from journal
		where title like '%" . $search . "%' or issn like '%" . $search . "%' or sjr like '%" . $search . "%' or best_quartile like '%" . $search . "%' or hindex like '%" . $search . "%' or total_docs like '%" . $search . "%' or total_references like '%" . $search . "%' or total_cites like '%" . $search . "%' or citable_docs like '%" . $search . "%' or coverage like '%" . $search . "%' or categories like '%" . $search . "%'";
	}

	function delete(){
		return "delete from journal
		where idJournal = '" . $this -> idJournal . "'";
	}

	function deleteAll(){
		return "delete from journal";
	}

	function searchPage($quantity, $page){
		return "SELECT j.idJournal,j.title,j.issn,j.sjr,j.best_quartile,j.hindex,j.total_docs,
		j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,co.name FROM journal as j,country as co  WHERE j.country_idCountry=co.idCountry 
		limit " . (($page-1) * $quantity) . ", " . $quantity;
	}

	function searchQuantity(){
		return "SELECT count(j.idJournal) FROM journal as j";
	}

	//selects to filters page

	function selectAllF($area,$category,$country,$quartile,$hindex,$references,$sjr){
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country') AND (ca.idCategory='$category') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') AND (j.best_quartile='$quartile') order by j.idJournal";

	}

	function selectWF($hindex,$references,$sjr){
		//Select without filters
		return "SELECT  DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,co.name AS country FROM journal AS j,country AS co WHERE co.idCountry=j.country_IdCountry AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr')  order by j.idJournal";
	}

	function selectAr($area,$hindex,$references,$sjr){
        //Select with area
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area')  AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";
	}

	function selectArCa($area,$category,$hindex,$references,$sjr){
        //Select with area and category filter
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (ca.idCategory='$category') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";
	}


	function selectCo($country,$hindex,$references,$sjr){
 	       //Select with country filter
		return " SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc
		WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) 
		AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) 
		AND (co.idCountry='$country') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";
	} 

	function selectQ($quartile,$hindex,$references,$sjr){
        //Select with quartile filter
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";
	}

	function selectACC($area,$category,$country,$hindex,$references,$sjr){
		//select with area, category, country
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country') AND (ca.idCategory='$category') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";
	}

	function selectACo($area,$country,$hindex,$references,$sjr){
	//select with area, country
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country')  AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr')";

	}

	function selectACoQ($area,$country,$quartile,$hindex,$references,$sjr){
	//select with area, country,quartile
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (co.idCountry='$country')  AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

	}

	function selectACaQ($area,$category,$quartile,$hindex,$references,$sjr){
	//select area,category, quartile
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (ca.idCategory='$category') AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

	}
	function selectAQ($area,$quartile,$hindex,$references,$sjr){
	//select area, quartile
		return"SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (a.idArea='$area') AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";
	}

	function selectCoQ($country,$quartile,$hindex,$references,$sjr){
	//select with country. quartile
		return "SELECT DISTINCT j.idJournal,j.title AS title,j.issn,j.sjr,j.best_quartile,j.hindex, j.total_docs,j.total_references,j.total_cites,j.citable_docs,j.coverage,j.categories,j.country_idCountry AS country FROM journal AS j,country AS co,category as ca, area as a,journalcategory as jc WHERE (jc.journal_idJournal=j.idJournal) AND (jc.category_idCategory=ca.idCategory) AND (co.idCountry=j.country_IdCountry) AND (a.idArea=ca.area_idArea ) AND (co.idCountry='$country') AND (j.best_quartile='$quartile') AND (j.hindex>='$hindex') AND (j.total_references>='$references') AND (j.sjr>='$sjr') order by j.idJournal";

	}

}


?>
