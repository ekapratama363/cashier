<?php

class Content_circle_center_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_content_circle_center($data) 
    {
        return $this->db->insert('content', $data);
    }

    public function ajax_get_content_circle_center($q = NULL, $data = NULL)
    {
        if($q) {
            $this->db->like('title', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get_where('content', $data);

        return $query->result_object();
    }

    public function get_ajax_list_content_circle_center($data = NULL)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\' 
                        or description LIKE \'%'.$match.'%\')')
                ->where('page', $data['page'])
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('content');

        return $query->result_object();
    }

    public function get_content_circle_center_by_id($id)
    {
        $query = $this->db->get_where('content', ['id' => $id]);

        return $query->row_object();
    }

    public function update_content_circle_center_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('content', $data);

        return $query;
    }

    public function delete_content_circle_center_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('content');
    }

    public function get_content_circle_center($data = NULL) 
    {
        $content = $this->db->get_where('content', $data);
        $content = $content->result_object();

        // $content_detail = $this->db->get_where('content_detail', ['content_id' => $content->id]);
        // $content_detail = $content_detail->result_object();

        // $content->content_detail = isset($content_detail) ? $content_detail : NULL;

        return $content;
    }

}