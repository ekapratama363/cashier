<?php

class Vission_mission_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_vission_mission($data) 
    {
        return $this->db->insert('content', $data);
    }

    public function ajax_get_vission_mission($q = NULL, $data = NULL)
    {
        if($q) {
            $this->db->like('title', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get_where('content', $data);

        return $query->result_object();
    }

    public function get_ajax_list_vission_mission($data = NULL)
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

    public function get_vission_mission_by_id($id)
    {
        $query = $this->db->get_where('content', ['id' => $id]);

        return $query->row_object();
    }

    public function update_vission_mission_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('content', $data);

        return $query;
    }

    public function delete_vission_mission_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('content');
    }

    public function get_vission_mission($data = NULL) 
    {
        $content = $this->db->get_where('content', $data);
        $content = $content->row_object();

        $content_detail = $this->db->get_where('content_detail', ['content_id' => $content->id]);
        $content_detail = $content_detail->result_object();

        $content->content_detail = isset($content_detail) ? $content_detail : NULL;

        return $content;
    }

}