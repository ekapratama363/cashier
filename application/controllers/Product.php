<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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

        $this->load->model('Product_model');
    }

    public function QRCode($array_id = NULL)
    {   
        $products = [];

        foreach($array_id as $id) {
            $products[] = $this->Product_model->get_product_by_id($id);
        }

        $data['products'] = $products; 
        
        $this->load->library('Pdf');
        
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "ProductQRCode.pdf";

        $this->pdf->load_view("product/report/qrCode", $data);
        // $this->load->view("product/report/qrCode", $data);
    }
    
    public function index()
    {

        $data['page'] = 'product/index';

        $this->load->view('app', $data);
    }

    public function create()
    {
        $data['page'] = 'product/create';

        $this->load->view('app', $data);
    }

    public function edit($id = NULL)
    {
        $data['page'] = 'product/edit';
        
        $data['value'] = $this->Product_model->get_product_by_id($id);

        $this->load->view('app', $data);
    }

    public function ajax_by_id($id) 
    {
        $product = $this->Product_model->get_product_by_id($id);

        echo json_encode($product);
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'product/create';
            $this->load->view('app', $data);
        } else {
            $filename = $_FILES['image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $target_dir = "uploads/product/";
            $target_file = $target_dir . basename($filename);
        
            if (!$filename) {
                
                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    // 'icon' => $this->input->post('icon'),
                    'product_category_id' => $this->input->post('category'),
                    'image'     => '',//$_FILES['image']['name'],
                ];
                
                $this->Product_model->set_product($data);

                $this->session->set_flashdata('success', 'save data successfully');

                redirect(base_url("product/create"));

                // $message = 'The image filed is required.';

                // $this->session->set_flashdata('failed', $message);

                // redirect(base_url("product/create"));

            } elseif ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                
                $message = 'The filetype you are attempting to upload is not allowed.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("product/create"));
            
            } elseif ($_FILES["image"]["size"] > 2000000) {
                
                $message = 'Sorry, your file is too large.';

                $this->session->set_flashdata('failed', $message);

                redirect(base_url("product/create"));

            } else {
        
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                    $data = [
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        // 'icon' => $this->input->post('icon'),
                        'product_category_id' => $this->input->post('category'),
                        'image'     => $_FILES['image']['name'],
                    ];
                    
                    $this->Product_model->set_product($data);

                    $this->session->set_flashdata('success', 'save data successfully');
    
                    redirect(base_url("product/create"));

                } else {

                    $message = 'Upload image failed';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("product/create"));

                }
            }
            // $data = [
            //     'title' => $this->input->post('title'),
            //     'description' => $this->input->post('description'),
            //     // 'icon' => $this->input->post('icon'),
            //     'product_category_id' => $this->input->post('category'),
            //     // 'created_by' => 1,
            // ];
            
            // $this->Product_model->set_product_detail($data);

            // $this->session->set_flashdata('success', 'save data successfully');

            // redirect(base_url("product/create"));

        }
    }
        
    public function update()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['page'] = 'product/edit/'.$id;
            
            $this->load->view('app', $data);
        } else {

            $filename = $_FILES['image']['name'];

            if(!$filename) {

                $data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'product_category_id' => $this->input->post('category'),
                    // 'icon' => $this->input->post('icon'),
                    'image' => $this->input->post('image_hidden'), //$_FILES['image']['name'],
                ];

                $this->Product_model->update_product_by_id($id, $data);
                $this->session->set_flashdata('success', 'update data successfully');

                redirect(base_url("product/index"));

            } else {

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $target_dir = "uploads/product/";
                $target_file = $target_dir . basename($filename);
            
                if ($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif") {
                    
                    $message = 'The filetype you are attempting to upload is not allowed.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("product/index"));
                
                } elseif ($_FILES["image"]["size"] > 2000000) {
                    
                    $message = 'Sorry, your file is too large.';

                    $this->session->set_flashdata('failed', $message);

                    redirect(base_url("product/index"));

                } else {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $data = [
                            'title' => $this->input->post('title'),
                            'description' => $this->input->post('description'),
                            'product_category_id' => $this->input->post('category'),
                            // 'icon' => $this->input->post('icon'),
                            'image' => $_FILES['image']['name'],
                        ];
                        
                        $this->Product_model->update_product_by_id($id, $data);

                        $this->session->set_flashdata('success', 'save data successfully');
        
                        redirect(base_url("product/index"));

                    } else {

                        $message = 'Upload image failed';

                        $this->session->set_flashdata('failed', $message);

                        redirect(base_url("product/index"));

                    }
                }
            }

            // $data = [
            //     'title' => $this->input->post('title'),
            //     'description' => $this->input->post('description'),
            //     // 'icon' => $this->input->post('icon'),
            //     'product_category_id' => $this->input->post('category'),
            // ];

            // $this->Product_model->update_product_by_id($id, $data);
            // $this->session->set_flashdata('success', 'update data successfully');

            // redirect(base_url("product/index"));

        }
    }

    public function delete($id = NULL)
    {

        $message = 'Success delete data';

        $this->Product_model->delete_product_by_id($id);

        $this->session->set_flashdata('success', $message);

        redirect(base_url("product/index"));
        
    }

    public function ajax_product($q = NULL)
    {
        $q = $this->input->get('q') ? $this->input->get('q') : NULL;
        
        $data = $this->Product_model->ajax_get_product($q);

        echo json_encode($data);
    }

    public function ajax_list_product()
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

        $totalFiltered = count($this->Product_model->get_ajax_list_product($array));

        //check the length parameter and then take records
        if ($length > 0) {
            $array['start']  = $start;
            $array['length'] = $length;
        }

        $posts = $this->Product_model->get_ajax_list_product($array);

        if(sizeof($posts) > 0) {
            $no = $start;
            foreach($posts as $key => $value) {        
                $no++;

                $check_box = "<input type='checkbox' id='data' name='data[]' class='checkboxes' value='{$value->id}' />";
                
                $image = ($value->image != '') ? 
                            "<img src='" . base_url() . "uploads/product/" . $value->image . "' width='50px' height='50px'>" 
                            : "no image";
                $action = "
                    <a href='".base_url()."product/edit/".$value->id."' 
                        class='btn btn-success btn-sm' 
                        style='margin-right: 5px;' title='Edit'>
                        <i class='fa fa-pencil'></i>
                    </a>

                    <a onclick='".'return confirm("'."delete this item?".'")'."'
                        href='".base_url()."product/delete/".$value->id."' class='btn btn-danger btn-sm delete-list'>
                        <i class='fa fa-trash'></i>
                    </a>
                ";

                $posts[$key]->no = $no;
                $posts[$key]->check_box = $check_box;
                $posts[$key]->description = '<p data-toggle="tooltip" data-placement="bottom" title="'.$value->description.'">' . substr($value->description, 0, 20) . '...</p>';
                $posts[$key]->image = $image;
                $posts[$key]->action = $action;
            }
        }

        $json_data = [
            "start"            => $start,
            "length"            => $length,
            "draw"            => $draw,
            "recordsTotal"    => $totalFiltered,
            "recordsFiltered" => $totalFiltered,
            "data"            => $posts
        ];

        echo json_encode($json_data);
    }

    public function print_or_multiple_delete()
    {
        $type     = $this->input->post('type');
        $array_id = $this->input->post('data');

        if($type == 'print') {

            $this->QRCode($array_id);

        }

        if($type == 'delete') {

            $delete = $this->Product_model->update_product_by_array_id($array_id);

            if($delete) {
                $this->session->set_flashdata('success', 'delete data successfully');
                redirect(base_url("product/index"));
            } else {
                $this->session->set_flashdata('failed', 'delete data failed');
                redirect(base_url("product/index"));
            }
        }
    }

}