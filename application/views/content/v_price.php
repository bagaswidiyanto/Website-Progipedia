<div class="container-xxl px-0 hero-header position-relative">
    <div class="container py-5 px-lg-5">
        <h1><?= $txt->title; ?></h1>
        <p><?= $txt->deskripsi; ?></p>
    </div>
</div>

<div class="container-xxl tracking">
    <div class="container px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="800">
                <form id="cekTarif" action="<?= base_url('prices'); ?>" method="post">
                    <div class="mb-3 row align-items-center">
                        <label class="col-lg-4 fs-13">Origin</label>
                        <div class="col-lg-8 px-1">
                            <input type="text" id="hint" name="asal" class="form-control ui-autocomplete-input"
                                placeholder="Kota Asal">
                            <input type="hidden" id="asal" name="dari" class="form-control">
                            <input type="hidden" id="kabAsal" name="kabAsal" class="form-control">
                            <input type="hidden" id="branchNameAsal" name="branchNameAsal" class="form-control">
                            <input type="hidden" id="kecNameAsal" name="kecNameAsal" class="form-control">
                            <input type="hidden" id="kabupatenNameAsal" name="kabupatenNameAsal" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <label class="col-lg-4 fs-13">Destination</label>
                        <div class="col-lg-8 px-1">
                            <input type="text" id="hint2" name="ke" class="form-control ui-autocomplete-input"
                                placeholder=" Kota Tujuan">
                            <input type="hidden" id="tujuan" name="tujuan" class="form-control" />
                            <input type="hidden" id="kabTujuan" name="kabTujuan" class="form-control">
                            <input type="hidden" id="branchNameTujuan" name="branchNameTujuan" class="form-control">
                            <input type="hidden" id="kecNameTujuan" name="kecNameTujuan" class="form-control">
                            <input type="hidden" id="kabupatenNameTujuan" name="kabupatenNameTujuan"
                                class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <label class="col-lg-4 fs-13">Berat (Weight)</label>
                        <div class="col-lg-8">
                            <div class="row align-items-center">
                                <div class="col-4 px-1">
                                    <div class="position-relative">
                                        <input type="text" name="berat" class="form-control pe-5" placeholder="Ex: 1"
                                            onkeypress="return hanyaAngka(event)">
                                        <p class="position-absolute top-0 end-0 m-2">KG</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label class="col-lg-4 fs-13"></label>
                        <div class="col-lg-8">
                            <button type="submit"
                                class="btn bg-blue fw-bold rounded-10 border-0 mt-3 px-5">SEARCHING</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<?php
$qComp = $this->db->query("SELECT * FROM `em_company` WHERE `baseUrl` != '' and status='Y' order by namaPerusahaan asc")->result();

if (isset($kecNameAsal) && isset($kecNameTujuan)) { ?>

<div class="container-xxl tracking wow fadeInUp" data-wow-delay="0.2s">
    <div class="container px-lg-5">


        <div class="header-tracking">
            <table>
                <tr>
                    <td style="width: 30%;">Dari</td>
                    <td style="width: 4%;">:</td>
                    <td> <?= $this->input->post('kabAsal'); ?></td>
                </tr>
                <tr>
                    <td style="width: 30%;">Destination</td>
                    <td style="width: 4%;">:</td>
                    <td> <?= $this->input->post('kabTujuan'); ?></td>
                </tr>
                <tr>
                    <td style="width: 30%;">Berat</td>
                    <td style="width: 4%;">:</td>
                    <td> <?= $this->input->post('berat'); ?></td>
                </tr>
            </table>
        </div>
        <?php
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
            ?>

        <div class="service py-4">
            <ul class="nav nav-tabs border-0" id="myTab">
                <?php foreach ($isiService->data as $sn) { ?>
                <li class="nav-item">
                    <a href="#tab-<?= $sn->serviceID; ?>" class="nav-link" title="<?= $sn->serviceName; ?>"
                        data-bs-toggle="tab"><?= $sn->serviceName; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-content pb-4">
            <?php
                // $no = 1;
                foreach ($isiService->data as $srv) {



                ?>
            <div class="tab-pane fade <?php
                                                if ($srv->serviceID == 1) {
                                                    echo "show active";
                                                } else {
                                                    echo "show active";
                                                }
                                                ?>" id="tab-<?= $srv->serviceID; ?>">
                <?php
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
                        ?>
                <div class="row bg-row">
                    <div class="col-lg-5">
                        <div class="d-flex align-items-center">
                            <div class="img me-3">
                                <img src="https://admin103.progitoken.com/modul/company/foto/<?= $key->foto; ?>"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="name">
                                <span>Nama Perusahaan</span>
                                <p><?= $key->namaPerusahaan; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <span>Service</span>
                        <p><?= $value->Layanan; ?></p>
                    </div>
                    <div class="col-lg-2">
                        <span>Tarif</span>
                        <p><?= $harga == '0.00' ? 0 : 'Rp ' . number_format($harga, 0, ",", "."); ?></p>
                    </div>
                    <div class="col-lg-1">
                        <span>Estimasi</span>
                        <p><?= $value->Estimasi != '' ? $value->Estimasi . ' hari' : '-';; ?></p>
                    </div>
                </div>

                <?php } ?>
                <?php } ?>
                <?php } ?>
            </div>

            <?php } ?>
        </div>

    </div>
</div>

<?php
}
?>