<?php
/**
 * Describe: index模块
 * User: lufeng501206@gmail.com
 * Date: 2016-08-14 10:47
 */

class Index extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 首页重定向
     */
    public function index()
    {
        $this->load->helper('url');
        redirect('home/index/index');
    }
}