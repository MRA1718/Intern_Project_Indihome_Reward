<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RedeemHistory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('session');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') != 'Sales') {
            redirect('leaderboard');
        }
    }


    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['point'] = $this->db->get_where('total_point', ['nik' => $this->session->userdata('nik')])->row_array();

        $nik = $this->session->userdata('nik');
        $data['list_request'] = $this->Reward_model->getRequestbyNIK($nik);


        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('redeemhistory/index', $data);
        $this->load->view('templates/home_footer');
    }
    public function all()
    {
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['point'] = $this->db->get_where('total_point', ['nik' => $this->session->userdata('nik')])->row_array();

        $nik = $this->session->userdata('nik');
        $data['list_request'] = $this->Reward_model->getRequestbyNIK($nik);


        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('redeemhistory/all', $data);
        $this->load->view('templates/home_footer');
    }
}
