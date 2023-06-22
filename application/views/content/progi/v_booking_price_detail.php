<table class="table table-bordered" id="dtb_manual">
    <thead>
        <th>No.</th>
        <th>Company</th>
        <th>Service</th>
        <th>Moda</th>
        <th>Tarif</th>
        <th>Estimasi</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        $qComp = $this->db->query("SELECT * FROM `em_company` WHERE `baseUrl` != '' and status='Y' order by namaPerusahaan asc")->result();
        $no=1;
        foreach ($qComp as $key) {

            if ($key->id == "5") {
                $dataAPI = array(
                    "kecAsal" => $branchNameAsal,
                    "kabAsal" => $branchNameAsal,
                    "kecTujuan" => $branchNameTujuan,
                    "kabTujuan" => $branchNameTujuan,
                    "serviceID" => $serviceID,
                    "key" => $key->keyApi,
                );
            } else {
                $dataAPI = array(
                    "kecAsal" => $kecNameAsal,
                    "kabAsal" => $kabAsal,
                    "kecTujuan" => $kecNameTujuan,
                    "kabTujuan" => $kabTujuan,
                    "serviceID" => $serviceID,
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
                        $harganya=0;
                    }else{
                        $harganya='Rp ' . number_format($harga, 0, ",", ".");
                    }

                    if ($value->Estimasi != '') {
                        $lt=$value->Estimasi . ' hari';
                    }else{
                        $lt='-';
                    }
                    ?>
                    <tr>
                        <td><?=$no?>.</td>
                        <td><img src="https://admin103.progitoken.com/modul/company/foto/<?= $key->foto; ?>"
                            class="img-fluid" alt="" width="50"></td>
                            <td><?=$value->Layanan?></td>
                            <td><?=$value->Via?></td>
                            <td><?= $harganya?></td>
                            <td><?=$lt?></td>
                            <td><a onclick="pilihPrice(<?=$value->ID?>,<?=$value->divider?>)" class="btn btn-success">Pilih</a></td>
                             <input type="hidden" id="fotoP<?=$value->ID?>" value="https://admin103.progitoken.com/modul/company/foto/<?= $key->foto; ?>">
                                <input type="hidden" id="layananP<?=$value->ID?>" value="<?=$value->Layanan?>">
                                <input type="hidden" id="modaP<?=$value->ID?>" value="<?=$value->Via?>">
                                <input type="hidden" id="hargaP<?=$value->ID?>" value="<?=$harganya?>">
                                <input type="hidden" id="ltP<?=$value->ID?>" value="<?=$lt?>">
                                
                                <input type="hidden" id="asalP<?=$value->ID?>" value="<?=$value->Origin?>">
                                <input type="hidden" id="tujuanP<?=$value->ID?>" value="<?=$value->Destination?>">
                                <input type="hidden" id="idPerusahaanP<?=$value->ID?>" value="<?=$key->id?>">
                                <input type="hidden" id="modaIDP<?=$value->ID?>" value="<?=$value->Moda?>">
                                <input type="hidden" id="serviceIDP<?=$value->ID?>" value="<?=$value->serviceID?>">
                        </tr>
                        <?php 
                        $no++;
                    } ?>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>

    <script type="text/javascript">
        $("#dtb_manual").DataTable();
    </script>

