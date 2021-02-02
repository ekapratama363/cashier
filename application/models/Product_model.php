<?php

class Product_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function set_product($data) 
    {
        return $this->db->insert('product', $data);
    }

    public function ajax_product()
    {
        $query = $this->db->order_by('id', 'desc')
                ->get('product'); 

        return $query->row_object();
    }

    public function get_ajax_list_product($data = NULL)
    {
        
        $match = isset($data['search']) ? $data['search'] : '';
            
        $query = $this->db
                ->select('product.id, product.title, product.description, product.image,
                    product_category.description as product_category_description, product_category.category')
                ->from('product')
                ->join('product_category', 'product_category.id = product.product_category_id', 'left')
                ->where('(product.title LIKE \'%'.$match.'%\' 
                            or product.description LIKE \'%'.$match.'%\'
                            or product_category.category LIKE \'%'.$match.'%\')')
                // ->where('product_category.category', $data['category'])
                ->order_by('product.id', isset($data['order']) ? 'desc' : 'asc');
                
        if(isset($data['length']) && isset($data['start'])) {
            $query = $query->limit($data['length'], $data['start']);
        }

        $query = $query->get();

        return $query->result_object();
    }

    public function get_product_by_id($id)
    {
    
        $query = $this->db
                ->select('product.id, product.title, product.description, product.image, product.product_category_id,
                    product_category.description as product_category_description, product_category.category')
                ->from('product')
                ->join('product_category', 'product_category.id = product.product_category_id', 'left')
                ->where('product.id', $id)
                ->get();

        return $query->row_object();

        // $query = $this->db->get_where('product', ['id' => $id]);

        // return $query->row_object();
    }

    public function update_product_by_id($id, $data)
    {
        $query = $this->db->where('id', $id)->update('product', $data);

        return $query;
    }

    public function delete_product_by_id($id)
    {
        $this->db->where(['id' => $id]);
	    $this->db->delete('product');
    }

    public function ajax_get_product($q = NULL)
    {
        if($q) {
            $this->db->like('category', $q);
        } else {
            $this->db->limit(15);
        }

        $query = $this->db->get('product');

        return $query->result_object();
    }

    public function get_product($limit = NULL, $start = NULL, $category = NULL)
    {
        $query = $this->db
                ->select('product.id, product.title, product.description, product.image,
                    product_category.description as product_category_description, product_category.category,
                    product_category.slug')
                ->from('product')
                ->join('product_category', 'product_category.id = product.product_category_id', 'left')
                // ->where('(product.title LIKE \'%'.$match.'%\' 
                //             or product.description LIKE \'%'.$match.'%\'
                //             or product_category.category LIKE \'%'.$match.'%\')')
                ->where('product_category.slug', $category)
                ->order_by('product.id', 'desc')
                ->limit($limit, $start)
                ->get();
        
        return $query->result_object();
    }

    public function count_product($category = NULl)
    {
        $query = $this->db
                ->select('product.id, product.title, product.description, product.image,
                    product_category.description as product_category_description, product_category.category')
                ->from('product')
                ->join('product_category', 'product_category.id = product.product_category_id', 'left')
                // ->where('(product.title LIKE \'%'.$match.'%\' 
                //             or product.description LIKE \'%'.$match.'%\'
                //             or product_category.category LIKE \'%'.$match.'%\')')
                ->where('product_category.category', $category)
                ->order_by('product.id', 'desc')
                // ->limit($limit, $start);
                ->get();

        return $query->num_rows();

		// return $this->db->get('product')->num_rows();
	}

    public function update_product_by_array_id($id)
    {
        $query = $this->db->where_in('id', $id)->delete('product');

        return $query;
    }

}