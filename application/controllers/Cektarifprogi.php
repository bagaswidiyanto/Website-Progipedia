<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cektarifprogi extends MY_Controller
{
    function __construct()
    {
     parent::__construct();
     $this->load->model('m_data');
 }
 public function index()
 {
    $this->data['idCompany'] = $this->input->post('idCompany');
    $this->data['asal'] = $this->input->post('asal');
    $this->data['tujuan'] = $this->input->post('tujuan');

    $this->web = 'content/progi/v_cek_tarif';
    $this->dashboard();
}

public function getComp()
{
    $id=$this->input->post("id");
    $comp=$this->m_data->getCompany($id)->row();
    $data['baseUrl']=$comp->baseUrl;
    $data['keyApi']=$comp->keyApi;
    echo json_encode($data);
}

public function search()
{
    $baseUrl=$this->input->get("baseUrl");
    $keyApi=$this->input->get("keyApi");

    $curl = curl_init();
    $data = array(
        'key' =>$keyApi );

    curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'master/origin/android/progi/?key='.$keyApi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'key: '.$keyApi,
            'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
        ),
        CURLOPT_POSTFIELDS => http_build_query($data),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $isi = json_decode($response);

    foreach ($isi->data as $i) {
        $datas[$i->id] = array('value' => $i->id, 'label' => $i->nama);
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
     $baseUrl=$this->input->get("baseUrl");
     $keyApi=$this->input->get("keyApi");

     $curl = curl_init();
     $data = array(
        'key' =>$keyApi );

     curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'master/destination/android/progi/?key='.$keyApi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'key: '.$keyApi,
            'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
        ),
        CURLOPT_POSTFIELDS => http_build_query($data),
    ));

     $response = curl_exec($curl);

     curl_close($curl);
     $isi = json_decode($response);

     foreach ($isi->data as $i) {
        $datas[$i->ID] = array('value' => $i->ID, 'label' => $i->kabName);
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

    public function cekTarif()
    {
        $this->data['idCompany'] = $this->input->post('idCompany');
        $this->data['dari'] = $this->input->post('dari');
        $this->data['tujuan'] = $this->input->post('tujuan');
        $this->data['baseUrl'] = $this->input->post('baseUrl');
        $this->data['keyApi'] = $this->input->post('keyApi');

        // $this->web = 'content/progi/v_tarif';
        // $this->dashboard();
        $this->load->view('content/progi/v_tarif');
    }



    public function cekTarifAll()
    {
        $data['dari'] = $this->input->post('dari');
        $data['kabAsal'] = $this->input->post('kabAsal');
        $data['branchNameAsal'] = $this->input->post('branchNameAsal');
        $data['kecNameAsal'] = $this->input->post('kecNameAsal');
        $data['kabupatenNameAsal'] = $this->input->post('kabupatenNameAsal');

        $data['tujuan'] = $this->input->post('tujuan');
        $data['kabTujuan'] = $this->input->post('kabTujuan');
        $data['branchNameTujuan'] = $this->input->post('branchNameTujuan');
        $data['kecNameTujuan'] = $this->input->post('kecNameTujuan');
        $data['kabupatenNameTujuan'] = $this->input->post('kabupatenNameTujuan');

        // $this->web = 'content/progi/v_tarif';
        // $this->dashboard();
        $this->load->view('content/progi/v_tarif',$data);
    }
}