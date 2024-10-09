<?php
class reset_point_model extends CI_model
{
	function ptsales()
	{
		$query = $this->db->select('user.nik, user.kode_sales, user.first_name, user.last_name, total_point.total_pt, total_point.pt_belanja')->from('user')->join('total_point', 'user.nik=total_point.nik')->order_by('user.first_name', 'ASC')->get();

		return $query->result_array();
	}

	public function insert_reset($resdata)
	{
		$this->db->insert_batch('histori_point', $resdata);
	}

	public function insert_histori_reset($hresdata)
	{
		$this->db->insert_batch('histori_reset', $hresdata);
	}
}
?>