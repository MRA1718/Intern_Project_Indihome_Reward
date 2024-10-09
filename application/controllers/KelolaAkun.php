<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaAkun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') != 'Administrator') {
            redirect('leaderboard');
        }
    }

    public function index()
    {
        $data['title'] = 'Kelola Akun';
        $data['user2'] = $this->Reward_model->getAllUser();
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('kelolaakun/index', $data);
        $this->load->view('templates/home_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('nik', 'nik', 'required|is_unique[user.nik]');
        $this->form_validation->set_rules('kode_sales', 'kode_sales', 'required');
        $this->form_validation->set_rules('first_name', 'first_name', 'required');
        $this->form_validation->set_rules('email_user', 'email_user', 'required');
        $this->form_validation->set_rules('role', 'role', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Akun gagal ditambahkan.
          </div>');
            redirect('KelolaAkun');
        } else {

            // if (!empty($_FILES['foto_user']['name'])) {
            $config['upload_path']          = 'upload/fotoprofil/';
            $config['allowed_types']        = 'jpeg|jpg|png|JPEG|PNG|JPG';
            $config['max_size']             = 1000; //set max size allowed in Kilobyte
            $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('foto_user')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = 'default.jpg';
            }


            $data = [
                'nik' => $this->input->post('nik'),
                'password_user' => password_hash($this->input->post('nik'), PASSWORD_DEFAULT),
                'kode_sales' => strtoupper($this->input->post('kode_sales')),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email_user' => strtolower($this->input->post('email_user')),
                'role' => $this->input->post('role'),
                'foto_user' => $picture
            ];



            if ($data['role'] == 'Manager') {
                $this->db->set('user_is_active', 'active');
            }
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
            Akun berhasil ditambahkan.
          </div>');

            redirect('KelolaAkun');
        }
    }


    public function edit($nik)
    {
        if ($nik == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Detail akun gagal disunting.
          </div>');
            redirect('KelolaAkun');
        } else {

            $this->form_validation->set_rules('nik', 'nik', 'required');
            $this->form_validation->set_rules('kode_sales', 'kode_sales', 'required');
            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('email_user', 'email_user', 'required');
            $this->form_validation->set_rules('role', 'role', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
                Detail akun gagal disunting.
              </div>');
                redirect('KelolaAkun');
            } else {

                $data = [
                    'nik' => $this->input->post('nik'),
                    'kode_sales' => strtoupper($this->input->post('kode_sales')),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email_user' => strtolower($this->input->post('email_user')),
                    'role' => $this->input->post('role'),
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
                        File foto berformat gambar dengan ukuran maksimal 1MB.
                      </div>');
                        redirect('KelolaAkun');
                    }
                }


                $this->db->where('nik', $nik);
                $this->db->update('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
                Informasi akun berhasil disunting.  
              </div>');
                redirect('KelolaAkun');
            }
        }
    }

    public function hapus($nik)
    {
        if ($nik == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Akun gagal dihapus.
          </div>');
            redirect('KelolaAkun');
        } else {
            $this->db->where('nik', $nik);
            $this->db->delete('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
            Akun Berhasil dihapus.
          </div>');
            redirect('KelolaAkun');
        }
    }

    public function reset($nik)
    {
        $this->Reward_model->resetpassuser($nik);
        $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
        password akun berhasil dikembalikan ke default.          
        </div>');
        redirect('KelolaAkun');
    }
}
