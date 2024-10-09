<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hadiah extends CI_Controller
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
        $data['title'] = 'Penukaran Point';
        $data['list_reward'] = $this->Reward_model->getAllListReward();
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['point'] = $this->db->get_where('total_point', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('hadiah/index', $data);
        $this->load->view('templates/home_footer');
    }


    public function redeem($id_reward)
    {
        if ($id_reward == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Permintaan redeem reward gagal.
          </div>');
            redirect('Hadiah');
        } else {
            $data[] = array(
                'nik' => $this->session->userdata('nik'),
                'id_reward' => $id_reward,
                'tanggal_choose' => date("Y-m-d")
            );

            $this->db->insert_batch('redeem_reward', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
            Permintaan redeem reward berhasil dikirim.
          </div>');
            redirect('Hadiah');
        }
    }
}
