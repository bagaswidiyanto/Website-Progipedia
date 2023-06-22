<h1 class="mt-4">Detail Booking</h1>
<?php
$statusName=$_GET['statusName'];
$bulan=$_GET['bulan'];
$tahun=$_GET['tahun'];
$status=$_GET['status'];
$param="?statusName=".$statusName."&bulan=".$bulan."&tahun=".$tahun."&status=".$status;
$rComp = $this->db->query("SELECT * from em_company where id='" . $booking->kodePerusahaan . "'")->row();
$linkFoto=str_replace("uploads/","",$rComp->linkFoto);
?>
<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body row">
            <div class="mb-3 col-lg-12">
                <div class="float-end">
                    <a href="https://admin103.progipedia.com/modul/print_awb/print.php?id=<?=$booking->Konid?>" target="_blank" class="btn btn-primary"> Print AWB</a>
                    <a href="<?=base_url()?>pickup/listPickup/<?=$param?>" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                </div>
            </div>
            <?php

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
            $isi = json_decode($responsenya);
        ?>      <div class="card-body">
            <div class="mb-4">
             <div class="row">
                <label class="form-label fw-bold col-lg-2">Ekspedisi</label>
                <div class="col-lg-4">
                    <p>: <?= $rComp->namaPerusahaan; ?></p>
                </div>
            </div>
            <div class="row">
                <label class="form-label fw-bold col-lg-2">No. AWB</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->konid; ?></p>
                </div>
                <label class="form-label fw-bold col-lg-2">Tanggal Input AWB</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->tglKonos; ?></p>
                </div>
            </div>
            <div class="row">
                <label class="form-label fw-bold col-lg-2">No. DO</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->noDo; ?></p>
                </div>
            </div>
            <div class="row">
                <label class="form-label fw-bold col-lg-2">Nama Pengirim</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->namaPengirim; ?></p>
                </div>
                <label class="form-label fw-bold col-lg-2">Nama Penerima</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->namaPenerima; ?></p>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row">
                <label class="form-label fw-bold col-lg-2">Asal</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->asal; ?></p>
                </div>
                <label class="form-label fw-bold col-lg-2">Tujuan</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->tujuan; ?></p>
                </div>
            </div>
            <div class="row">
                <label class="form-label fw-bold col-lg-2">Alamat Pengirim</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->alamatPengirim1; ?></p>
                </div>
                <label class="form-label fw-bold col-lg-2">Alamat Penerima</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->alamatPenerima1; ?> <?= $isi->data->alamatPenerima2; ?></p>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="row">
                <label class="form-label fw-bold col-lg-2">Service</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->serviceName; ?></p>
                </div>
            </div>
            <div class="row">
                <label class="form-label fw-bold col-lg-2">Koli</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->koli; ?> Koli</p>
                </div>
                <label class="form-label fw-bold col-lg-2">Kilo</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->kilo; ?> Kg</p>
                </div>
            </div>

            <div class="row">
                <label class="form-label fw-bold col-lg-2">Catatan</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->keterangan; ?></p>
                </div>
                <label class="form-label fw-bold col-lg-2">Tipe Pengiriman</label>
                <div class="col-lg-4">
                    <p>: <?= $isi->data->jenisBiaya; ?></p>
                </div>
            </div>

            <div class="row">
                <label class="form-label fw-bold col-lg-2">Biaya Transaksi</label>
                <div class="col-lg-4">
                    <p>: Rp <?= number_format($isi->data->totbi-$isi->data->feeCod); ?></p>
                </div>
            </div>

            <div class="row">
                <label class="form-label fw-bold col-lg-2">Biaya Admin</label>
                <div class="col-lg-4">
                    <p>: Rp <?= number_format($isi->data->byAplikasi); ?></p>
                </div>
            </div>
            <?php
            if ($isi->data->jenisBiaya=="COD") {?>
              <div class="row">
                <label class="form-label fw-bold col-lg-2">Nilai Barang</label>
                <div class="col-lg-4">
                    <p>: Rp <?= number_format($isi->data->nilaiCod); ?></p>
                </div>
            </div>

            <div class="row">
                <label class="form-label fw-bold col-lg-2">Fee COD</label>
                <div class="col-lg-4">
                    <p>: Rp <?= number_format($isi->data->feeCod); ?></p>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row">
            <label class="form-label fw-bold col-lg-2">Grand Total</label>
            <div class="col-lg-4">
                <p>: Rp <?= number_format($isi->data->totbi+$isi->data->byAplikasi); ?></p>
            </div>
        </div>
    </div>
</div>

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
            foreach ($isi->tracking as $trackLog) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $trackLog->day . ', ' . $trackLog->tanggal; ?></td>
                    <td><?= $trackLog->waktu; ?></td>
                    <td><?= $trackLog->status; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>