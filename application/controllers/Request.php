<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('session');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') != 'Manager') {
            redirect('leaderboard');
        }
    }
    public function index()
    {
        $data['title'] = 'Pencapaian Penjualan Sales';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['list_request'] = $this->Reward_model->getRequestWaiting();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('request/index', $data);
        $this->load->view('templates/home_footer');
    }
    public function setujui($id_redeem)
    {
        $this->Reward_model->approverequest($id_redeem);
        $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
        Penukaran hadiah disetujui.
        </div>');
        redirect('request');
    }
    public function tolak($id_redeem)
    {
        $this->Reward_model->disapproverequest($id_redeem);
        $pt_reward = $this->db->select('nik, point_reward')->from('list_reward')->join('redeem_reward', 'list_reward.id_reward=redeem_reward.id_reward')->where('id_redeem', $id_redeem)->get()->result_array();
        $histori_pt = $this->db->select('last_total_point, last_point_belanja')->from('histori_point')->where('nik', $pt_reward[0]['nik'])->order_by('id_histori_point', 'DESC')->limit(1)->get()->result_array();


        $insert_return_point[] = array(
            'nik' => $pt_reward[0]['nik'],
            'tgl_histori_point' => date("Y-m-d H:i:s"),
            'deskripsi' => 'Point Kembali',
            'perubahan_point' => $pt_reward[0]['point_reward'],
            'last_total_point' => $histori_pt[0]['last_total_point'],
            'last_point_belanja' => $histori_pt[0]['last_point_belanja'] + $pt_reward[0]['point_reward']
        );

        $this->db->insert_batch('histori_point', $insert_return_point);

        $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
        Penukaran hadiah ditolak.          
        </div>');
        redirect('request');
    }

    public function approved()
    {
        $data['title'] = 'Pencapaian Penjualan Sales';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['list_request'] = $this->Reward_model->getRequestApproved();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('request/approved', $data);
        $this->load->view('templates/home_footer');
    }
    public function disapproved()
    {
        $data['title'] = 'Pencapaian Penjualan Sales';
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['list_request'] = $this->Reward_model->getRequestDisapproved();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('request/disapproved', $data);
        $this->load->view('templates/home_footer');
    }
}
