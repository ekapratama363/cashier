<?php

class Vission_mission_detail_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_vission_mission_detail($data) 
    {
        return $this->db->insert('content_detail', $data);
    }

    public function ajax_vission_mission_detail()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('content_detail'); 

        return $query->row_object();
    }

    public function get_ajax_list_vission_mission_detail($data)
    {
        
        $match = isset($data['search']) ? $data['search'] : '';
            
        $query = $this->db
                ->select('content_detail.id, content_detail.title, content_detail.description, content_detail.image,
                    content.title as content_title, content.page')
                ->from('content_detail')
                ->join('content', 'content.id = content_detail.content_id', 'left')
                ->where('(content.title LIKE \'%'.$match.'%\' 
                            or content_detail.title LIKE \'%'.$match.'%\'
                            or content_detail.description LIKE \'%'.$match.'%\')')
                ->where('page', $data['page'])
                ->order_by('content_detail.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get();

        return $query->result_object();
    }

    public function get_vission_mission_detail_by_id($id)
    {
    
        $query = $this->db
                ->select('content_detail.id, content_detail.content_id, content_detail.title, content_detail.description, content_detail.image,
                    content.title as content_title, content.page')
                ->from('content_detail')
                ->join('content', 'content.id = content_detail.content_id', 'left')
                ->where('content_detail.id', $id)
                ->get();

        return $query->row_object();

        // $query = $this->db->get_where('content_detail', ['id' => $id]);

        // return $query->row_object();
    }

    public function update_vission_mission_detail_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('content_detail', $data);

        return $query;
    }

    public function delete_vission_mission_detail_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('content_detail');
    }

    public function ajax_get_vission_mission_detail($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('content_detail');

        return $query->result_object();
    }

    public function get_vission_mission_detail()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('content_detail'); 

        return $query->result_object();
    }

}