<?php
/**
 * Describe: index模块
 * User: lufeng501206@gmail.com
 * Date: 2016-08-14 10:47
 */

class Index extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('admin/pages/index');
    }
}