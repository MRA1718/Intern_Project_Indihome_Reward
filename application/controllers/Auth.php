<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('nik', 'nik', 'trim|required');
        $this->form_validation->set_rules('password_user', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $nik = $this->input->post('nik');
        $password_user = $this->input->post('password_user');

        $user = $this->db->get_where('user', ['nik' => $nik])->row_array();
        if ($user != null) {
            if ($user['user_is_active'] == 'active') {

                if (password_verify($password_user, $user['password_user'])) {
                    $data = [
                        'nik' => $user['nik'],
                        'role' => $user['role']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role'] == 'Administrator') {
                        redirect('kelolaakun');
                    } else {
                        redirect('leaderboard');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" style="text-align: center" role="alert">Password salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" style="text-align: center"role="alert">Akun belum aktif</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="text-align: center" role="alert">NIK belum terdaftar</div>');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-secondary" style="text-align: center" role="alert">
            Berhasil Keluar.
          </div>');
        redirect();
    }
}
