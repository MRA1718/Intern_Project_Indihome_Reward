<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidasiAkun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') != 'Manager') {
            redirect('leaderboard');
        }
    }
    public function index()
    {
        $data['user2'] = $this->Reward_model->getUserInactive();
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('validasiakun/index', $data);
        $this->load->view('templates/home_footer');
    }
    public function validasi($nik)
    {
        $this->Reward_model->validasiuser($nik);
        $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
        Akun berhasil divalidasi.          
        </div>');
        redirect('validasiakun');
    }
}
