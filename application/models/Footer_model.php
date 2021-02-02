<?php

class Footer_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_footer($data) 
    {
        return $this->db->insert('footer', $data);
    }

    public function ajax_footer()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('footer'); 

        return $query->row_object();
    }

    public function get_ajax_list_footer($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('footer');

        return $query->result_object();
    }

    public function get_footer_by_id($id)
    {
        $query = $this->db->get_where('footer', ['id' => $id]);

        return $query->row_object();
    }

    public function update_footer_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('footer', $data);

        return $query;
    }

    public function delete_footer_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('footer');
    }

    public function ajax_get_footer($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('footer');

        return $query->result_object();
    }

    public function get_footer()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('footer'); 

        return $query->result_object();
    }

}