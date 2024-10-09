<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leaderboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        }
    }
    public function index()
    {
        $data['title'] = 'Pencapaian Penjualan Sales';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        $array = array('role' => 'Sales', 'user_is_active' => 'active');

        $data['leaderboard'] = $this->db->select('user.nik, user.kode_sales, user.first_name, user.last_name, user.foto_user, total_pt')->from('user')->join('total_point', 'user.nik=total_point.nik')->where($array)->order_by('total_pt', 'DESC')->get()->result_array();


        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('leaderboard/index', $data);
        $this->load->view('templates/home_footer');
    }
}
