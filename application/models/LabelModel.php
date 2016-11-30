<?php
/**
 * Describe: 标签模型
 * User: lufeng501206@gmail.com
 * Date: 2016-08-16 21:02
 */

class LabelModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 获取文章列表
     * @param bool $id
     * @return mixed
     */
    public function getLabelLists($isIdAsIndex = false)
    {
        $lists = array();
        $query = $this->db->get('t_label');
        $res = $query->result_array();
        if(!empty($res) && is_array($res)){
            foreach($res as $key => $value){
                $value['format_m_time'] = date("Y-m-d H:i:s",$value['m_time']);
                $value['format_update_time'] = date("Y-m-d H:i:s",$value['update_time']);
                if($isIdAsIndex){
                    $lists[$value['id']] = $value;
                }else{
                    $lists[] = $value;
                }
            }
        }
        return $lists;
    }

    public function addLabel($labelName)
    {
        $data['label_name'] = $labelName;
        $data['m_time'] = time();
        $data['update_time'] = time();
        return $this->db->insert('t_label',$data);
    }

    public function saveLabel($id,$labelName)
    {
        $data['label_name'] = $labelName;
        $data['update_time'] = time();
        return $this->db->update('t_label',$data,array('id' => $id));
    }

    public function deleteLabel($id)
    {
        return $this->db->delete('t_label',array('id' => $id));
    }
}