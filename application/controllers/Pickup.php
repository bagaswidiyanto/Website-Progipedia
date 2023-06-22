<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pickup extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("m_booking");
    }
    public function index()
    {
        $this->data['booking']=$this->m_booking->showData($this->session->userdata("userID"),"0")->result();
        $this->data['cekPembayaran']=$this->m_booking->showData($this->session->userdata("userID"),"2")->num_rows();
        $this->web = 'content/progi/v_pickup';
        $this->dashboard();
    }

    public function cekBook()
    {
        $Konid=$this->input->post("Konid");
        $cekBook=$this->m_booking->showBookingKonid($Konid);
        $isiBook=$cekBook->row();
        if ($cekBook->num_rows()>0) {
            $data['msg']="good";
            $data['id']=$isiBook->ID;
        }else{
            $data['msg']="AWB tidak ditemukan!";
            $data['id']="";
        }
        echo json_encode($data);
    }

    public function detail($id)
    {
        $this->data['booking']=$this->m_booking->showBooking($id)->row();
        $this->web = 'content/progi/v_pickup_detail';
        $this->dashboard();   
    }

    public function showData()
    {
        $userID=$this->session->userdata("userID");
        $bulan=$this->input->post("bulan");
        $tahun=$this->input->post("tahun");

        $startDate = $tahun . '-' . $bulan . '-01';
        $endDate = $tahun . '-' . $bulan . '-' . date('t', strtotime($startDate));

        $qPic = $this->db->query("SELECT a.*,b.baseUrl,b.keyApi from log_booking a left join em_company b on a.kodePerusahaan=b.id where  CreatedUserId='" . $userID . "' and Tgl_Konos BETWEEN '" . $startDate . "' and '" . $endDate . "' order by Tgl_Konos DESC,Konid DESC ");
        $rPic = $qPic->result();
        $totalBerhasil = 0;
        $totalBatal = 0;
        $totalBelumPickup = 0;
        $totalMenujuPenerima = 0;
        $totalKirimanBermasalah = 0;
        $totalCOD = 0;
        $totalClaimSukses = 0;
        $totalBayarSukses = 0;
        $totalBayarPending = 0;


        foreach ($rPic as $key) {
            $dataAPI = array(
                "Konid" => $key->Konid,
                "key" => $key->keyApi
            );

            $headers = array(
                "key: " . $key->keyApi
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $key->baseUrl . "reseller/transaksi/cekStatus/progi/?key=" . $key->keyApi,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($dataAPI),
                CURLOPT_HTTPHEADER => $headers
            ));
            $responsenya = curl_exec($curl);
            $isi = json_decode($responsenya);

            if ($key->statusBooking == '0' && $key->flagBayar == "0") {
                $totalBerhasil++;
            }
            if ($key->statusBooking == '0' && $key->flagBayar == "2") {
                $totalBerhasil++;
            }

            if ($key->statusBooking == '1') {
                $totalBatal++;
            }

            if ($key->statusBooking == '0' && $key->flagBayar == "1") {
                $totalBelumPickup++;
            }

            if ($key->statusBooking == '2' && $key->flagBayar == "1") {
                $totalBelumPickup++;
            }

            if ($key->statusBooking == '4' && empty($isi->statusBooking)) {
                $totalMenujuPenerima++;
            }

            if ($key->statusBooking == '4' && $isi->statusBooking == "Progress") {
                $totalMenujuPenerima++;
            }
            if ($key->statusBooking == '4' && $isi->statusBooking == "Bermasalah") {
                $totalKirimanBermasalah++;
            }
            if ($key->statusBooking == '4' && $isi->statusBooking == "Berhasil") {
                $totalClaimSukses++;
            }

            if ($key->feeCod != '0' && $key->flagBayar == "1" && $key->statusBooking == '4') {
                $totalCOD += ($key->Totbi + $key->nilaiCod);
            }

            if ($key->flagBayar == '1') {
                $totalBayarSukses++;
            }
            if ($key->flagBayar != "1") {
                $totalBayarPending++;
            }
        }

        $data['totalBerhasil']=$totalBerhasil;
        $data['totalBatal']=$totalBatal;
        $data['totalBelumPickup']=$totalBelumPickup;
        $data['totalMenujuPenerima']=$totalMenujuPenerima;
        $data['totalCOD']=$totalCOD;
        $data['totalKirimanBermasalah']=$totalKirimanBermasalah;
        $data['totalClaimSukses']=$totalClaimSukses;
        $data['totalBayarSukses']=$totalBayarSukses;
        $data['totalBayarPending']=$totalBayarPending;
        echo json_encode($data);
    }

    public function listPickup()
    {
        $this->data['userID']=$this->session->userdata("userID");
        $this->web = 'content/progi/v_pickup_list';
        $this->dashboard();

    }

     public function pickupTrack($id)
    {
        $this->data['booking']=$this->m_booking->showBooking($id)->row();
        $this->web = 'content/progi/v_pickup_track';
        $this->dashboard();   
    }

}