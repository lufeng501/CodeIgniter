<?php
/**
 * Describe: 文章管理
 * User: lufeng501206@gmail.com
 * Date: 2016-08-14 23:13
 */

class ArticleManager extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取文章列表
     */
    public function index()
    {
        $this->load->view('admin/pages/article-manager');
    }

    /**
     * markdown 文章编辑
     * @param bool $id
     */
    public function markdown($id=false)
    {
        if(!empty($id)){
            $data['hander_type'] = 2;
            $data['article_info'] =  $this->ArticleModel->getArticleById($id);
        }else{
            $data['hander_type'] = 1;
            $data['article_info'] =  array();
        }
        $data['label_lists'] = $this->LabelModel->getLabelLists();
        $this->load->view('admin/pages/article-markdown',$data);
    }

    public function editor()
    {
        $this->load->view('admin/pages/mardown-editor');
    }

    public function getArticleLists()
    {
        $lists = $this->ArticleModel->getArticleLists();
        echo json_encode($lists);
    }

    public function addArticle()
    {
        $postData = $_POST;
        $newData['title'] = $postData['title'];
        $newData['labels'] = $postData['labels'];
        $newData['md_content'] = $postData['md_content'];
        $newData['html_content'] = $postData['html_content'];
        $newData['outline'] = $postData['outline'];
        $res = $this->ArticleModel->addArticle($newData);
        if($res){
            echoSuccess("新增文章成功");
        }else{
            echoError("新增文章失败");
        }
    }

    public function saveArticle()
    {
        $postData = $_POST;
        $updateData['title'] = $postData['title'];
        $updateData['labels'] = $postData['labels'];
        $updateData['md_content'] = $postData['md_content'];
        $updateData['html_content'] = $postData['html_content'];
        $updateData['outline'] = $postData['outline'];
        $res = $this->ArticleModel->saveArticle($postData['id'],$updateData);
        if($res){
            echoSuccess("更新文章成功");
        }else{
            echoError("更新文章失败");
        }
    }

    public function deleteArticle()
    {
        $articleId = $_GET['article_id'];
        $res = $this->ArticleModel->deleteArticle($articleId);
        if($res) {
            echoSuccess("删除成功");
        }else{
            echoError("删除失败");
        }
    }
}