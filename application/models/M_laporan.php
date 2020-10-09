<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{


    function getPembelian($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tglawal = $postData['tglawal'];
        $tglakhir = $postData['tglakhir'];




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records  = $this->db->get('pembelian')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('tanggal_pembelian >=', $tglawal);
        $this->db->where('tanggal_pembelian <=', $tglakhir);
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records  = $this->db->get('pembelian')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->where('tanggal_pembelian >=', $tglawal);
        $this->db->where('tanggal_pembelian <=', $tglakhir);
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records  = $this->db->get('pembelian')->result();

        $this->db->select('*');
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=pembelian.id_admin');
        $records2  = $this->db->get('pembelian')->result();

        $data = array();
        if ($tglawal ==  null || $tglakhir == null) {
            foreach ($records2 as $record) {


                $data[] = array(
                    "kode_pembelian" => $record->kode_pembelian,
                    "tanggal_pembelian" => $record->tanggal_pembelian,
                    "total" => $record->total,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        } else {
            foreach ($records as $record) {


                $data[] = array(
                    "kode_pembelian" => $record->kode_pembelian,
                    "tanggal_pembelian" => $record->tanggal_pembelian,
                    "total" => $record->total,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }


    function getPenjualan($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $tglawal = $postData['tglawal'];
        $tglakhir = $postData['tglakhir'];




        ## Search 


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records  = $this->db->get('penjualan')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('tanggal_penjualan >=', $tglawal);
        $this->db->where('tanggal_penjualan <=', $tglakhir);
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records  = $this->db->get('penjualan')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->where('tanggal_penjualan >=', $tglawal);
        $this->db->where('tanggal_penjualan <=', $tglakhir);
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records  = $this->db->get('penjualan')->result();

        $this->db->select('*');
        $this->db->limit($rowperpage, $start);
        $this->db->join('admin', 'admin.id_admin=penjualan.id_admin');
        $records2  = $this->db->get('penjualan')->result();

        $data = array();
        if ($tglawal ==  null || $tglakhir == null) {
            foreach ($records2 as $record) {


                $data[] = array(
                    "kode_penjualan" => $record->kode_penjualan,
                    "tanggal_penjualan" => $record->tanggal_penjualan,
                    "nama_pembeli" => $record->nama_pembeli,
                    "total_qty" => $record->total_qty,
                    "total_penjualan" => $record->total_penjualan,
                    "total_bayar" => $record->total_bayar,
                    "potongan" => $record->potongan,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        } else {
            foreach ($records as $record) {


                $data[] = array(
                    "kode_penjualan" => $record->kode_penjualan,
                    "tanggal_penjualan" => $record->tanggal_penjualan,
                    "nama_pembeli" => $record->nama_pembeli,
                    "total_qty" => $record->total_qty,
                    "total_penjualan" => $record->total_penjualan,
                    "total_bayar" => $record->total_bayar,
                    "potongan" => $record->potongan,
                    "username" => $record->username,
                    "keterangan" => $record->keterangan
                );
            }
        }



        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    function getpelaporan($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $bulan = $postData['bulan'];
        $jenis = $postData['jenis'];


        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records  = $this->db->get('tb_pelamar')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($bulan != '' || $jk != '')
            $this->db->where('jenis', $jenis);
        $this->db->where('MONTH(tanggal_masuk)', $bulan);
        $records  = $this->db->get('barang_masuk')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($bulan != '' || $jk != '')
            $this->db->where('jenis', $jenis);
        $this->db->where('MONTH(tanggal_masuk)', $bulan);
        $this->db->order_by('barang_masuk.id_barang_masuk');
        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('barang_masuk')->result();


        $this->db->select('*');
        $this->db->order_by('barang_masuk.id_barang_masuk');
        $this->db->limit($rowperpage, $start);
        $records2  = $this->db->get('barang_masuk')->result();

        



        $data = array();

        // if ($bulan ==  null || $jk == null) {
        //     foreach ($records2 as $record) {


        //         $data[] = array(
        //             "id_pelamar" => $record->id_pelamar,
        //             "TglDaftar_pelamar" => $record->TglDaftar_pelamar,
        //             "nama_pelamar" => $record->nama_pelamar,
        //             "tgllahir_pelamar" => $record->tgllahir_pelamar,
        //             "umur_pelamar" => $record->umur_pelamar,
        //             "jk_pelamar" => $record->jk_pelamar,
        //             "alamat_pelamar" => $record->alamat_pelamar,
        //             "agama_pelamar" => $record->agama_pelamar,
        //             "nohp_pelamar" => $record->nohp_pelamar,
        //             "status_pelamar" => $record->status_pelamar,
        //             "pdkterakhir_pelamar" => $record->pdkterakhir_pelamar,
        //             "jurusan_pelamar" => $record->jurusan_pelamar,
        //             "asalsekolah_pelamar" => $record->asalsekolah_pelamar,
        //             "Foto_pelamar" => $record->Foto_pelamar
        //         );
        //     }
        // } else {
            foreach ($records as $record) {


                $data[] = array(
                    "id_barang_masuk" => $record->id_barang_masuk,
                    "id_barang" => $record->id_barang,
                    "tanggal_masuk" => $record->tanggal_masuk,
                    "jumlah_masuk" => $record->jumlah_masuk,
                    "satuan" => $record->satuan,
                    "jenis" => $record->jenis
                );
            }
        // }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }
    function getLabarugi($postData = null)
    {

        $response = array();

        ## Read value
/*         $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
 */
        // Custom search filter 
        // $searchSuplier = $postData['searchSuplier'];
        // $searchNama = $postData['searchNama'];
        $bulan = $postData['bulan'];
        $tahun = $postData['tahun'];

        $tanggal = $tahun . '-' . $bulan . '-01';

        // ## Search 
        // $search_arr = array();
        // $searchQuery = "";
        // if ($searchValue != '') {
        //     $search_arr[] = " (nama_pengeluaran like '%" . $searchValue . "%'  ) ";
        // }
        // // if ($searchSuplier != '') {
        // //     $search_arr[] = " nama_suplier='" . $searchSuplier . "' ";

        // if ($searchTahun != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchTahun . "%' ";
        // }        // }

        // if ($searchBulan != '') {
        //     $search_arr[] = " tgl_pengeluaran like'%" . $searchBulan . "%' ";
        // }
        // if (count($search_arr) > 0) {
        //     $searchQuery = implode(" and ", $search_arr);
        // }

/*         ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records  = $this->db->get('buku_besar')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $records  = $this->db->get('buku_besar')->result();
        $totalRecordwithFilter = $records[0]->allcount;
 */
        ## Fetch records
        $this->db->select('*');
        if ($bulan != '' || $tahun != '')
            $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->order_by('buku_besar.id_bukubesar');
//        $this->db->limit($rowperpage, $start);
        $records  = $this->db->get('buku_besar')->result();

        // $this->db->select('*');
        $this->db->select('SUM(buku_besar.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('jenis', 'kredit');
        $this->db->where('tanggal <', $tanggal);
        $totalKredit  = $this->db->get('buku_besar')->result();

        $this->db->select('SUM(penjualan.total_penjualan) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_penjualan)', $tahun);
        $this->db->where('MONTH(tanggal_penjualan)', $bulan);
        $penjualan  = $this->db->get('penjualan')->result();


        $this->db->select('SUM(pembelian.total) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_pembelian)', $tahun);
        $this->db->where('MONTH(tanggal_pembelian)', $bulan);
        $pembelian  = $this->db->get('pembelian')->result();

        $this->db->select('SUM(penjualan.potongan) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('YEAR(tanggal_penjualan)', $tahun);
        $this->db->where('MONTH(tanggal_penjualan)', $bulan);
        $potongan  = $this->db->get('penjualan')->result();

        $this->db->select('SUM(buku_besar.nominal) as total');
        // $this->db->limit($rowperpage, $start);
        $this->db->where('jenis', 'debit');
        $this->db->where('tanggal <', $tanggal);
        $totalDebit  = $this->db->get('buku_besar')->result();



        $data = array();

        $saldoAwal = $totalDebit[0]->total - $totalKredit[0]->total;
        $totalpenjualan = $penjualan[0]->total-$potongan[0]->total;
        $returnpenjualan = 0;
        $returnpembelian = 0;
        $potonganpembelian = 0;
        $pembelianbersih = $pembelian[0]->total-$returnpembelian-$potonganpembelian;
        $totalpersediaan = $totalDebit[0]->total+$pembelian[0]->total;
        $persediaanakhir = $totalDebit[0]->total-$totalpenjualan;
        $hpp = $totalpersediaan-$persediaanakhir;
        $data[] = array(
            "penjualan" => $penjualan[0]->total,
            "potongan_penjualan" => $potongan[0]->total,
            "return_penjualan" => $returnpenjualan,
            "total_penjualan" => $totalpenjualan,
            "pembelian" => $pembelian[0]->total,
            "potongan_pembelian" => $potonganpembelian,
            "return_pembelian" => $returnpembelian,
            "pembelian_bersih" => $pembelianbersih,
            "persediaan_awal" => $totalDebit[0]->total,
            "total_persediaan" => $totalpersediaan,
            "persediaan_akhir" =>  $persediaanakhir,
            "hpp" => $hpp,
            "laba_rugi" => $totalpenjualan-$hpp
        );


        


        ## Response
/*         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
 */
        return $data;
    }
   
   
}
