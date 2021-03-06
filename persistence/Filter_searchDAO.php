<?php
class Filter_searchDAO{
	private $idFilter_search;
	private $search_date;
	private $search_time;
	private $hindex_filter;
	private $references_filter;
	private $country_filter;
	private $category_filter;
	private $area_filter;
	private $quartile_filter;
	private $sjr_filter;


	function Filter_searchDAO($pIdFilter_search = "", $pSearch_date = "", $pSearch_time = "", $pHindex_filter = "", $pReferences_filter = "", $pCountry_filter = "", $pCategory_filter = "", $pArea_filter = "", $pQuartile_filter = "", $pSjr_filter = ""){
		$this -> idFilter_search = $pIdFilter_search;
		$this -> search_date = $pSearch_date;
		$this -> search_time = $pSearch_time;
		$this -> hindex_filter = $pHindex_filter;
		$this -> references_filter = $pReferences_filter;
		$this -> country_filter = $pCountry_filter;
		$this -> category_filter = $pCategory_filter;
		$this -> area_filter = $pArea_filter;
		$this -> quartile_filter = $pQuartile_filter;
		$this -> sjr_filter = $pSjr_filter;
	}

	function insert(){
		return "insert into Filter_search(search_date, search_time, hindex_filter, references_filter, country_filter, category_filter, area_filter, quartile_filter, sjr_filter)
				values('" . $this -> search_date . "', '" . $this -> search_time . "', '" . $this -> hindex_filter . "', '" . $this -> references_filter . "', '" . $this -> country_filter . "', '" . $this -> category_filter . "', '" . $this -> area_filter . "', '" . $this -> quartile_filter . "', '" . $this -> sjr_filter . "')";
	}

	function update(){
		return "update Filter_search set 
				search_date = '" . $this -> search_date . "',
				search_time = '" . $this -> search_time . "',
				hindex_filter = '" . $this -> hindex_filter . "',
				references_filter = '" . $this -> references_filter . "',
				country_filter = '" . $this -> country_filter . "',
				category_filter = '" . $this -> category_filter . "',
				area_filter = '" . $this -> area_filter . "',
				quartile_filter = '" . $this -> quartile_filter . "',
				sjr_filter = '" . $this -> sjr_filter . "'	
				where idFilter_search = '" . $this -> idFilter_search . "'";
	}

	function select() {
		return "select idFilter_search, search_date, search_time, hindex_filter, references_filter, country_filter, category_filter, area_filter, quartile_filter, sjr_filter
				from Filter_search
				where idFilter_search = '" . $this -> idFilter_search . "'";
	}

	function selectAll() {
		return "select idFilter_search, search_date, search_time, hindex_filter, references_filter, country_filter, category_filter, area_filter, quartile_filter, sjr_filter
				from Filter_search";
	}

	function selectAllOrder($orden, $dir){
		return "select idFilter_search, search_date, search_time, hindex_filter, references_filter, country_filter, category_filter, area_filter, quartile_filter, sjr_filter
				from Filter_search
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idFilter_search, search_date, search_time, hindex_filter, references_filter, country_filter, category_filter, area_filter, quartile_filter, sjr_filter
				from Filter_search
				where search_date like '%" . $search . "%' or search_time like '%" . $search . "%' or hindex_filter like '%" . $search . "%' or references_filter like '%" . $search . "%' or country_filter like '%" . $search . "%' or category_filter like '%" . $search . "%' or area_filter like '%" . $search . "%' or quartile_filter like '%" . $search . "%' or sjr_filter like '%" . $search . "%'";
	}

	function selectF(){
		return "SELECT  fs.idFilter_search, fs.search_date, fs.search_time,j.hindex,j.total_references,co.name,ca.name,a.name,j.best_quartile,j.sjr
			FROM filter_search as fs,journal as j,country as co, category as ca, area as a where j.sjr='".$this->sjr_filter."' AND j.hindex='".$this->hindex_filter."' AND j.total_references='".$this->references_filter."' AND co.name='".$this->country_filter."' AND ca.name='".$this->category_filter."' AND a.name='".$this->area_filter."' AND j.best_quartile='".$this->quartile_filter."' AND j.sjr='".$this->sjr_filter."'";
	}



}

?>

		