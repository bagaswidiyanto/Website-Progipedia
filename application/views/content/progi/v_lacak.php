<h1 class="mt-4">Lacak AWB</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-content">
                        <form method="POST" class="form-horizontal">
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Company</label>
                                <div class="col-lg-8 px-1">
                                    <select name="idCompany" id="idCompany" class="form-control select2"
                                    data-placeholder="Pilih Company" required onchange="showAWB(this.value)">
                                    <option value=""></option>
                                    <?php foreach ($company as $c) { ?>
                                    <option value="<?= $c->id; ?>"><?= $c->namaPerusahaan; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="baseUrl" id="baseUrl">
                                <input type="hidden" name="keyApi" id="keyApi">
                                </div>
                            </div>
                             <div class="mb-3 row align-items-center" id="lytAWB" hidden>
                                <label class="col-lg-4 fs-13">AWB/DO</label>
                                <div class="col-lg-8 px-1">
                                   <input type="text" name="awb" id="awb" class="form-control"
                                    placeholder="Masukan No. AWB/DO" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="d-flex row">
                                <label class="col-lg-4 fs-13">&nbsp;</label>
                                <div class="col-lg-8 px-1">
                                <button type="submit" class="btn btn-primary">Cek Pengiriman <i class="fa fa-check"
                                        aria-hidden="true"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $idCompany = $this->input->post('idCompany');
    if (isset($idCompany)) {
    ?>
    <div class="card mt-5">
        <div class="card-header">
            <h2>Tracing & Tracking </h2>
        </div>
        <?php

            $key = $this->db->query("SELECT * FROM `em_company` WHERE id = '" . $idCompany . "' order by namaPerusahaan asc")->row(); //$id itu dari company yg dipilih

            $dataAPI = array(
                "key" => $key->keyApi
            );


            $headers = array(
                "key: " . $key->keyApi
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $key->baseUrl . "tracking/android/progi/?key=" . $key->keyApi . "&awb=" . $awb, //diambil dari post input awb
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

            if ($isi->status == "success") { ?>
        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">No. AWB</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Konid; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Tanggal Input AWB</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->createDate; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">No. DO</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->No_DO; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Nama Pengirim</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->namaPengirim; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Nama Penerima</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->namaPenerima; ?></p>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Asal</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->asal; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Tujuan</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->tujuan; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Alamat Pengirim</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->alamatPengirim1; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Alamat Penerima</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->alamatPenerima1; ?> <?= $isi->data[0]->alamatPenerima2; ?></p>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Service</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->serviceName; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Moda</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->modaBy; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Koli</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Koli; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Kilo</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Kilo; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Volume</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Volume; ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Terberat</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->kgCharged; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">No Manifest</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->No_Manifest; ?></p>
                    </div>
                </div>
                <!-- <div class="row">
                    <label class="form-label fw-bold col-lg-2">Courier</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Konid; ?></p>
                    </div>
                </div> -->

                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Tanggal Diterima</label>
                    <div class="col-lg-4">
                        <?php
                        if (!empty($isi->data[0]->Tgl_Diterima)) {
                        if ($isi->data[0]->Tgl_Diterima!='0000-00-00 00:00:00') {
                         $Tgl_Diterima=date('d/m/Y',strtotime($isi->data[0]->Tgl_Diterima));
                        }else{
                            $Tgl_Diterima="-";
                        }    
                        }else{
                            $Tgl_Diterima="-";
                        }
                        ?>
                        
                        <p>: <?=$Tgl_Diterima  ?></p>
                    </div>
                    <label class="form-label fw-bold col-lg-2">Diterima Oleh</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Diterima; ?></p>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">Catatan</label>
                    <div class="col-lg-4">
                        <p>: <?= $isi->data[0]->Keterangan; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


    <div class="card">
        <div class="card-header">
            <h3>Log Tracking</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $curlDetail = curl_init();

                        curl_setopt_array($curlDetail, array(
                            CURLOPT_URL => $key->baseUrl . "tracking/detail/android/progi/?key=" . $key->keyApi . "&awb=" . $awb, //diambil dari post input awb
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
                        $responsenyaDetail = curl_exec($curlDetail);
                        $isiDetail = json_decode($responsenyaDetail);
                        if ($isiDetail->status == "success") {
                            //tracking detail
                            foreach ($isiDetail->data as $trackLog) {
                        ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $trackLog->day . ', ' . $trackLog->tanggal; ?></td>
                        <td><?= $trackLog->waktu; ?></td>
                        <td><?= $trackLog->Status; ?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</div>

<!-- <div class="col-lg-6">
    <div class="pengiriman">
        <div class="form-box">
            <div class="text-header p-4 wow fadeInUp" data-wow-delay="0.2s">
                <h4 class="text-white">Lacak Pengiriman</h4>
                <small class="text-white">*Lacak status pengiriman dengan menginput airwaybill</small>
            </div>
        </div>
        <div class="form-content p-4 wow fadeInUp" data-wow-delay="0.2s">
            <form id="cekTarif" action="<?= base_url('dashboard/tracking'); ?>" method="POST" class="login-form">
                <div class="mb-3">
                    <select name="idCompany" id="" class="form-control select2" data-placeholder="Pilih Company">
                        <option value=""></option>
                        <?php foreach ($company as $c) { ?>
                        <option value="<?= $c->id; ?>"><?= $c->namaPerusahaan; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="awb" id="awb" class="form-control" placeholder="Masukan No. AWB/DO">
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn bg-aqua btn-100">Cek Pengiriman <i class="fa fa-check"
                            aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-6">

</div> -->
<script type="text/javascript">
    function showAWB(id) {
        if (id!='') {
            $("#lytAWB").prop("hidden",false);
        }else{
            $("#lytAWB").prop("hidden",true);
        }
    }
</script>