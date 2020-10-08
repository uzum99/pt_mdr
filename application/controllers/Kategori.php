<?php
class Kategori extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('M_kategori');
    }
    function index(){
        $x['data']=$this->m_kategori->get_kategori();
        $this->load->view('v_kategori',$x);
    }
 
    function get_barangmasuk(){
        $id=$this->input->post('idbrg');
        $data=$this->m_kategori->get_subkategori($id);
        echo json_encode($data);
    }
}