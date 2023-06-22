<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Booking extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("m_booking");
        $this->load->model("m_katalog");
        $this->load->model("m_pengirim");
        $this->load->model("m_data");
        $this->load->model("m_login");
    }
    public function index()
    {
        $this->data['booking']=$this->m_booking->showData($this->session->userdata("userID"),"0")->result();
        $this->data['cekPembayaran']=$this->m_booking->showData($this->session->userdata("userID"),"2")->num_rows();
        $this->web = 'content/progi/v_list_booking';
        $this->dashboard();
    }

    public function inputDetail()
    {
        $id=$this->input->post("ID");
        $up=$this->m_booking->upBooking($id);
        if ($up) {
            echo "good";
        }else{
            return false;
        }
    }

    public function add()
    {
        $this->data['pengirim']=$this->m_pengirim->showPengirim($this->session->userdata("userID"))->result();
        $this->data['katalog']=$this->m_katalog->showData($this->session->userdata("userID"))->result();
        $this->web = 'content/progi/v_booking_add';
        $this->dashboard();   
    }

    public function showKatalog()
    {
        $id=$this->input->post("id");
        $paket=$this->m_katalog->showDetail($id)->row();
        $data['jenisBarang']=$paket->jenisBarang;
        $data['keterangan']=$paket->keterangan;
        $data['berat']=$paket->berat;
        $data['jumlahBarang']=$paket->jumlahBarang;
        $data['nilaiBarang']=$paket->nilaiBarang;
        $data['panjang']=$paket->panjang;
        $data['lebar']=$paket->lebar;
        $data['tinggi']=$paket->tinggi;
        echo json_encode($data);
    }

    public function getpriceDetail()
    {
        $idPengirim = $this->input->post('idPengirim');
        $tujuan = $this->input->post('tujuan');

        $rTujuan=$this->m_pengirim->showDetail($idPengirim)->row();
        $dataPengirim = array('ID' => $rTujuan->kecamatanID, );
        $curlPengirim = curl_init();
        curl_setopt_array($curlPengirim, array(
            CURLOPT_URL => 'https://restapi.progitoken.com/master/destination/get/progi/?key=300dfaa09d3079dbf9af803a6ae42209',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($dataPengirim),
            CURLOPT_HTTPHEADER => array(
                'key: 300dfaa09d3079dbf9af803a6ae42209',
                'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
            ),
        ));
        $responsePengirim = curl_exec($curlPengirim);
        curl_close($curlPengirim);
        $isiPengirim = json_decode($responsePengirim);


        $dataTujuan = array('ID' => $tujuan, );
        $curlTujuan = curl_init();
        curl_setopt_array($curlTujuan, array(
            CURLOPT_URL => 'https://restapi.progitoken.com/master/destination/get/progi/?key=300dfaa09d3079dbf9af803a6ae42209',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($dataTujuan),
            CURLOPT_HTTPHEADER => array(
                'key: 300dfaa09d3079dbf9af803a6ae42209',
                'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
            ),
        ));
        $responseTujuan = curl_exec($curlTujuan);
        curl_close($curlTujuan);
        $isiTujuan = json_decode($responseTujuan);

        $data['serviceID']=$this->input->post("serviceID");
        $data['dari'] = $idPengirim;
        $data['kabAsal'] = $isiPengirim->data->kabName;
        $data['branchNameAsal'] = $isiPengirim->data->branchName;
        $data['kecNameAsal'] = $isiPengirim->data->kecName;

        $data['tujuan'] = $tujuan;
        $data['kabTujuan'] = $isiTujuan->data->kabName;
        $data['branchNameTujuan'] = $isiTujuan->data->branchName;
        $data['kecNameTujuan'] = $isiTujuan->data->kecName;

        $this->load->view('content/progi/v_booking_price_detail',$data);
    }

    public function showTotal()
    {
        $asal=$this->input->post("asal");
        $moda=$this->input->post("moda");
        $service=$this->input->post("service");
        $tujuan=$this->input->post("tujuan");
        $terberat=$this->input->post("terberat");
        $idComp=$this->input->post("idComp");
        $billID=$this->input->post("billingID");

        $qComp = $this->m_data->getCompany($idComp)->row();

        $headers = array(
            "key: " . $qComp->keyApi
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $qComp->baseUrl . "reseller/pricesbooking/progi/?key=" . $qComp->keyApi . "&dari=" . $asal . "&tujuan=" . $tujuan . "&customer=1&moda=" . $moda . "&service=" . $service . "&terBerat=" . $terberat . "&id_agent=0&jenisBiaya=" . $billID."&discount=0",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers
        ));
        $responsenya = curl_exec($curl);
        $isi = json_decode($responsenya);
        if ($isi->status == "success") {
            $data['total2']=$isi->data->total;
            $data['total']=str_replace(".", "", $isi->data->total);
        }else{
            $data['total2']="0";
            $data['total']="0";
        }
        echo json_encode($data);
    }

    public function showGrandTotal()
    {
        $subtotal=$this->input->post("subtotal");
        $nilaiCOD=$this->input->post("nilaiCOD");
        $billID=$this->input->post("billingID");
        if ($billID!="") {
           $headers = array(
            "key: 300dfaa09d3079dbf9af803a6ae42209"
        );

           $curl = curl_init();

           curl_setopt_array($curl, array(
            CURLOPT_URL => "https://restapi.progitoken.com/byAdmin/android/?jenis=5&ID=",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers
        ));
           $responsenya = curl_exec($curl);
           $isi = json_decode($responsenya);
           if ($isi->status == "success") {
            $persen=$isi->data->persenAplikasi;
            $byAdmin=(($subtotal+$nilaiCOD)*$persen)/100;
            $total=$subtotal+$nilaiCOD+$byAdmin;
            $data['total2']=number_format($total);
            $data['total']=$total;
            $data['feeCOD2']=number_format($byAdmin);
            $data['feeCOD']=$byAdmin;
            $data['persentaseCOD']=$persen;

        }else{
            $total=$subtotal;
            $data['total2']=number_format($total);
            $data['total']=$total;
            $data['feeCOD2']="0";
            $data['feeCOD']="0";
            $data['persentaseCOD']="0";
        }
    }else{
        $total=$subtotal;
        $data['total2']=number_format($total);
        $data['total']=$total;
        $data['feeCOD2']="0";
        $data['feeCOD']="0";
        $data['persentaseCOD']="0";
    }
    echo json_encode($data);
}

