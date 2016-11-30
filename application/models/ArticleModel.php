<?php
/**
 * Describe: 文章模型
 * User: lufeng501206@gmail.com
 * Date: 2016-08-14 23:13
 */

class ArticleModel extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取文章列表
     * @return mixed
     */
    public function getArticleLists($isIdAsIndex = false,$start=false,$limit=false,$label=false)
    {
        $lists = array();
        $labelLists = $this->LabelModel->getLabelLists(true);
        if($start !== false && $limit !== false){
            $this->db->limit($limit,$start);
        }
        if($label){
            $this->db->where("labels",$label);
        }
        $query = $this->db->get('t_article');
        $res = $query->result_array();
        if(!empty($res) && is_array($res)){
            foreach($res as $key => $value){
                $value['format_m_time'] = date("Y-m-d H:i:s",$value['m_time']);
                $value['format_update_time'] = date("Y-m-d H:i:s",$value['update_time']);
                $value['label_name'] = $labelLists[$value['labels']]['label_name'];
                if($isIdAsIndex){
                    $lists[$value['id']] = $value;
                }else{
                    $lists[] = $value;
                }
            }
        }
        return $lists;
    }

    public function countArticle($label=false){
        if($label){
            $this->db->where("labels",$label);
        }
        return $this->db->count_all_results('t_article');
    }

    public function getArticleById($id){
        $lists = $this->getArticleLists(true);
        return $lists[$id];
    }

    public function addArticle($data){
        $newData = $data;
        $newData['m_time'] = time();
        $newData['update_time'] = time();
        return $this->db->insert('t_article',$newData);
    }

    public function saveArticle($id,$data){
        $updateData = $data;
        $updateData['update_time'] = time();
        return $this->db->update('t_article',$updateData,array('id' => $id));
    }

    public function deleteArticle($id)
    {
        return $this->db->delete('t_article',array('id' => $id));
    }
}