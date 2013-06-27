<?php

class Locations_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_all_countries()
	{
	    $sql = "SELECT * FROM countries";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function get_all_states()
	{
	    $sql = "SELECT * FROM states";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function get_all_counties()
	{
	    $sql = "SELECT * FROM counties";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function get_all_cities()
	{
	    $sql = "SELECT * FROM cities";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function get_all_zip()
	{
	    $sql = "SELECT * FROM zip_codes";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
}
