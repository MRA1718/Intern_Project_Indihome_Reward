<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/third_party/PHPExcel/IOFactory.php');

class IOFactoryExc extends PHPExcel_IOFactory{

	public function __construct(){
		parent::__construct();
	}
}

?>