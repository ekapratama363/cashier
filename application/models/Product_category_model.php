<?php

class Product_category_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_product_category($data) 
    {
        return $this->db->insert('product_category', $data);
    }

    public function get_product_category_by_category($category)
    {
        $query = $this->db->get_where('product_category', $category); 

        return $query->row_object();
    }

    public function get_ajax_list_product_category($data = NULL)
    {
        $match = isset($data['search']) ? $data['search'] : '';
        
        $query = $this->db->where('(category LIKE \'%'.$match.'%\')')
                ->order_by('id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get('product_category');

        return $query->result_object();
    }

    public function get_product_category_by_id($id)
    {
        $query = $this->db->get_where('product_category', ['id' => $id]);

        return $query->row_object();
    }

    public function update_product_category_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('product_category', $data);

        return $query;
    }

    public function delete_product_category_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('product_category');
    }

    public function ajax_get_product_category($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('product_category');

        return $query->result_object();
    }

    public function get_product_category()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('product_category'); 

        return $query->result_object();
    }

}