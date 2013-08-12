<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$this->load->model('locations_model');
		$this->load->model('search_model');
		$this->config->load("my_config");
	} 
	
	public function test_exec()
	{
		/*$filename = 'tradekey2.xml';
		$xmlfile  = "C:\\Users\\beto\\Documents\\xml\\" . $filename; //Adding extra slashes
		$result   = '';

		if(file_exists($xmlfile)){
		  $xmlRaw = file_get_contents($xmlfile);

		  $this->load->library('simplexml');
		  $xmlData = $this->simplexml->xml_parse($xmlRaw);
		  
		  //foreach loop
		}else{
		  $result .= 'File ' . $xmlfile . ' was not found';
		}
		return $result;*/
		$filename = "C:\\wamp\\www\\harvester\\data\\tradekey\\agricultural.xml";
		$xml   = simplexml_load_file($filename);
$array = $this->xml_to_array($xml,'companies');

		foreach($array as $arr)
			debug($arr['info']);
		/*if(file_exists($filename))
		{
		$xml = simplexml_load_file($filename);
		if(count($xml->companies))
		{
			$temp = array();
			for($i=0;$i<count($xml->companies);$i++)
			{
				$temp[]['info'] = $xml->companies[$i]->info;
				
			}
			
		}
		
		echo json_encode($temp);
		//$xmlRaw = file_get_contents($filename);
		//$this->load->library('simplexml');
		  //$xmlData = $this->simplexml->xml_parse($xmlRaw);
		
		}
		else
		{
			debug('file not exists',1);
		}*/
		die;
		$jar_path = "C:\wamp\www\harvester\webharvest_all_2.jar";
		$config_path = 'C:\wamp\www\harvester\test.xml';
		$dir_path = "C:\wamp\www\harvester";
		//exec('java -jar "C:\Users\webharvest_all_2.jar"',$output,$result);
		$exec = 'java -jar '.$jar_path.' [-h] config="'.$config_path.'" workdir="'.$dir_path.'"';
		//debug($exec,1);
		exec($exec,$output,$result);
		echo $result;
		//print_r($output);
		//exec("dir",$output,$result);
		//debug($result);
		//debug($output,1);
		
	}
	
	public function index()
	{
		//$this->load->view('welcome_message');
		$countries = json_encode($this->locations_model->get_all_countries());
		$states = json_encode($this->locations_model->get_all_states());
		$counties = json_encode($this->locations_model->get_all_counties());
		$cities = json_encode($this->locations_model->get_all_cities());
		$zip = json_encode($this->locations_model->get_all_zip());
		$industries = json_encode($this->locations_model->get_all_industries());
		$websites = $this->search_model->get_all_websites();
		
	
		$data = array();
		$data['websites'] = $websites;
		$data['type'] = $this->config->item('website_type');
		$data['countries'] = $countries;
		$data['states'] = $states;
		$data['counties'] = $counties;
		$data['cities'] = $cities;
		$data['zip'] = $zip;
		$data['industries'] = $industries;
		$this->load->view('search',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
