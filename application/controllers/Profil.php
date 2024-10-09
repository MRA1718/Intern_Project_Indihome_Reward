<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') == 'Sales') {
            redirect('User');
        }
    }


    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['point'] = $this->db->get_where('total_point', ['nik' => $this->session->userdata('nik')])->row_array();
        $nik = $this->session->userdata('nik');
        $data['recap'] = $this->Reward_model->getlast6month($nik);

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('profil/index', $data);
        $this->load->view('templates/home_footer');
    }




    public function edit($nik)
    {
        if ($nik == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Detail akun gagal disunting.
          </div>');
            redirect('Profil');
        } else {

            $this->form_validation->set_rules('nik', 'nik', 'required');
            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');
            $this->form_validation->set_rules('email_user', 'email_user', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
                Detail akun gagal disunting.i
              </div>');
                redirect('Profil');
            } else {

                $data = [
                    'nik' => $this->input->post('nik'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email_user' => $this->input->post('email_user'),
                ];
                $upload_image = $_FILES['foto_user']['name'];


                if ($upload_image) {
                    $config['upload_path']          = 'upload/fotoprofil/';
                    $config['allowed_types']        = 'jpeg|jpg|png|JPEG|PNG|JPG';
                    $config['max_size']             = 1000; //set max size allowed in Kilobyte
                    $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('foto_user')) {
                        $new_image = $this->upload->data('file_name');

                        $this->db->set('foto_user', $new_image);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
                        File foto maksimal 1MB, dengan format file gambar.
                      </div>');
                        redirect('Profil');
                    }
                }


                $this->db->where('nik', $nik);
                $this->db->update('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
                Informasi akun berhasil disunting.  
              </div>');
                redirect('Profil');
            }
        }
    }


    public function editpassword()
    {
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        // $this->form_validation->set_rules('old_pass', 'old_pass', 'required|trim|');
        // $this->form_validation->set_rules('new_pass', 'new_pass', 'required|trim|min_length[3]|matches[confirm_pass]');
        // $this->form_validation->set_rules('confirm_pass', 'confirm_pass', 'required|trim|min_length[3]|matches[new_pass]');
        // if ($this->form_validation->run() == FALSE) {
        //     $this->session->set_flashdata('error', "Data Gagal Di Tambahkan");
        //     redirect('User');
        // } else {
        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        $confirm_pass = $this->input->post('confirm_pass');
        if (!password_verify($old_pass, $data['user']['password_user'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Salah
              </div>');
            redirect('Profil');
        } else {
            if ($old_pass == $new_pass) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password baru tidak boleh sama dengan password lama.
              </div>');
                redirect('Profil');
            } else {
                if ($new_pass != $confirm_pass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Pengisian password baru tidak cocok.
                  </div>');
                    redirect('Profil');
                } else {
                    $password_hash = password_hash($new_pass, PASSWORD_DEFAULT);


                    $this->db->set('password_user', $password_hash);
                    $this->db->where('nik', $this->session->userdata('nik'));
                    $this->db->update('user');


                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Ganti password berhasil </div>');
                    redirect('Profil');
                }
            }
        }
    }
}