public function actAddBooking()
{
    $idPengirim = $this->input->post('idPengirim');
    $namaPenerima = $this->input->post('namaPenerima');
    $telpPenerima = $this->input->post('telpPenerima');
    $alamatPenerima1 = $this->input->post('alamatPenerima1');
    $alamatPenerima2 = $this->input->post('alamatPenerima2');
    $tipePengiriman = $this->input->post('tipePengiriman');
    $namaPaket = $this->input->post('productName');
    $jenisBarang = $this->input->post('jenisBarang');
    $keterangan = $this->input->post('keterangan');
    $koli = $this->input->post('Koli');
    $nilaiBarangCOD = $this->input->post('nilaiBarang');
    $persentaseCOD = $this->input->post('persentaseCOD');
    $asal = $this->input->post('asalHarga');
    $tujuan = $this->input->post('tujuanHarga');
    $idComp = $this->input->post('idPerusahaan');
    $idEkspedisi = $this->input->post('idEkspedisi');
    $totbi = $this->input->post('biayaTransaksi');
    $feeCOD = $this->input->post('feeCOD');
    $id_user = $this->session->userdata("userID");
    $panjang=$this->input->post("panjang");
    $lebar=$this->input->post("lebar");
    $tinggi=$this->input->post("tinggi");
    $berat=$this->input->post("berat");
    $waktuPickup=$this->input->post("waktuPickup");

    $rPengirim = $this->m_pengirim->showDetail($idPengirim)->row();
    $rUser = $this->m_login->cek_login("tbl_register",array("id"=>$id_user))->row();
    $rComp = $this->m_data->getCompany($idComp)->row();
    $tgl   = 'PPD' . date('ymd');
    $username = ucwords($rUser->username);
    $statusTrack = 'Booking di input Oleh ' . $username . ' pada tanggal ' . date('Y-m-d H:i:s');

    $PO = $this->m_booking->generateBook($tgl);
    $arrPanjang = array();
    $arrLebar = array();
    $arrTinggi = array();
    $arrBerat = array();
    $arrKonidKoli = array();
    $arrTotBerat = 0;

    for ($i = 0; $i < $koli; $i++) {
        $isiPanjang = "panjang%5B" . $i . "%5D=" . $panjang[$i];
        $isiLebar = "lebar%5B" . $i . "%5D=" . $lebar[$i];
        $isiTinggi = "tinggi%5B" . $i . "%5D=" . $tinggi[$i];
        $isiBerat = "berat%5B" . $i . "%5D=" . $berat[$i];
        $isiKonidKoli = "KonidKoli%5B" . $i . "%5D=" . $PO . "-" . ($i + 1);

        $arrPanjang[] = $isiPanjang;
        $arrLebar[] = $isiLebar;
        $arrTinggi[] = $isiTinggi;
        $arrBerat[] = $isiBerat;
        $arrKonidKoli[] = $isiKonidKoli;
        $arrTotBerat += $berat[$i];
    }
    $implodePanjang = "&" . implode("&", $arrPanjang);
    $implodeLebar = "&" . implode("&", $arrLebar);
    $implodeTinggi = "&" . implode("&", $arrTinggi);
    $implodeBerat = "&" . implode("&", $arrBerat);
    $implodeKonidKoli = "&" . implode("&", $arrKonidKoli);
    $dataAPI = array(
        "Konid" => $PO,
        "Tgl_Konos" => date("Y-m-d"),
        "Asal" => $asal,
        "Tujuan" => $tujuan,
        "Koli" => $koli,
        "Kilo" => $arrTotBerat,
        "productName" => $namaPaket,
        "Jenis_Biaya" => 1,
        "Jenis_Barang" => $jenisBarang,
        "Keterangan" => $keterangan,
        "Pengirim" => $rPengirim->namaPengirim,
        "namaPengirim" => $rPengirim->namaPengirim,
        "alamatPengirim" => $rPengirim->alamat,
        "telpPengirim" => $rPengirim->telp,
        "namaPenerima" => $namaPenerima,
        "alamatPenerima" => $alamatPenerima1,
        "telpPenerima" => $telpPenerima,
        "Totbi" => $totbi,
        "statusBooking" => 0,
        "Tanggal" => date('Y-m-d H:i:s'),
        "Barcode" => $PO,
        "Status" => $statusTrack,
        "Latitude" => 0,
        "Longitude" => 0,
        "nilaiCOD" => $nilaiBarangCOD,
        "persentaseCOD" => $persentaseCOD,
        "feeCOD" => $feeCOD,
        "userID" => $id_user,
        "idEkspedisi" => $idEkspedisi,
        "waktuPickup" => $waktuPickup,
        "byAplikasi" => "0",
        "discount" => "0",
        "key" => $rComp->keyApi
    );
    $headers = array(
        "key: " . $rComp->keyApi
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $rComp->baseUrl . "reseller/booking/insert/progi/?key=" . $rComp->keyApi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($dataAPI) . $implodePanjang . $implodeLebar . $implodeTinggi . $implodeBerat . $implodeKonidKoli,
        CURLOPT_HTTPHEADER => $headers
    ));
    $responsenya = curl_exec($curl);
    $isi = json_decode($responsenya);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode==200) {
        if ($isi->status == true) {
         $no = 1;
         $TotalWeight=0;
         $TotalVolume=0;
         $TotalterBerat1=0;
         for ($i = 0; $i < $koli; $i++) {

            $Panjang   = $panjang[$i];
            $Lebar     = $lebar[$i];
            $Tinggi    = $tinggi[$i];
            $Berat     = $berat[$i];
            $Vlm       = $Panjang * $Lebar * $Tinggi;

            $Volume = $Vlm / $isi->data->divider;

            if ($Volume >= $Berat) {
                $terBerat = $Volume;
                $hasil += $terBerat;
            } else {
                $terBerat = $Berat;
                $hasil = $terBerat;
            }

            $sqlInsertItems = "INSERT INTO log_booking_dimensi 
            (
                Konid,
                KonidKoli,
                Panjang,
                Lebar,
                Tinggi,
                Volume,
                Berat,
                terBerat,
                CreateUserId
                ) 
            VALUES( 
                '".$PO."',
                '".$PO . "-" . $no."',
                '".$Panjang."',
                '".$Lebar."',
                '".$Tinggi."',
                '".$Volume."',
                '".$Berat."',
                '".$terBerat."',
                '".$id_user."'
            )";
            $stmtInsertItems = $this->db->query($sqlInsertItems);
            $TotalWeight += $Berat;
            $TotalVolume += $Volume;
            $TotalterBerat1 = $terBerat;
            $no++;
        }
        $TotalterBerat = $TotalterBerat1;

        $sql = "INSERT INTO log_booking 
        (
            Konid,
            Tgl_Konos,
            custID,
            Satuan,
            moda,
            Asal,
            Tujuan,
            Koli,
            Kilo,
            productName,
            Jenis_Biaya,
            Jenis_Barang,
            Keterangan,
            Pengirim,
            namaPengirim,
            alamatPengirim1,
            telpPengirim,
            namaPenerima,
            alamatPenerima1,
            telpPenerima,
            Tarif,
            Tarif_Kg1,
            minKG,
            leadTime,
            Totbi,
            createdUserId,
            branch,
            statusBooking,
            kodePerusahaan,
            nilaiCod,
            persentaseCOD,
            feeCod,
            waktuPickup
            )VALUES(   
            '".$PO."',
            '".date("Y-m-d")."',
            '".$isi->data->custID."',
            '".$isi->data->Satuan."',
            '".$isi->data->moda."',
            '".$isi->data->Asal."',
            '".$isi->data->Tujuan."',
            '".$koli."',
            '".$TotalWeight."',
            '".$namaPaket."',
            '".$isi->data->Jenis_Biaya."',
            '".$jenisBarang."',
            '".$keterangan."',
            '".$rPengirim->namaPengirim."',
            '".$rPengirim->namaPengirim."',
            '".$rPengirim->alamat."',
            '".$rPengirim->telp."',
            '".$namaPenerima."',
            '".$alamatPenerima1."',
            '".$telpPenerima."',
            '".$isi->data->Tarif."',
            '".$isi->data->Tarif_Kg1."',
            '".$isi->data->minKG."',
            '".$isi->data->leadTime."',
            '".($totbi + $feeCOD)."',
            '".$id_user."',
            '".$isi->data->branchID."',
            '0',
            '".$idComp."',
            '".$nilaiBarangCOD."',
            '".$persentaseCOD."',
            '".$feeCOD."',
            '".$waktuPickup."'
        )";

        $stmt = $this->db->query($sql);
        if ($stmt=true) {
            $sqlInsertTrack = "INSERT INTO em_log_tracking 
            (
                Tanggal,
                Konid,
                Barcode,
                Status,
                Latitude,
                Longitude,
                createUserID
                ) 
            VALUES( 
               '".date('Y-m-d H:i:s')."',
               '".$PO."',
               '".$PO."',
               '".$statusTrack."',
               '0',
               '0',
               '".$id_user."'
           )";
           $stmtInsertTrack = $this->db->query($sqlInsertTrack);
           if ($stmtInsertTrack=true) {
            echo "good";
        }else{
           return false;   
       }
    }//$stmt=true
    else{
        return false;
    }//else $stmt=true
        }//$isi->status == true
        else{
            return false;
        }//else $isi->status == true
    }//$httpCode==200
    else{
        echo $httpCode;
    }//else $httpCode==200
}

