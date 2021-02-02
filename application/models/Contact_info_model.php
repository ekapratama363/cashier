<?php

class Contact_info_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_contact_info($data) 
    {
        return $this->db->insert('contact_info', $data);
    }

    public function get_contact_info()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('contact_info'); 

        return $query->result_object();
    }

    public function get_ajax_list_contact_info($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('contact_info');

        return $query->result_object();
    }

    public function get_contact_info_by_id($id)
    {
        $query = $this->db->get_where('contact_info', ['id' => $id]);

        return $query->row_object();
    }

    public function update_contact_info_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('contact_info', $data);

        return $query;
    }

    public function delete_contact_info_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('contact_info');
    }

}