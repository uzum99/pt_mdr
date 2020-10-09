<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pelaporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_laporan");
        $this->load->database();
    }

    function index()
    {
        $this->load->view('excel_import');
    }
    public function pelaporan()
    {
        $jk = $this->input->post("jenis");
        $bulan = $this->input->post("bulan");
        if($jk == null || $bulan == null) {

            $data['barang_masuk'] = $this->db->query("SELECT * FROM barang_masuk")->result(); //yang belakang itu db
            $this->load->view("v_pelaporan", $data);
        }else{
            $data['barang_masuk'] = $this->db->query("SELECT * FROM barang_masuk WHERE jenis='$jenis' AND MONTH(tanggal_masuk)='$bulan'")->result();
            $this->load->view("v_pelaporan", $data);
        }
    }
    public function laporanpenjualan()
    {

        $param['pageInfo'] = "List Penjualan";
        $this->template->load("laporan/v_penjualan2", $param);
    }
    public function laporanbukubesar()
    {

        $param['pageInfo'] = "List Buku Besar";
        $this->template->load("laporan/v_bukubesar", $param);
    }
    public function laporanlabarugi()
    {

        $param['pageInfo'] = "List Buku Besar";
        $this->template->load("laporan/v_labarugi", $param);
    }

    public function getPelaporan()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->M_laporan->getPelaporan($postData);

        echo json_encode($data);
    }
    public function getpenjualan()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->M_laporan->getPenjualan($postData);

        echo json_encode($data);
    }
    public function getbukubesar()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->M_laporan->getBukubesar($postData);

        echo json_encode($data);
    }
    public function getlabarugi()
    {
        // POST data
        $postData = $this->input->post();
        // Get data
        $data = $this->M_laporan->getLabarugi($postData)[0];

        header('content-type:json/application');
        echo json_encode($data);
    }


}
