<?php
class import_model extends CI_Model
{

	function insert_ps($data)
	{
		$this->db->insert_batch('data_ps', $data);
	}

	function insert_point($pdata)
	{
		$this->db->insert_batch('point_sales', $pdata);
	}

	function insert_log_point($data_log_point)
	{
		$this->db->insert_batch('log_multip_point', $data_log_point);
	}

	function select_kdsales($dates)
	{
		$subres_dataps = $this->db->select('*')->from('data_ps')->where('date(tanggal_ps)', $dates)->get_compiled_select();
		$subres_user = $this->db->select('*')->from('user')->where('kode_sales != "NONE" AND kode_sales != "SPYNR80"', NULL, FALSE)->get_compiled_select();
		$res = $this->db->select('u.nik, u.kode_sales, date(ppd.tanggal_ps) tgl, count(*) AS total_ps')->from('(' . $subres_user . ') u, (' . $subres_dataps . ') ppd')->where('ppd.kcontact LIKE CONCAT("%",u.kode_sales,"%")', NULL, FALSE)->group_by('u.nik')->get();
		return $res;
	}

	function select_spynr($dates)
	{
		$subres_dataps = $this->db->select('*')->from('data_ps')->where('date(tanggal_ps)', $dates)->get_compiled_select();
		$subres_user = $this->db->select('*')->from('user')->where('kode_sales = "SPYNR80"', NULL, FALSE)->get_compiled_select();
		$res = $this->db->select('u.nik, u.kode_sales, date(ppd.tanggal_ps) tgl, count(*) AS total_ps')->from('(' . $subres_user . ') u, (' . $subres_dataps . ') ppd')->where('ppd.kcontact LIKE CONCAT("%",u.first_name,"%")', NULL, FALSE)->group_by('u.nik')->get();
		return $res;
	}

	function select_kdsales_bulan($dates)
	{
		$subres_dataps = $this->db->select('*')->from('data_ps')->where(array('month(tanggal_ps)' => date("m", strtotime($dates)), 'year(tanggal_ps)' => date("Y", strtotime($dates))))->get_compiled_select();
		$subres_user = $this->db->select('*')->from('user')->where('kode_sales != "NONE" AND kode_sales != "SPYNR80"', NULL, FALSE)->get_compiled_select();
		$res = $this->db->select('u.nik, u.kode_sales, date(ppd.tanggal_ps) tgl, count(*) AS total_ps')->from('(' . $subres_user . ') u, (' . $subres_dataps . ') ppd')->where('ppd.kcontact LIKE CONCAT("%",u.kode_sales,"%")', NULL, FALSE)->group_by(array('u.nik', 'date(tanggal_ps)'))->get();
		return $res;
	}

	function select_spynr_bulan($dates)
	{
		$subres_dataps = $this->db->select('*')->from('data_ps')->where(array('month(tanggal_ps)' => date("m", strtotime($dates)), 'year(tanggal_ps)' => date("Y", strtotime($dates))))->get_compiled_select();
		$subres_user = $this->db->select('*')->from('user')->where('kode_sales = "SPYNR80"', NULL, FALSE)->get_compiled_select();
		$res = $this->db->select('u.nik, u.kode_sales, date(ppd.tanggal_ps) tgl, count(*) AS total_ps')->from('(' . $subres_user . ') u, (' . $subres_dataps . ') ppd')->where('ppd.kcontact LIKE CONCAT("%",u.first_name,"%")', NULL, FALSE)->group_by(array('u.nik', 'date(tanggal_ps)'))->get();
		return $res;
	}
}
