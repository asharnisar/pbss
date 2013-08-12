<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		
		if(!$this->input->is_ajax_request())
		{
			echo "error";
		}
        
        $this->load->model('locations_model');		
	} 
	
	function get_states()
	{
	    $countries = $this->input->post("countries");
	    if(count($countries))
	    {
	        array_walk($countries, create_function('&$str', '$str = "\"$str\"";'));
	        $countries_string = implode(",",$countries);
	        $result = $this->locations_model->search_states($countries_string);
	        echo json_encode($result);
	    }
	    
	}
	
	function get_cities()
	{
	    $states = $this->input->post("states");
	    if(count($states))
	    {
	        array_walk($states, create_function('&$str', '$str = "\"$str\"";'));
	        $states_string = implode(",",$states);
	        $result = $this->locations_model->search_cities($states_string);
	        echo json_encode($result);
	    }
	    
	}
	
	function get_zips()
	{
	    $cities = $this->input->post("cities");
	    if(count($cities))
	    {
	        array_walk($cities, create_function('&$str', '$str = "\"$str\"";'));
	        $cities_string = implode(",",$cities);
	        $result = $this->locations_model->search_zips($cities_string);
	        echo json_encode($result);
	    }
	    
	}
	
	 
	public function index()
	{
		
	}
	
	public function scrap()
	{
		$jar_path = 'C:\wamp\www\tugboat\assets\harvester\webharvest_all_2.jar';
		$config_path = 'C:\wamp\www\tugboat\assets\harvester\tradekey2.xml';
		$dir_path = 'C:\wamp\www\tugboat\assets\harvester';
		//exec('java -jar "C:\Users\webharvest_all_2.jar"',$output,$result);
		$exec = 'java -jar '.$jar_path.' [-h] config="'.$config_path.'" workdir="'.$dir_path.'"';
		//debug($exec,1);
		exec($exec,$output,$result);
		//$result = 0;
		if($result == 0)
		{
			//echo json_encode(array("text"=>"Successfully scrap"));
			$filename = 'C:\\wamp\\www\\tugboat\\assets\\harvester\\data\\tradekey\\aaagricultural.xml';
			if(file_exists($filename))
			{
				$temp = array();
				$xml = simplexml_load_file($filename);
				if(count($xml->companies))
				{
					$array = xml_to_array($xml,'companies');
					foreach($array as $arr)
						$temp[] = $arr['info'];
				}
				echo json_encode($temp);
			}
			else
			{
				debug('file not exists',1);
			}
		}
		else
		{debug($result);
			echo json_encode(array("text"=>"Some error"));
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
