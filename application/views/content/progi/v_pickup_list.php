<?php
$bln=array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'); 

$statusName=$_GET['statusName'];
$bulan=$_GET['bulan'];
$tahun=$_GET['tahun'];
$status=$_GET['status'];
if ($status == "0") {
    $where = " and a.statusBooking=0 and a.flagBayar in(0,2)";
} else if ($status == "1") {
    $where = " and a.statusBooking=1";
} else if ($status == "10") {
    $where = " and a.statusBooking in(0,2) and a.flagBayar=1";
} else if ($status == "4") {
    $where = " and a.statusBooking=4";
} else {
    $where = " and a.statusBooking=4 and a.flagBayar=1 and (a.feeCod!=0 or a.nilaiCod!=0)";
}

$startDate = $tahun . '-' . $bulan . '-01';
$endDate = $tahun . '-' . $bulan . '-' . date('t', strtotime($startDate));

$qPic = $this->db->query("SELECT a.*,b.keyApi,b.baseUrl,b.foto from log_booking a left join em_company b on a.kodePerusahaan=b.id where  a.CreatedUserId='" . $userID . "' and a.Tgl_Konos BETWEEN '" . $startDate . "' and '" . $endDate . "' ".$where." order by a.Tgl_Konos DESC,a.Konid DESC ");
$rPic = $qPic->result();
$booking=$rPic;
$param="?statusName=".$statusName."&bulan=".$bulan."&tahun=".$tahun."&status=".$status;
?>
<h1 class="mt-4"><?=$statusName?></h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body row">
            <div class="mb-3 col-lg-12">
                <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-1 fs-13">Periode : </label>
                    <div class="col-lg-2 px-1">
                        <input type="text" class="form-control" placeholder="Nama Penerima" autocomplete="off" readonly value="<?=$bln[$bulan]?>">
                    </div>
                    <div class="col-lg-2 px-1">
                        <input type="text" class="form-control" placeholder="Nama Penerima" autocomplete="off" readonly value="<?=$tahun?>">
                    </div>
                    <div class="col-lg-2 px-1">
                        <a href="<?=base_url()?>pickup" class="btn btn-success float-end"><i class="fa fa-backward"></i> Kembali</a>
                   </div>
               </div>

           </div>
           <div class="mb-3 col-lg-12 table-responsive">
            <table id="dtb_manual_pending" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. AWB</th>
                        <th>Created Date</th>
                        <th>Asal</th>
                        <th>Nama Pengirim</th>
                        <th>Tujuan</th>
                        <th>Nama Penerima</th>
                        <th>Pembayaran</th>
                        <th>Company</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($booking as $key) {
                        $dataAPI = array(
                            "Konid" => $key->Konid,
                            "key" => $key->keyApi
                        );

                        $headers = array(
                            "key: " . $key->keyApi
                        );

                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $key->baseUrl . "reseller/listbooking/progi/?key=" . $key->keyApi . "&Konid=" . $key->Konid,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_POSTFIELDS => http_build_query($dataAPI),
                            CURLOPT_HTTPHEADER => $headers
                        ));
                        $responsenya = curl_exec($curl);
                        $isi = json_decode($responsenya);
                        if ($isi->data != null) {
                            echo '
                            <tr>
                            <td>'.$no.'.</td>
                            <td>'.$isi->data->Konid.'</td>
                            <td>'.$isi->data->Tgl_Konos.'</td>
                            <td>'.$isi->data->Asal.'</td>
                            <td>'.$isi->data->namaPengirim.'</td>
                            <td>'.$isi->data->Tujuan.'</td>
                            <td>'.$isi->data->namaPenerima.'</td>
                            <td>'.$isi->data->tipePembayaran.' '.$isi->data->serviceName.'</td>
                            <td><img src="https://admin103.progitoken.com/modul/company/foto/'.$key->foto.'" width="50"></td>
                            <td>Rp '.number_format($isi->data->Totbi).'</td>
                            <td>
                            <a href="'.base_url().'pickup/pickupTrack/'.$key->ID.$param.'" class="btn btn-primary">Detail</a>
                            </tr>
                            ';
                            $no++;
                                }//$isi->data != null
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
     $(document).ready(function() {
        $("#dtb_manual_pending").DataTable();
    })
</script>