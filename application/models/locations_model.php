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
	
	function search_states($countries_string)
	{
	    $sql = "select * from states where country_id in 
                (select country_id from countries where country_name in ($countries_string))";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function search_cities($states_string)
	{
	    $sql = "select * from cities where state_id in 
                (select state_id from states where state_name in ($states_string))";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function search_zips($cities_string)
	{
	    $sql = "select * from zip_codes where city_id in 
                (select city_id from cities where city_name in ($cities_string))";
	    $query = $this->db->query($sql);
	    $result = $query->result_array(); 
		$query->free_result();
		return $result;
	}
	
	function get_all_industries()
	{
	    $sql = "SELECT * FROM industries";
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
