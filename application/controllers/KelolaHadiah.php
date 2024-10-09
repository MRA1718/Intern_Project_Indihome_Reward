<?php
defined('BASEPATH') or exit('No direct script access allowed');
class KelolaHadiah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reward_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        if ($this->session->userdata('role') == FALSE) {
            redirect('auth', 'refresh');
        } elseif ($this->session->userdata('role') == 'Sales') {
            redirect('leaderboard');
        }
    }
    public function index()
    {
        $data['title'] = 'Penukaran Point';
        $data['list_reward'] = $this->Reward_model->getAllListReward();
        $data['user'] = $this->db->get_where('user', ['nik' => $this->session->userdata('nik')])->row_array();

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_sidebar', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('kelolahadiah/index', $data);
        $this->load->view('templates/home_footer', $data);
    }


    public function add()
    {
        $this->form_validation->set_rules('nama_reward', 'nama_reward', 'required');
        $this->form_validation->set_rules('point_reward', 'point_reward', 'required');
        $this->form_validation->set_rules('deskripsi_reward', 'deskripsi_reward', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Data reward gagal ditambahkan.          
            </div>');
            redirect('KelolaHadiah');
        } else {

            $config['upload_path']          = 'upload/fotohadiah/';
            $config['allowed_types']        = 'jpeg|jpg|png|JPEG|PNG|JPG';
            $config['max_size']             = 5000; //set max size allowed in Kilobyte
            $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar_reward')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = 'default.png';
            }


            $data = [
                'nama_reward' => $this->input->post('nama_reward'),
                'point_reward' => $this->input->post('point_reward'),
                'deskripsi_reward' => $this->input->post('deskripsi_reward'),
                'gambar_reward' => $picture
            ];
            $this->db->insert('list_reward', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
                Data reward berhasil ditambahkan.          
                </div>');

            redirect('KelolaHadiah');
        }
    }


    public function edit($id_reward)
    {
        if ($id_reward == "") {
            $this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");
            redirect('KelolaHadiah');
        } else {
            $this->form_validation->set_rules('nama_reward', 'nama_reward', 'required');
            $this->form_validation->set_rules('point_reward', 'point_reward', 'required');
            $this->form_validation->set_rules('deskripsi_reward', 'deskripsi_reward', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
                Data reward gagal disunting.          
                </div>');
                redirect('KelolaHadiah');
            } else {


                $data = [
                    'nama_reward' => $this->input->post('nama_reward'),
                    'point_reward' => $this->input->post('point_reward'),
                    'deskripsi_reward' => $this->input->post('deskripsi_reward'),

                ];
                $upload_image = $_FILES['gambar_reward']['name'];

                if ($upload_image) {
                    $config['upload_path']          = 'upload/fotohadiah/';
                    $config['allowed_types']        = 'jpeg|jpg|png|JPEG|PNG|JPG';
                    $config['max_size']             = 1000; //set max size allowed in Kilobyte
                    $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('gambar_reward')) {
                        $new_image = $this->upload->data('file_name');

                        $this->db->set('gambar_reward', $new_image);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
                        File foto berformat gambar dengan ukuran maksimal 1MB.
                      </div>');
                        redirect('KelolaHadiah');
                    }
                }


                $this->db->where('id_reward', $id_reward);
                $this->db->update('list_reward', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
                Data reward berhasil disunting.          
                </div>');
                redirect('KelolaHadiah');
            }
        }
    }

    public function hapus($id_reward)
    {
        if ($id_reward == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="height:38px;" role="alert">
            Data reward gagal dihapus.          
            </div>');
            redirect('KelolaHadiah');
        } else {
            $this->db->where('id_reward', $id_reward);
            $this->db->delete('list_reward');
            $this->session->set_flashdata('message', '<div class="alert alert-success" style="height:38px;" role="alert">
            Data reward berhasil dihapus.          
            </div>');
            redirect('KelolaHadiah');
        }
    }
}
