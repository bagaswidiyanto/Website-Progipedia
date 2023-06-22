<h1 class="mt-4">Booking</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3">
                    <a href="<?=base_url()?>booking/add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    <?php
                    if ($cekPembayaran>0) {?>
                        &nbsp;
                        <a href="<?=base_url()?>booking/pembayaran" class="btn btn-warning"><?=$cekPembayaran?> Menunggu Pembayaran <i class="fa fa-arrow-right"></i></a>        
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <a onclick="kirimPaket()" class="btn btn-primary float-end">Kirim Paket</a>
                </div>
                </div>
            <div class="form-content">
                <div class="mb-3 col-lg-12 table-responsive">
                    <table id="dtb_manual" class="table table-bordered table-striped">
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
                                <th><input type="checkbox" id="checkAl"><label for="checkAl" class="control-label"> All</label>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($booking as $key) {
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
                                    <td><input type="checkbox" id="c'.$key->ID.'" value="'.$key->ID.'" name="check'.$key->ID.']" onclick="getCheck('.$key->ID.')" class="checkboxnya">
                                    <input type="hidden" name="idnya" value="'.$key->ID.'"></td>
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


<script type="text/javascript">
    var arrayChecked = [];

    $(document).ready(function() {
        $("#dtb_manual").DataTable();
    })

    $("#checkAl").click(function () {
  var cekbox=document.getElementsByClassName('checkboxnya');
  var idnya=document.getElementsByName('idnya');
  if (document.getElementById('checkAl').checked) {
    for (var i = 0; i < cekbox.length; i++) {
      isCheck = document.getElementById(cekbox[i].id).checked;
      if(isCheck==false){
       arrayChecked.push({"ID": idnya[i].value});
       cekbox[i].checked = true;
     }
   }
  }else{
for (var i = 0; i < cekbox.length; i++) {
    arrayChecked=[];
    cekbox[i].checked=false;
  }
  }

});

    function getCheck(id) {
  var IDBarang=id;
  if (document.getElementById("c"+id).checked) {
    arrayChecked.push({"ID": IDBarang});
  }else{
    for(var i=arrayChecked.length - 1; i>=0 ;i--){
      if(arrayChecked[i]["ID"]==id ){
        arrayChecked.splice(i,1);
      }
    } 
  }
}

    function kirimPaket() {
        if (arrayChecked.length==0) {
            alert("Silahkan pilih paket terlebih dahulu");
        }else{
            var ID='';
            var id='';
  for(x=0;x<arrayChecked.length;x++){
    id+=parseInt(arrayChecked[x]["ID"])+',';
    }
    ID=id.slice(0,-1);
  $.ajax({
    type: 'POST',
    url: "<?=base_url()?>booking/inputDetail",
    data: {"ID":ID},
    success: function(response) {
      if (response.indexOf('good') > -1){
        alert('Success');
        window.location= '<?=base_url()?>booking';
      }else{
       alert('Tidak ada data yang dipilih');
     }

   }

 });
        }
    }

    function deleteBook(id) {
        if (confirm("Yakin akan menghapus paket ini?")) {
            $.ajax({
    type: 'POST',
    url: "<?=base_url()?>booking/deleteBook",
    data: {"id":id},
    success: function(response) {
      if (response.indexOf('good') > -1){
        alert('Success');
        window.location= '<?=base_url()?>booking';
      }else{
       alert(response);
     }

   }

 });
        }
    }
</script>

