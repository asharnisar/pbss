<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

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
		
	} 
	 
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function login()
	{
		if($_POST) {   //clean public facing app input
            $identity = $this->input->post('login', true);
            $password = $this->input->post('password', true);

            //Ion_Auth Login fun
            if($this->ion_auth->login($identity,$password)) {

                //capture the user
                $user = $this->ion_auth->user()->row();

                redirect('admin/dashboard');

                /*redirect to the proper home
                  controller using the user
                  groups as folder names */
            }
			else
			{
				$this->session->set_flashdata(
                    'error',
                    'Your login attempt failed.'
                );
			}
		}
		
		$this->load->view('admin/login');
	}
	
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('admin/auth/login', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */