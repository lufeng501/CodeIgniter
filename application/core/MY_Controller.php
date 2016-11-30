<?php
/**
 * Describe: 
 * User: lufeng501206@gmail.com
 * Date: 2016-09-10 18:50
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->checkLogin()){
            $this->load->helper('url');
            redirect('admin/auth/login');
        }
    }

    private function checkLogin()
    {
        $this->load->library('session');
        $account = $this->session->account;
        if($account){
            return true;
        }else{
            return false;
        }
    }
}