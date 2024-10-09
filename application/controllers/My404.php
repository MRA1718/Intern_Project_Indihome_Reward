<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['point'] = $this->db->get_where('total_point', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('my404/index', $data);
        $this->load->view('templates/home_footer');
    }
}
