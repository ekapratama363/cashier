<?php

class Home_banner_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_home_banner($data) 
    {
        return $this->db->insert('home_banner', $data);
    }

    public function get_home_banner()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('home_banner'); 

        return $query->result_object();
    }

    public function get_ajax_list_home_banner($data = NULL)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(title LIKE \'%'.$match.'%\' 
                        or description LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('home_banner');

        return $query->result_object();
    }

    public function get_home_banner_by_id($id)
    {
        $query = $this->db->get_where('home_banner', ['id' => $id]);

        return $query->row_object();
    }

    public function update_home_banner_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('home_banner', $data);

        return $query;
    }

    public function delete_home_banner_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('home_banner');
    }

}