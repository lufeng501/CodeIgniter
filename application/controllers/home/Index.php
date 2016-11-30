<?php
/**
 * Describe: index模块
 * User: lufeng501206@gmail.com
 * Date: 2016-08-14 10:47
 */

class Index extends CI_Controller {

    public function __construct()
    {
        $this->perPage = 5; //每页5条数据
        parent::__construct();
    }

    public function index($start = 0)
    {
        $label = isset($_GET['label']) ? $_GET['label'] : null;
        $limit = $this->perPage;
        $countNums = $this->ArticleModel->countArticle($label);
//        $maxPage =  (intval($countNums % $limit) == 0) ? intval($countNums / $limit) : intval($countNums / $limit) + 1;
        $data['pre'] = ($start - $limit) >= 0 ? ($start - $limit) : 0;
        $data['now_page'] = $start;
        $data['next'] = ($start + $limit) < $countNums ? ($start + $limit) : $start;
        $data['label'] = $label;
        $data['lists'] = $this->ArticleModel->getArticleLists(false,$start,$limit,$label);
        $data['label_lists'] = $this->LabelModel->getLabelLists();
        _debug($data['label_lists']);
        $this->load->view('home/pages/index',$data);
    }

    public function show($id)
    {
        $data['article_info'] =  $this->ArticleModel->getArticleById($id);
        $this->load->view('home/pages/article-detail',$data);
    }
}