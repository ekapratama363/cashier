<?php

class Content_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_content($data) 
    {
        return $this->db->insert('content', $data);
    }

    public function ajax_get_content($q = NULL)
    {
        if($q) {
            $this->db->like('title', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('content');

        return $query->result_object();
    }


    public function get_ajax_list_content($data = NULL)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\' 
                        or description LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('content');

        return $query->result_object();
    }

    public function get_content_by_id($id)
    {
        $query = $this->db->get_where('content', ['id' => $id]);

        return $query->row_object();
    }

    public function update_content_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('content', $data);

        return $query;
    }

    public function delete_content_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('content');
    }

    public function get_content($data = NULL) 
    {
        $content = $this->db->order_by('id', 'desc')->get_where('content', $data);
        $content = $content->row_object();

        $content_id = isset($content->id) ? $content->id : NULL;

        $content_detail = $this->db->get_where('content_detail', ['content_id' => $content_id]);
        $content_detail = $content_detail->result_object();

        if($content_detail) {
            $content->content_detail = isset($content_detail) ? $content_detail : NULL;
        }

        return $content;
    }

}