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
		$this->load->view('admin/dashboard');
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
        $data['output'] = $this->grocery_crud->render();
		$data['title'] = "All Users";
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