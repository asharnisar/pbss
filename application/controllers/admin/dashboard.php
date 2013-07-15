<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			redirect('admin/auth/login', 'refresh');
		}
		elseif(!$this->ion_auth->is_admin())
		{
			redirect('../welcome', 'refresh');
		}
	}	
	 
	public function index()
	{
		//$this->load->view('admin/dashboard');
		$this->users();
	}
	
	public function users()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_table('users')
						->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');
		$this->grocery_crud->unset_add();
		$this->grocery_crud->unset_edit();
		$this->grocery_crud->unset_delete();				
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "All Users";
		$this->load->view('admin/users',$data);
	}
	
	function industry()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->set_table('industries');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "Industries";
		$this->load->view('admin/users',$data);
	}
	
	function websites()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->display_as('type_id','Type');
		$this->grocery_crud->set_table('websites');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $this->grocery_crud->set_relation('type_id','website_type','type_name');
		$data['output'] = $this->grocery_crud->render();
		$data['title'] = "Websites";
		$this->load->view('admin/users',$data);
	}
	
	function city_zip()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->set_table('cities_zip');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "City & Zip Code";
		$this->load->view('admin/users',$data);
	}
	
	function country()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		//$this->grocery_crud->display_as('country_name','Countries');
		$this->grocery_crud->set_table('countries');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "Countries";
		$this->load->view('admin/users',$data);
	}
	
	function state()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->display_as('country_id','Country');
		$this->grocery_crud->set_table('states');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $this->grocery_crud->set_relation('country_id','countries','country_name');
		$data['output'] = $this->grocery_crud->render();
		$data['title'] = "States";
		$this->load->view('admin/users',$data);
	}
	
	function county()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->display_as('state_id','State');
		$this->grocery_crud->set_table('counties');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $this->grocery_crud->set_relation('state_id','states','state_name');
		$data['output'] = $this->grocery_crud->render();
		$data['title'] = "Counties";
		$this->load->view('admin/users',$data);
	}
	
	function city()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->display_as('county_id','County');
		$this->grocery_crud->set_table('cities');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $this->grocery_crud->set_relation('county_id','counties','county_name');
		$data['output'] = $this->grocery_crud->render();
		$data['title'] = "Cities";
		$this->load->view('admin/users',$data);
	}
	
	function zip()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		//$this->grocery_crud->unset_jquery();
		$this->grocery_crud->display_as('city_id','City');
		$this->grocery_crud->set_table('zip_codes');
						/*->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');*/
		//$this->grocery_crud->unset_add();				
        $this->grocery_crud->set_relation('city_id','cities','city_name');
		$data['output'] = $this->grocery_crud->render();
		$data['title'] = "Zip Codes";
		$this->load->view('admin/users',$data);
	}
	
	public function bos()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_table('users')
						->columns('username','email')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');
		$this->grocery_crud->unset_add();				
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "BOS";
		$this->load->view('admin/users',$data);
	}
	
		
	public function pos()
	{
		$data = array();
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_table('users')
						->columns('id','username','email','groups')
						->display_as('username','User Name')
						->display_as('email','Email Addresss');
		$this->grocery_crud->set_relation('id','users_groups','user_id');				
		//$this->grocery_crud->set_relation_n_n('groups', 'users_groups', 'groups','user_id','group_id','name');				
		//debug($this->db->last_query());
		$this->grocery_crud->unset_add();				
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "POS";
		$this->load->view('admin/users',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
