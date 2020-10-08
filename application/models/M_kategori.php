<?php
class M_kategori extends CI_Model{
 
        function get_barang(){
        $hasil=$this->db->query("SELECT * FROM tb_barang");
        return $hasil;
    }
 
    function get_barangmasuk($idbrg){
        $hasil=$this->db->query("SELECT * FROM barang_masuk WHERE id_barang='$idbrg'");
        return $hasil->result();
    }
}