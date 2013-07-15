<?php

class Search_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_all_websites()
	{
	    $sql = "SELECT * FROM websites";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}	
}
