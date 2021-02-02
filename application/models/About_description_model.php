<?php

class About_description_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_about_description($data) 
    {
        return $this->db->insert('content', $data);
    }

    public function get_about_description($data = NULL)
    {
        $query = $this->db->order_by('id', 'desc')
                ->get_where('content', $data); 

        return $query->row_object();
    }

}