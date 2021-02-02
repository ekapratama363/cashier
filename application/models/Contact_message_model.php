<?php

class Contact_message_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();

    }
    
    public function get_contact_message()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('contact_message'); 

        return $query->result_object();
    }

    public function get_ajax_list_contact_message($data)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(contact_message.name LIKE \'%'.$match.'%\' 
                        or contact_message.subject LIKE \'%'.$match.'%\'
                        or contact_message.message LIKE \'%'.$match.'%\')')
                ->order_by('contact_message.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('contact_message');

        return $query->result_object();
    }

    public function set_contact_message($data) 
    {
        return $this->db->insert('contact_message', $data);
    }

    public function delete_contact_message_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('contact_message');
    }

    public function update_contact_message_by_array_id($id)
    {
        $query = $this->db->where_in('id', $id)->delete('contact_message');

        return $query;
    }

}