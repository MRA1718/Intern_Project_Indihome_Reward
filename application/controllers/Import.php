<?php
defined('BASEPATH') or exit('No direct script access allowed');

class import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('import_model');
        $this->load->library('form_validation');
        $this->load->library('excel');
        $this->load->library('IOFactoryExc');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') != 'Administrator') {
            redirect('leaderboard');
        }
    }

    function index()
    {
        $data['title'] = 'Import PS';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('import/index');
        $this->load->view('templates/home_footer');
    }

    function ps_bulanan()
    {
        $data['title'] = 'Import PS';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('import/ps_bulanan');
        $this->load->view('templates/home_footer');
    }

    public function import_ps_harian()
    {

        /*$this->form_validation->set_rules('file', 'File', 'required');
        $this->form_validation->set_rules('multip_point', 'Multiplier Point', 'required');

        if($this->form_validation->run() == FAlSE)
        {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan");  
            redirect('import');
        }*/

        //initiate upload file
        $random = "file_upload_".rand(11111,99999);
        $filename = $random.basename($_FILES['file']['name']);

        $config['upload_path'] = './assets/';
        $config['file_name'] = $filename;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        //upload file & error handling
        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger m-0 p-1" role="alert">Import Data PS Gagal, Tidak dapat meng-upload file</div>');
            unlink($inputFileName);
            redirect('import');
        }

        //membuka file upload & proses count
        $inputFileName = './assets/' . $filename;

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            /*die('Error loading file"' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());*/
            $this->session->set_flashdata('message', '<div class="alert alert-danger m-0 p-1" role="alert">Import Data PS Gagal, Tidak dapat membaca file</div>');
            unlink($inputFileName);
            redirect('import');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $orderid = $rowData[0][5];
            //Mengubah format data date
            $olddate = (($rowData[0][16]) - 25569.0833333333) * 86400;
            $newdate = date("Y-m-d", $olddate);

            //Mengamil kode sales dari Kconnect
            /*$sparray = explode(";", $rowData[0][20]);*/

            //Kondisi untuk input dari My Indihome
            if (strpos($rowData[0][20], 'MI') !== false and strpos($rowData[0][20], 'CUST') !== false) {
                continue;
            } elseif (strpos($rowData[0][20], 'MI') !== false and strpos($rowData[0][20], '_') !== false) {
                $kconn = substr($rowData[0][20], 24, 7);
            } elseif (strpos($rowData[0][20], 'MI') !== false) {
                $kconn = substr($rowData[0][20], 23, 7);
                //$kconn = $rowData[0][20];
            }

            //Kondisi untuk input dari SC
            if (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'PLS') !== false) {
                continue;
            } elseif (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'SPKJR') !== false) {
                $kconn = substr($rowData[0][20], 17, 7);
            } elseif (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'AOSF') !== false) {
                continue;
            } elseif (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'SPYNR') !== false) {
                $kconn = substr($rowData[0][20], 11, 30);
            } elseif (strpos($rowData[0][20], 'SC') !== false) {
                $kconn = substr($rowData[0][20], 11, 7);
            }

            $data[] = array(
                'order_id' => $orderid,
                'tanggal_ps' => $newdate,
                'kcontact' => $kconn
            );
        }
        $this->import_model->insert_ps($data);
        unlink($inputFileName);
        $multip = $this->input->post('multip_point');

        $data_log_point[] = array(
            'nik' => $this->session->userdata('nik'),
            'deskripsi_multip_point' => 'PS Harian',
            'tgl_log_point' => date('Y-m-d'),
            'tgl_for_ps' => $newdate,
            'multiplier_point' => $multip
        );

        $this->import_model->insert_log_point($data_log_point);

        $pquery = $this->import_model->select_kdsales($newdate);
        $spquery = $this->import_model->select_spynr($newdate);

        if(!empty($pquery->result_array()) OR !empty($spquery->result_array())){
            if (!empty($pquery->result_array())) {
                foreach ($pquery->result_array() as $rows) {
                    $pdata[] = array(
                        'nik' => $rows['nik'],
                        'tanggal_point' => $rows['tgl'],
                        'total_ps' => $rows['total_ps'],
                        'point_ps' => $rows['total_ps'] * $multip
                    );
                }
                $this->import_model->insert_point($pdata);
            }

            if (!empty($spquery->result_array())) {
                foreach ($spquery->result_array() as $res) {
                    $spdata[] = array(
                        'nik' => $res['nik'],
                        'tanggal_point' => $res['tgl'],
                        'total_ps' => $res['total_ps'],
                        'point_ps' => $res['total_ps'] * $multip
                    );
                }
                $this->import_model->insert_point($spdata);
            }
        } else {
            $this->db->where('tanggal_ps', $newdate);
            $this->db->delete('data_ps');
            $this->session->set_flashdata('message', '<div class="alert alert-danger m-0 p-1" role="alert">Import Data PS Gagal</div>');
            redirect('import');
        }
        
        $this->session->set_flashdata('message', '<div class="alert alert-success m-0 p-1" role="alert">Import Data PS Berhasil</div>');

        redirect('import');
    }

    public function import_ps_bulanan()
    {

        /*$this->form_validation->set_rules('file', 'File', 'required');
        $this->form_validation->set_rules('multip_point', 'Multiplier Point', 'required');

        if($this->form_validation->run() == FAlSE)
        {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan");  
            redirect('import');
        }*/

        //initiate upload file
        $random = "file_upload_".rand(11111,99999);
        $filename = $random.basename($_FILES['file']['name']);

        $config['upload_path'] = './assets/';
        $config['file_name'] = $filename;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        //upload file & error handling
        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger m-0 p-1" role="alert">Import Data PS Gagal, Tidak dapat meng-upload file</div>');
            unlink($inputFileName);
            redirect('import/ps_bulanan');
        }

        //membuka file upload & proses count
        $inputFileName = './assets/' . $filename;

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            /*die('Error loading file"' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());*/
            $this->session->set_flashdata('message', '<div class="alert alert-danger m-0 p-1" role="alert">Import Data PS Gagal, Tidak dapat membaca file</div>');
            unlink($inputFileName);
            redirect('import/ps_bulanan');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $orderid = $rowData[0][5];
            //Mengubah format data date
            $olddate = (($rowData[0][16]) - 25569.0833333333) * 86400;
            $newdate = date("Y-m-d", $olddate);

            //Mengamil kode sales dari Kconnect
            /*$sparray = explode(";", $rowData[0][20]);*/

            //Kondisi untuk input dari My Indihome
            if (strpos($rowData[0][20], 'MI') !== false and strpos($rowData[0][20], 'CUST') !== false) {
                continue;
            } elseif (strpos($rowData[0][20], 'MI') !== false and strpos($rowData[0][20], '_') !== false) {
                $kconn = substr($rowData[0][20], 24, 7);
            } elseif (strpos($rowData[0][20], 'MI') !== false) {
                $kconn = substr($rowData[0][20], 23, 7);
                //$kconn = $rowData[0][20];
            }

            //Kondisi untuk input dari SC
            if (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'PLS') !== false) {
                continue;
            } elseif (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'SPKJR') !== false) {
                $kconn = substr($rowData[0][20], 17, 7);
            } elseif (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'AOSF') !== false) {
                continue;
            } elseif (strpos($rowData[0][20], 'SC') !== false and strpos($rowData[0][20], 'SPYNR') !== false) {
                $kconn = substr($rowData[0][20], 11, 30);
            } elseif (strpos($rowData[0][20], 'SC') !== false) {
                $kconn = substr($rowData[0][20], 11, 7);
            }

            $data[] = array(
                'order_id' => $orderid,
                'tanggal_ps' => $newdate,
                'kcontact' => $kconn
            );
        }
        $this->import_model->insert_ps($data);
        unlink($inputFileName);
        $multip = $this->input->post('multip_point');

        $data_log_point[] = array(
            'nik' => $this->session->userdata('nik'),
            'deskripsi_multip_point' => 'PS Bulanan',
            'tgl_log_point' => date('Y-m-d'),
            'tgl_for_ps' => $newdate,
            'multiplier_point' => $multip
        );

        $this->import_model->insert_log_point($data_log_point);

        $pquery = $this->import_model->select_kdsales_bulan($newdate);
        $spquery = $this->import_model->select_spynr_bulan($newdate);


        if(!empty($pquery->result_array()) OR !empty($spquery->result_array())){
            if (!empty($pquery->result_array())) {
                foreach ($pquery->result_array() as $rows) {
                    $pdata[] = array(
                        'nik' => $rows['nik'],
                        'tanggal_point' => $rows['tgl'],
                        'total_ps' => $rows['total_ps'],
                        'point_ps' => $rows['total_ps'] * $multip
                    );
                }
                $this->import_model->insert_point($pdata);
            }

            if (!empty($spquery->result_array())) {
                foreach ($spquery->result_array() as $res) {
                    $spdata[] = array(
                        'nik' => $res['nik'],
                        'tanggal_point' => $res['tgl'],
                        'total_ps' => $res['total_ps'],
                        'point_ps' => $res['total_ps'] * $multip
                    );
                }
                $this->import_model->insert_point($spdata);
            }
        } else {
            $this->db->where(array('month(tanggal_ps)' => date("m", strtotime($newdate)), 'year(tanggal_ps)' => date("Y", strtotime($newdate))));
            $this->db->delete('data_ps');
            $this->session->set_flashdata('message', '<div class="alert alert-danger m-0 p-1" role="alert">Import Data PS Gagal</div>');
            redirect('import/ps_bulanan');
        }
        
        $this->session->set_flashdata('message', '<div class="alert alert-success m-0 p-1" role="alert">Import Data PS Berhasil</div>');

        redirect('import/ps_bulanan');
    }
}
