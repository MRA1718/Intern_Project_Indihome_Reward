<?php

class Reward_model extends CI_model
{
    //
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllRewardsales()
    {
        return $this->db->get('reward_sales')->result_array();
    }
    public function getAllListReward()
    {
        return $this->db->get('list_reward')->result_array();
    }
    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }


    public function getUserInactive()
    {
        $where = "SELECT * FROM user WHERE user_is_active = ?";
        return $this->db->query($where, array('inactive'))->result_array();
    }

    public function getRequestbyNIK($nik)
    {
        $res = $this->db->select('*')->from('redeem_reward')->join('list_reward', 'redeem_reward.id_reward=list_reward.id_reward')->join('user', 'user.nik=redeem_reward.nik')->where('user.nik', $nik)->order_by('id_redeem', 'DESC')->get();
        return $res->result_array();
    }


    public function getRequestWaiting()
    {
        $res = $this->db->select('*')->from('redeem_reward')->join('list_reward', 'redeem_reward.id_reward=list_reward.id_reward')->join('user', 'user.nik=redeem_reward.nik')->where('status_redeem', 'waiting')->get();
        //$where = "SELECT * FROM redeem_reward WHERE status_redeem = ?";
        return $res->result_array();
    }

    public function getRequestApproved()
    {
        $res = $this->db->select('*')->from('redeem_reward')->join('list_reward', 'redeem_reward.id_reward=list_reward.id_reward')->join('user', 'user.nik=redeem_reward.nik')->where('status_redeem', 'approved')->get();
        return $res->result_array();
    }
    public function getRequestDisapproved()
    {
        $res = $this->db->select('*')->from('redeem_reward')->join('list_reward', 'redeem_reward.id_reward=list_reward.id_reward')->join('user', 'user.nik=redeem_reward.nik')->where('status_redeem', 'disapproved')->get();
        return $res->result_array();
    }

    public function validasiuser($nik)
    {
        $this->db->set('user_is_active', 'active');
        $this->db->where('nik', $nik);
        $this->db->update('user');
    }
    public function approverequest($id_redeem)
    {
        $this->db->set('tanggal_approval', date("Y-m-d"));
        $this->db->set('status_redeem', 'approved');
        $this->db->where('id_redeem', $id_redeem);
        $this->db->update('redeem_reward');
    }
    public function disapproverequest($id_redeem)
    {
        $this->db->set('tanggal_approval', date("Y-m-d"));
        $this->db->set('status_redeem', 'disapproved');
        $this->db->where('id_redeem', $id_redeem);
        $this->db->update('redeem_reward');
    }

    public function resetpassuser($nik)
    {
        $password = password_hash($nik, PASSWORD_DEFAULT);
        $this->db->set('password_user', $password);
        $this->db->where('nik', $nik);
        $this->db->update('user');
    }

    // ganti 12bulan
    public function getlast6month($nik)
    {
        $query = $this->db->select('nik, DATE_FORMAT(tanggal_point, "%M %Y") AS bulan, SUM(total_ps) AS totalps')->from('point_sales')->where('tanggal_point >= DATE_SUB(CURDATE(), INTERVAL 13 MONTH)', NULL, FALSE)->where('nik', $nik)->group_by(array("nik", "bulan"))->order_by('tanggal_point', 'DESC')->get();

        return $query->result_array();
    }
}
