<?php

class Call_us_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_call_us($data) 
    {
        return $this->db->insert('call_us', $data);
    }

    public function get_call_us()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('call_us'); 

        return $query->row_object();
    }

}