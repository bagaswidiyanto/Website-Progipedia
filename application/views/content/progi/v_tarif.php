<?php
$qComp = $this->db->query("SELECT * FROM `em_company` WHERE `baseUrl` != '' and status='Y' order by namaPerusahaan asc")->result();
$curlService = curl_init();

curl_setopt_array($curlService, array(
    CURLOPT_URL => 'https://restapi.progitoken.com/dev/master/service/progi?key=300dfaa09d3079dbf9af803a6ae42209',
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

$responseService = curl_exec($curlService);
curl_close($curlService);
$isiService = json_decode($responseService);
$jmlSrv=count($isiService->data);
?>
<nav>
  <div class="nav nav-pills mb-4" id="nav-tab" role="tablist">
    <?php foreach ($isiService->data as $sn) { ?>
        <button class="nav-link" id="nav-home-tab-<?=$sn->serviceID?>" data-bs-toggle="tab" data-bs-target="#tab<?=$sn->serviceID?>" type="button" role="tab" aria-controls="tab<?=$sn->serviceID?>" onclick="showTab(<?=$sn->serviceID?>)"><?=$sn->serviceName?></button>
    <?php } ?>
</div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <?php foreach ($isiService->data as $srv) { ?>
      <div class="tab-pane fade" id="tab<?=$srv->serviceID?>" role="tabpanel" aria-labelledby="tab<?=$srv->serviceID?>-tab">

        <table id="dtb_manual_<?=$srv->serviceID?>" class="table table-bordered table-striped">
            <thead>
                <tr>
                 <th>No.</th>
                 <th>Company</th>
                 <th>Service</th>
                 <th>Moda</th>
                 <th>Tarif</th>
                 <th>Estimasi</th>
             </tr>
         </thead>
         <tbody>
            <?php
            $no=1;
            foreach ($qComp as $key) {


                if ($key->id == "5") {
                    $dataAPI = array(
                                    "kecAsal" => $branchNameAsal, //diambil dari value branchName asal
                                    "kabAsal" => $branchNameAsal, //diambil dari value branchName asal
                                    "kecTujuan" => $branchNameTujuan, //diambil dari value branchName tujuan
                                    "kabTujuan" => $branchNameTujuan, //diambil dari value branchName tujuan
                                    "serviceID" => $srv->serviceID,
                                    "key" => $key->keyApi,
                                );
                } else {
                    $dataAPI = array(
                                    "kecAsal" => $kecNameAsal, //diambil dari value kecname asal
                                    "kabAsal" => $kabupatenNameAsal, //diambil dari value kabname asal
                                    "kecTujuan" => $kecNameTujuan, //diambil dari value kecname tujuan
                                    "kabTujuan" => $kabupatenNameTujuan, //diambil dari value kabname tujuan
                                    "serviceID" => $srv->serviceID,
                                    "key" => $key->keyApi
                                );
                }


                $headers = array(
                    "key: " . $key->keyApi
                );

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $key->baseUrl . "reseller/prices/progi/?key=" . $key->keyApi,
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
                if ($isi->status == "success") {

                    foreach ($isi->data as $value) {
                        if ($value->KGP != "0") {
                            $kgp = $value->KGP;
                        } else {
                            $kgp = $value->KGS;
                        }

                        if ($kgp != '') {
                            $trf = $kgp;
                        } else {
                            $trf = '0';
                        }
                        $harga = $trf;
                        if ($harga == '0.00') {
                            $harganya="0";
                        }else{
                           $harganya='Rp ' . number_format($harga, 0, ",", ".");
                       }
                       if($value->Estimasi != ''){
                        $lt=$value->Estimasi . ' hari';
                    }else{
                        $lt='-';
                    }
                    echo '
                    <tr>
                    <td>'.$no.'.</td>
                    <td><img src="https://admin103.progitoken.com/modul/company/foto/'.$key->foto.'" class="img-fluid" alt="" width="50"></td>
                    <td>'.$value->Layanan.'</td>
                    <td>'.$value->Via.'</td>
                    <td>'.$harganya.'</td>
                    <td>'.$lt.'</td>
                    </tr>
                    ';
                    $no++;
                }
            }
        }
        ?>
    </tbody>
</table>

<?php
}
?>
</div>
</div>

<script type="text/javascript">
    showTab("1");
    function showTab(id) {
        $("#nav-home-tab-"+id).addClass("active");
        $("#nav-home-tab-"+id).prop("aria-selected",true);
        $("#tab"+id).addClass("show active");
        $("#dtb_manual_"+id).DataTable();
        for (var i = 1; i <= '<?=$jmlSrv?>'; i++) {
            if (i!=id) {
                $("#nav-home-tab-"+i).removeClass("active");
                $("#nav-home-tab-"+i).prop("aria-selected",false);
                $("#tab"+i).removeClass("show active");
                $("#dtb_manual_"+i).DataTable().destroy();
            }
        }
    }
</script>