public function deleteBook()
{
    $id=$this->input->post("id");
    $userID=$this->session->userdata("userID");

    $rBook = $this->db->query("SELECT a.*,b.keyApi,b.baseUrl from log_booking a left join em_company b on a.kodePerusahaan=b.id where a.ID='" . $id . "'")->row();

    $rUser = $this->db->query("SELECT * from tbl_register where id='" . $userID . "'")->row();

    $dataFlag = array(
        "Konid" => $rBook->Konid,
        "firstName" => $rUser->nama,
        "key" => $rBook->keyApi
    );
    $headersFlag = array(
        "key: " . $rBook->keyApi
    );
    $curlFlag = curl_init();

    curl_setopt_array($curlFlag, array(
        CURLOPT_URL => $rBook->baseUrl . "reseller/booking/delete/progi/?key=" . $rBook->keyApi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($dataFlag),
        CURLOPT_HTTPHEADER => $headersFlag
    ));
    $responseFlag = curl_exec($curlFlag);
    $isi = json_decode($responseFlag);
    if ($isi->status == true) {
        $sqlInsertTrack = "INSERT INTO em_log_tracking 
        (
            Tanggal,
            Konid,
            Barcode,
            Status,
            Latitude,
            Longitude,
            createUserID
            ) 
        VALUES( 
            '".date('Y-m-d H:i:s')."',
            '".$rBook->Konid."',
            '".$rBook->Konid."',
            'Booking dihapus dan dibatalkan oleh " . $rUser->nama . " pada ". date('Y-m-d H:i:s')."',
            '0',
            '0',
            '".$userID."'
        )";
        $stmtInsertTrack = $this->db->query($sqlInsertTrack);

        if ($stmtInsertTrack=true) {
            $qUpBook = $this->db->query("UPDATE log_booking SET statusBooking=1,flagBayar=0 WHERE Konid='" . $rBook->Konid . "'");
            if ($qUpBook=true) {
                echo "good";
            }else{
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }

}

public function pembayaran()
{
        $this->data['pembayaranPending']=$this->m_booking->showData($this->session->userdata("userID"),"2")->result();
        $this->data['pembayaranSelesai']=$this->m_booking->showData($this->session->userdata("userID"),"1")->result();
    $this->web = 'content/progi/v_booking_pembayaran';
    $this->dashboard();   
}

public function detail($id)
    {
        $this->data['booking']=$this->m_booking->showBooking($id)->row();
        $this->web = 'content/progi/v_booking_detail';
        $this->dashboard();   
    }

public function detailBayar($id)
    {
        $booking=$this->m_booking->showBooking($id)->row();
        $this->data['booking']=$booking;
        $rComp= $this->m_data->getCompany($booking->kodePerusahaan)->row();
        $dataAPI = array(
            "Konid" => $booking->Konid,
            "key" => $rComp->keyApi
        );

        $headers = array(
            "key: " . $rComp->keyApi
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $rComp->baseUrl . "reseller/booking/tracking/progi/?key=" . $rComp->keyApi,
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
        $this->data['isi'] = json_decode($responsenya);

        $dataWallet = array("jenis"=>"1","statusPpob"=>"Y","statusAgent"=>"Y" );
        $curlWallet = curl_init();
        curl_setopt_array($curlWallet, array(
            CURLOPT_URL => 'https://restapi.progitoken.com/wallet/topup/android/?key=300dfaa09d3079dbf9af803a6ae42209',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($dataWallet),
            CURLOPT_HTTPHEADER => array(
                'key: 300dfaa09d3079dbf9af803a6ae42209',
                'Cookie: PHPSESSID=od825ic1179aon5i4lv7s6h1n4'
            ),
        ));
        $responseWallet = curl_exec($curlWallet);
        curl_close($curlWallet);
        $this->data['isiWallet'] = json_decode($responseWallet);

        $subadmin=($booking->Totbi*2)/100;
        $admin=$subadmin+(($subadmin*11)/100);
        $this->data['byAdmin']=$admin;

        $this->web = 'content/progi/v_booking_detail_bayar';
        $this->dashboard();   
    }
}