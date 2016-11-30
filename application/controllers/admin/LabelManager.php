<?php
/**
 * Describe: 标签管理
 * User: lufeng501206@gmail.com
 * Date: 2016-08-16 20:59
 */

class LabelManager extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('admin/pages/label-manager');
    }

    /**
     * 获取标签列表api
     */
    public function getLabelLists()
    {
        $lists = $this->LabelModel->getLabelLists();
        echo json_encode($lists);
    }

    /**
     * 新增标签
     */
    public function addLabel()
    {
        $postData = $_POST;
        $res = $this->LabelModel->addLabel($postData['label_name']);
        if($res){
            echoSuccess("新增标签成功");
        }else{
            echoError("新增标签失败");
        }
    }

    /**
     * 保存标签
     */
    public function saveLabel()
    {
        $postData = $_POST;
        $res = $this->LabelModel->saveLabel($postData['id'],$postData['label_name']);
        if($res){
            echoSuccess("保存标签成功");
        }else{
            echoError("保存标签失败");
        }
    }

    /**
     * 删除标签
     */
    public function deleteLabel()
    {
        $labelId = $_GET['label_id'];
        //删除标签前先判断标签是否关联文章
        $labelRelatedArticlesNum = $this->ArticleModel->countArticle($labelId);
        if($labelRelatedArticlesNum) {
            echoSuccess("标签有关联文章，无法删除");
            die;
        }
        $res = $this->LabelModel->deleteLabel($labelId);
        if($res) {
            echoSuccess("删除成功");
        }else{
            echoError("删除失败");
        }
    }
}