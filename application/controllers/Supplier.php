<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
		if($this->session->userdata('is_login') != "true"){
			redirect(base_url("auth/login"));
        }
        
        // for load helper
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('Product_category_model');
    }
    
    public function index()
    {
        $data['page'] = 'supplier/index';

        $this->load->view('app', $data);
    }

    public function create()
    {
        $data['page'] = 'supplier/create';

        $this->load->view('app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'supplier/edit';
        
        $data['value'] = $this->Product_category_model->get_product_category_by_id($id);

        $this->load->view('app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'supplier/create';
            $this->load->view('app', $data);
        } else {
            $filename = $_FILES['image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/supplier/";
            $target_file = $target_dir . basename($filename);
        
            if (!$filename) {
                
                $data = [
                    'category' => $this->input->post('category'),
                    'slug' => $this->slug($this->input->post('category')),
                    'description' => $this->input->post('description'),  
                    'image'     => '',//$_FILES['image']['name'],
                ];
                
                $this->Product_category_model->set_product_category($data);

                $this->session->set_flashdata('success', 'save data successfully');

                redirect(base_url("supplier/create"));

                // $message = 'The image filed is required.';

                // $this->session->set_flashdata('failed', $message);

                // redirect(base_url("supplier/create"));

            } elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                
                $message = 'The filetype you are attempting to upload is not allowed.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("supplier/create"));
            
            } elseif ($_FILES["image"]["size"] > 2000000) {
                
                $message = 'Sorry, your file is too large.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("supplier/create"));

            } else {
        
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                    $data = [
                        'category' => $this->input->post('category'),
                        'slug' => $this->slug($this->input->post('category')),
                        'description' => $this->input->post('description'),
                        
                        
                        'image'     => $_FILES['image']['name'],
                    ];
                    
                    $this->Product_category_model->set_product_category($data);

                    $this->session->set_flashdata('success', 'save data successfully');
    
                    redirect(base_url("supplier/create"));

                } else {

                    $message = 'Upload image failed';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("supplier/create"));

                }
            }
            // $data = [
            //     'category' => $this->input->post('category'),
            //     'description' => $this->input->post('description'),
            //     // 'created_by' => 1,
            // ];
            
            // $this->Product_category_model->set_product_category($data);

            // $this->session->set_flashdata('success', 'save data successfully');

            // redirect(base_url("supplier/create"));

        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'supplier/edit/'.$id;
            
            $this->load->view('app', $data);
        } else {

            $filename = $_FILES['image']['name'];

            if(!$filename) {

                $data = [
                    'category' => $this->input->post('category'),
                    'slug' => $this->slug($this->input->post('category')),
                    'description' => $this->input->post('description'),
                    'image' => $this->input->post('image_hidden'), //$_FILES['image']['name'],
                ];

                $this->Product_category_model->update_product_category_by_id($id, $data);
                $this->session->set_flashdata('success', 'update data successfully');

                redirect(base_url("supplier/index"));

            } else {

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $target_dir = "uploads/supplier/";
                $target_file = $target_dir . basename($filename);
            
                if ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                    
                    $message = 'The filetype you are attempting to upload is not allowed.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("supplier/index"));
                
                } elseif ($_FILES["image"]["size"] > 2000000) {
                    
                    $message = 'Sorry, your file is too large.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("supplier/index"));

                } else {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $data = [
                            'category' => $this->input->post('category'),
                            'slug' => $this->slug($this->input->post('category')),
                            'description' => $this->input->post('description'),    
                            'image' => $_FILES['image']['name'],
                        ];
                        
                        $this->Product_category_model->update_product_category_by_id($id, $data);

                        $this->session->set_flashdata('success', 'save data successfully');
        
                        redirect(base_url("supplier/index"));

                    } else {

                        $message = 'Upload image failed';

                        $this->session->set_flashdata('failed', $message);

                        redirect(base_url("supplier/index"));

                    }
                }
            }
            // $data = [
            //     'category' => $this->input->post('category'),
            //     'description' => $this->input->post('description'),
            // ];

            // $this->Product_category_model->update_product_category_by_id($id, $data);
            // $this->session->set_flashdata('success', 'update data successfully');

            // redirect(base_url("supplier/index"));

        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Product_category_model->delete_product_category_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("supplier/index"));
        
    }

    public function ajax_product_category($q = NULL)
    {
        $q = $this->input->get('q') ? $this->input->get('q') : NULL;
        
        $data = $this->Product_category_model->ajax_get_product_category($q);

        echo json_encode($data);
    }

    public function ajax_list_product_category()
    {
        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length');

        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';
        
        $array = [];
        if($searchTerms) {
            foreach($searchTerms as $searchTerm){
                $array['search'] = $searchTerm;
            }
        }

        if ($dir === 'asc') {
            $array['order'] = 'desc';
        }

        $totalFiltered = count($this->Product_category_model->get_ajax_list_product_category($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Product_category_model->get_ajax_list_product_category($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                $image = "<img src='" . base_url() . "uploads/supplier/" . $value->image . "' width='50px' height='50px'>";
                
                $action = "
                    <a href='".base_url()."supplier/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."supplier/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
                        <i class='fa fa-trash'></i>
                    </a>
                ";

                $posts[$key]->no = $no;
                $posts[$key]->description = '<p data-toggle="tooltip" data-placement="bottom" title="'.$value->description.'">' . substr($value->description, 0, 20) . '...</p>';
                
                $posts[$key]->image = $image;
                $posts[$key]->action = $action;
            }
        }

        $json_data = [
            "draw"            => $draw,
            "recordsTotal"    => $totalFiltered,
            "recordsFiltered" => $totalFiltered,
            "data"            => $posts
        ];

        echo json_encode($json_data);
    }

    public function slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        {
            return 'n-a';
        }
        return $text;
    }

}