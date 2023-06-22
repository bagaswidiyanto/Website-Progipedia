<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function search()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://restapi.progitoken.com/master/destination/android/progi/?key=300dfaa09d3079dbf9af803a6ae42209',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'key: 300dfaa09d3079dbf9af803a6ae42209',
				'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$isi = json_decode($response);

		foreach ($isi->data as $i) {
			$datas[$i->ID] = array('value' => $i->ID, 'label' => $i->kabName, 'kabAsal' => $i->kabName, 'branchNameAsal' => $i->branchName, 'kecNameAsal' => $i->kecName, 'kabupatenNameAsal' => $i->kabupatenName);
		}

		$input = $this->input->get('term'); // ambil dari parameter yg diketik
		$result = array_filter($datas, function ($item) use ($input) {
			if (stripos($item['label'], $input) !== false) {
				return true;
			}
			return false;
		});

		echo json_encode($result);
	}

	public function search2()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://restapi.progitoken.com/master/destination/android/progi/?key=300dfaa09d3079dbf9af803a6ae42209',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'key: 300dfaa09d3079dbf9af803a6ae42209',
				'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$isi = json_decode($response);

		foreach ($isi->data as $i) {
			$datas[$i->ID] = array('value' => $i->ID, 'label' => $i->kabName, 'kabTujuan' => $i->kabName, 'branchNameTujuan' => $i->branchName, 'kecNameTujuan' => $i->kecName, 'kabupatenNameTujuan' => $i->kabupatenName);
		}

		$input = $this->input->get('term'); // ambil dari parameter yg diketik
		$result = array_filter($datas, function ($item) use ($input) {
			if (stripos($item['label'], $input) !== false) {
				return true;
			}
			return false;
		});

		echo json_encode($result);
	}
}