<h1 class="mt-4">Dashboard</h1>

<section class="container-fluid tracking-awb-progi wow fadeInUp" data-wow-delay="0.2s">
    <fieldset>
        <div class="scrollmenu">
            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr class="bg-blue">
                        <th>No. AWB</th>
                        <th>No. DO</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Consignee</th>
                        <th>Date Received</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
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
                    <!-- Trackingnya -->
                    <tr>
                        <td><?= $isi->data[0]->Konid; ?></td>
                        <td><?= $isi->data[0]->No_DO; ?></td>
                        <td><?= $isi->data[0]->asal; ?></td>
                        <td><?= $isi->data[0]->tujuan; ?></td>
                        <td><?= $isi->data[0]->namaPenerima; ?></td>
                        <td><?= $isi->data[0]->Tgl_Diterima; ?></td>
                        <td><?= $isi->data[0]->statusDiterima == 0 ? 'On Proccess' : ($isi->data[0]->statusDiterima == 1 ? 'Back to Office' : 'Accepted'); ?>
                        </td>
                        <td><a href="#" class="btn btn-warning btn-flat btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalTrackAwb<?= $isi->data[0]->Konid; ?>"
                                title="Detail <?= $isi->data[0]->Konid; ?>">Detail</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </fieldset>
</section>

<div class="modal fade" id="modalTrackAwb<?= $isi->data[0]->Konid; ?>" data-aos="fade-up" data-aos-duration="800">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">TRACKING</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <section class="tracking_awb_detail">

                    <div class="container">
                        <div class="section-heading">
                            <h2 class="text-center">TRACKING</h2>
                            <br><br>
                            <div class="mx-auto">
                                <h3>Tracking AWB No: <?= $isi->data[0]->Konid; ?></h3>
                                <fieldset>
                                    <legend>Keterangan Pengirim</legend>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="title">No. Resi</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->Konid; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Nama Pengirim</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->namaPengirim; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Kota Asal</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->asal; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <br>
                                <fieldset>
                                    <legend>Keterangan Penerima</legend>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="title">Nama Penerima</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->namaPenerima; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Kota Tujuan</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->tujuan; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Jumlah Barang</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->Koli; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Berat</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->Kilo; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <br>
                                <fieldset>
                                    <legend>Informasi Penerima Barang</legend>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="title">Status</td>
                                                <td class="dua">:</td>
                                                <td class="desk">
                                                    <?= $isi->data[0]->statusDiterima == 0 ? 'On Proccess' : ($isi->data[0]->statusDiterima == 1 ? 'Back to Office' : 'Accepted'); ?>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="title">Diterima Oleh</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->namaPenerima; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="title">Tanggal</td>
                                                <td class="dua">:</td>
                                                <td class="desk"><?= $isi->data[0]->Tgl_Diterima; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>

                            <br>
                            <fieldset>
                                <legend>Tracking</legend>
                                <div class="scrollmenu">
                                    <table class="table table-bordered trackLog" border="1">
                                        <thead>
                                            <tr class="bg-blue">
                                                <th width="20%" style="padding-left: 8px;">Tanggal</th>
                                                <th style="padding-left: 8px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
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
                                                <td style="padding-left: 8px;">
                                                    <?= $trackLog->day . ', ' . $trackLog->tanggal . ' ' . $trackLog->waktu; ?>
                                                </td>
                                                <td style="padding-left: 8px;"><?= $trackLog->Status; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>