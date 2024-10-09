<?php
defined('BASEPATH') or exit('No direct script access allowed');

class resetpoint extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reset_point_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') != 'Administrator') {
            redirect('leaderboard');
        }
    }


    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['point_sales'] = $this->reset_point_model->ptsales();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('resetpoint/index', $data);
        $this->load->view('templates/home_footer');
    }

    public function reset()
    {
        $psales = $this->reset_point_model->ptsales();

        if (!empty($psales)) {
            foreach ($psales as $res) {
                $ptsales_data[] = array(
                    'nik' => $res['nik'],
                    'tgl_histori_point' => date("Y-m-d H:i:s"),
                    'deskripsi' => 'Point Direset',
                    'perubahan_point' => '0',
                    'last_total_point' => '0',
                    'last_point_belanja' => '0'
                );
                $hptsales_data[] = array(
                    'nik' => $res['nik'],
                    'tanggal_reset_pt' => date("Y-m-d"),
                    'hr_total_pt' => $res['total_pt'],
                    'hr_pt_belanja' => $res['pt_belanja']
                );
            }
            $this->reset_point_model->insert_reset($ptsales_data);
            $this->reset_point_model->insert_histori_reset($hptsales_data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">Point berhasil direset</div>');
        redirect('resetpoint', 'refresh');
    }
}
