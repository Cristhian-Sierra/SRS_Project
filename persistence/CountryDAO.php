<?php
class CountryDAO{
	private $idCountry;
	private $name;
	private $region;
	private $documents;
	private $citable_docs;
	private $citations;
	private $self_citations;
	private $citations_per_doc;
	private $hindex;

	function CountryDAO($pIdCountry = "", $pName = "", $pRegion = "", $pDocuments = "", $pCitable_docs = "", $pCitations = "", $pSelf_citations = "", $pCitations_per_doc = "", $pHindex = ""){
		$this -> idCountry = $pIdCountry;
		$this -> name = $pName;
		$this -> region = $pRegion;
		$this -> documents = $pDocuments;
		$this -> citable_docs = $pCitable_docs;
		$this -> citations = $pCitations;
		$this -> self_citations = $pSelf_citations;
		$this -> citations_per_doc = $pCitations_per_doc;
		$this -> hindex = $pHindex;
	}

	function insert(){
		return "insert into country(name, region, documents, citable_docs, citations, self_citations, citations_per_doc, hindex)
				values('" . $this -> name . "', '" . $this -> region . "', '" . $this -> documents . "', '" . $this -> citable_docs . "', '" . $this -> citations . "', '" . $this -> self_citations . "', '" . $this -> citations_per_doc . "', '" . $this -> hindex . "')";
	}

	function update(){
		return "update country set 
				name = '" . $this -> name . "',
				region = '" . $this -> region . "',
				documents = '" . $this -> documents . "',
				citable_docs = '" . $this -> citable_docs . "',
				citations = '" . $this -> citations . "',
				self_citations = '" . $this -> self_citations . "',
				citations_per_doc = '" . $this -> citations_per_doc . "',
				hindex = '" . $this -> hindex . "'	
				where idCountry = '" . $this -> idCountry . "'";
	}

	function select() {
		return "select idCountry, name, region, documents, citable_docs, citations, self_citations, citations_per_doc, hindex
				from country
				where idCountry = '" . $this -> idCountry . "'";
	}

	function selectN(){
		return "select name from country";
	}

	function selectAll() {
		return "select idCountry, name, region, documents, citable_docs, citations, self_citations, citations_per_doc, hindex
				from country order by name";
	}

	function selectAllOrder($orden, $dir){
		return "select idCountry, name, region, documents, citable_docs, citations, self_citations, citations_per_doc, hindex
				from country
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCountry, name, region, documents, citable_docs, citations, self_citations, citations_per_doc, hindex
				from country
				where name like '%" . $search . "%' or region like '%" . $search . "%' or documents like '%" . $search . "%' or citable_docs like '%" . $search . "%' or citations like '%" . $search . "%' or self_citations like '%" . $search . "%' or citations_per_doc like '%" . $search . "%' or hindex like '%" . $search . "%'";
	}
}
?>
