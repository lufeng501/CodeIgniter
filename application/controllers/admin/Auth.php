<?php
/**
 * Describe: 
 * User: lufeng501206@gmail.com
 * Date: 2016-09-10 18:57
 */

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $this->load->helper('form');
        $this->load->view('admin/pages/login');
    }

    public function doLogin()
    {
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('account', 'Account', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $account = $_POST['account'];
        $password = $_POST['password'];
        if ($this->form_validation->run() == FALSE){
            $data['msg'] = "用户名或密码输入不合法";
            $this->load->view('admin/pages/login',$data);
        }
        else {
            if($account == "root" && $password == "lusion"){
                $this->setSeesion($account);
                redirect('admin/index/index');
            }else{
                $data['msg'] = "用户名或密码错误";
                $this->load->view('admin/pages/login',$data);
            }
        }
    }

    private function setSeesion($account)
    {
        $this->load->library('session');
        $this->session->account = $account;
    }

    public function doLogout(){
        $this->load->library('session');
        $this->session->unset_userdata('account');
        $this->login();
    }
}