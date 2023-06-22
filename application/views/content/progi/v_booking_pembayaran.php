<h1 class="mt-4">Pembayaran</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <nav>
  <div class="nav nav-pills mb-4" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#tabPending" type="button" role="tab" aria-controls="tabPending" aria-selected="true">Pending</button>
    <button class="nav-link" id="tabSelesai-tab" data-bs-toggle="tab" data-bs-target="#tabSelesai" type="button" role="tab" aria-controls="tabSelesai" aria-selected="false">Selesai</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="tabPending" role="tabpanel" aria-labelledby="tabPending-tab">
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
                            foreach ($pembayaranPending as $key) {
                                $comp=$this->db->query("SELECT * from em_company where id='".$key->kodePerusahaan."'")->row();
                                $dataAPI = array(
                                    "Konid" => $key->Konid,
                                    "key" => $comp->keyApi
                                );

                                $headers = array(
                                    "key: " . $comp->keyApi
                                );

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => $comp->baseUrl . "reseller/listbooking/progi/?key=" . $comp->keyApi . "&Konid=" . $key->Konid,
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
                                    <td><img src="https://admin103.progitoken.com/modul/company/foto/'.$comp->foto.'" width="50"></td>
                                    <td>Rp '.number_format($isi->data->Totbi).'</td>
                                    <td>
                                    <a href="'.base_url().'booking/detail/'.$key->ID.'" class="btn btn-primary">Detail</a>
                                    <a href="'.base_url().'booking/detailBayar/'.$key->ID.'" class="btn btn-success">Bayar</a></td>
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
  <div class="tab-pane fade" id="tabSelesai" role="tabpanel" aria-labelledby="tabSelesai-tab">
       <div class="mb-3 col-lg-12 table-responsive">
                    <table id="dtb_manual_selesai" class="table table-bordered table-striped">
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
                            foreach ($pembayaranSelesai as $key) {
                                $comp=$this->db->query("SELECT * from em_company where id='".$key->kodePerusahaan."'")->row();
                                $dataAPI = array(
                                    "Konid" => $key->Konid,
                                    "key" => $comp->keyApi
                                );

                                $headers = array(
                                    "key: " . $comp->keyApi
                                );

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => $comp->baseUrl . "reseller/listbooking/progi/?key=" . $comp->keyApi . "&Konid=" . $key->Konid,
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
                                    <td><img src="https://admin103.progitoken.com/modul/company/foto/'.$comp->foto.'" width="50"></td>
                                    <td>Rp '.number_format($isi->data->Totbi).'</td>
                                    <td><a onclick="deleteBook('.$key->ID.')" class="btn btn-danger"> Hapus dan batalkan</a></td>
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
    </div>
</div>

<script type="text/javascript">
     $(document).ready(function() {
        $("#dtb_manual_pending").DataTable();
        $("#dtb_manual_selesai").DataTable();
    })
</script>