<h1 class="mt-4">Add Booking</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="form-content">
                <form method="POST" id="formAddBooking">
                    <table style="width:100%">
                        <td width="50%" style="border-right: solid 0.5px rgba(0,0,0,0.3);vertical-align: top;">
                            <h5>Informasi Pengirim</h5>
                            <div class="mb-3 row align-items-center col-lg-12">
                                <label class="col-lg-3 fs-13">Pengirim</label>
                                <div class="col-lg-6 px-1">
                                    <select name="idPengirim" id="idPengirim" class="form-control select2"
                                    data-placeholder="Pilih Pengirim" onchange="showTotal();resetPrice();" required>
                                    <?php foreach ($pengirim as $c) { ?>
                                        <option value="<?= $c->ID; ?>">
                                            <?= $c->judul." ".$c->namaPengirim." ".$c->telp." ".$c->alamat; ?>

                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <a href="<?=base_url()?>pengirimprogi" class="col-lg-2 btn btn-primary btn-sm">Ubah</a>
                        </div>


                        <h5>Informasi Penerima</h5>

                        <div class="mb-2 row align-items-center col-lg-12">
                            <label class="col-lg-3 fs-13">Nama</label>
                            <div class="col-lg-9 px-1">
                                <input type="text" name="namaPenerima" id="namaPenerima" class="form-control" placeholder="Nama Penerima" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center col-lg-12">
                            <label class="col-lg-3 fs-13">Telp/Hp</label>
                            <div class="col-lg-9 px-1">
                                <input type="text" name="telpPenerima" id="telpPenerima" class="form-control" placeholder="Telp Penerima" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="mb-2 row align-items-center col-lg-12">
                            <label class="col-lg-3 fs-13">Tujuan</label>
                            <div class="col-lg-9 px-1">
                                <input type="text" id="hint2" name="ke" class="form-control ui-autocomplete-input"
                                placeholder=" Kota Tujuan" onchange="showTotal();resetPrice();">
                                <input type="hidden" id="tujuan" name="tujuan" class="form-control" />
                            </div>
                        </div>

                        <div class="mb-2 row align-items-center col-lg-12">
                            <label class="col-lg-3 fs-13">Alamat</label>
                            <div class="col-lg-9 px-1">
                                <input type="text" name="alamatPenerima1" id="alamatPenerima1" class="form-control" placeholder="Alamat Penerima" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mb-2 row align-items-center col-lg-12">
                            <label class="col-lg-3 fs-13">&nbsp;</label>
                            <div class="col-lg-9 px-1">
                                <input type="text" name="alamatPenerima2" id="alamatPenerima2" class="form-control" placeholder="Alamat Penerima 2" autocomplete="off" required>
                            </div>
                        </div>


                        <div class="mb-3 row align-items-center col-lg-12">
                            <label class="col-lg-3 fs-13">Tipe</label>
                            <div class="col-lg-9 px-1">
                                <select name="tipePengiriman" id="tipePengiriman" class="form-control select2"
                                data-placeholder="Pilih Tipe Pengiriman" onchange="showCOD(this.value);showTotal()" required>
                                <option value=""></option>
                                <?php
                                $listcod = array('COD','Non-COD' );
                                foreach ($listcod as $c) { ?>
                                    <option value="<?= $c; ?>">
                                        <?= $c?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class=" mb-2 row col-lg-12">
                        <label class="col-lg-3">&nbsp;</label>
                        <div class="col-lg-9">
                            <a onclick="showPrice();" class="btn btn-primary" style="width:100%">Pilih Ekpedisi</a>
                        </div>
                    </div>

                    <div id="lytPriceSelected"></div>



                </td>
                <td width="50%" style="vertical-align: top;padding-left: 1%;">

                    <input type="hidden" name="asalHarga" id="asalHarga" value="0">
                    <input type="hidden" name="tujuanHarga" id="tujuanHarga" value="0">
                    <input type="hidden" name="idPerusahaan" id="idPerusahaan" value="0">
                    <input type="hidden" name="modaID" id="modaID" value="0">
                    <input type="hidden" name="serviceID" id="serviceID" value="0">
                    <input type="hidden" name="billingID" id="billingID" value="">
                    <input type="hidden" name="divider" id="divider" value="0">
                    <input type="hidden" name="idEkspedisi" id="idEkspedisi" value="0">

                    <h5>Informasi Paket</h5>

                    <div class="mb-2 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">Paket</label>
                        <div class="col-lg-9 px-1">
                            <select name="productName" id="productName" class="form-control select2"
                            data-placeholder="Pilih Paket" required onchange="showPaket()">
                            <option value=""></option>
                            <?php foreach ($katalog as $c) { ?>
                                <option value="<?= $c->namaBarang; ?>" data-id="<?=$c->ID?>">
                                    <?= $c->namaBarang." ".$c->jenisBarang." ".$c->keterangan; ?>

                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-3 fs-13">Jenis Barang</label>
                    <div class="col-lg-9 px-1">
                        <input type="text" name="jenisBarang" id="jenisBarang" class="form-control" placeholder="Jenis Barang" autocomplete="off" required>
                    </div>
                </div>

                <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-3 fs-13">Waktu Pickup</label>
                    <div class="col-lg-9 px-1">
                        <input type="text" name="waktuPickup" id="waktuPickup" class="form-control datetimepicker" placeholder="Waktu Pickup" autocomplete="off" required>
                    </div>
                </div>

                <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-3 fs-13">Keterangan</label>
                    <div class="col-lg-9 px-1">
                        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" autocomplete="off" required>
                    </div>
                </div>

                <div class="form-group row mb-3  align-items-center col-lg-12">

                    <div class="col-lg-2">
                        <label for="Colly" >Koli</label>
                        <input type="text" name="Koli" id="Koli" onchange="addInput(this.value);"
                        onkeyup="addInput(this.value);" value="0"
                        class="form-control form-control-sm" tabindex="22" required>
                    </div>
                    <div class="col-lg-2">
                        <label for="Colly" >Detail</label><br>
                        <button type="button" tabindex="23" class="btn  btn-success btn-sm"
                        data-bs-toggle="modal" data-bs-target="#modalDimensi">Dimensi</button>
                    </div>

                    <div class="col-lg-2">
                        <label for="Volume" >Volume</label>
                        <input type="text" name="Volume" id="VolumeA" class="form-control form-control-sm" value="0"
                        tabindex="24" readonly required>
                    </div>

                    <div class="col-lg-3">
                        <label for="Weight">Berat (Kg)</label>
                        <input type="text" name="Kilo" id="Kilo" class="form-control form-control-sm" value="0"
                        tabindex="25" readonly required>
                    </div>

                    <div class="col-lg-3">
                        <label for="Weight">Terberat (Kg)</label>
                        <input type="text" name="kgCharged" id="weight" class="form-control form-control-sm" required
                        readonly="true">
                    </div>

                </div><!-- /.form-group -->

                <h5>Estimasi Biaya</h5>

                <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-3 fs-13">Biaya Transaksi</label>
                    <div class="col-lg-9 px-1">
                        <input type="text" id="biayaTransaksiC" class="form-control" placeholder="Biaya Transaksi" autocomplete="off" required readonly>
                        <input type="hidden" name="biayaTransaksi" id="biayaTransaksi" class="form-control" placeholder="Jenis Barang" autocomplete="off" required>
                    </div>
                </div>

                <div id="lytCOD" hidden>
                  <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-3 fs-13">Nilai Barang</label>
                    <div class="col-lg-9 px-1">
                        <input type="text" id="nilaiBarangC" class="form-control cod" placeholder="Nilai Barang" autocomplete="off">
                        <input type="hidden" name="nilaiBarang" id="nilaiBarang" class="form-control cod" placeholder="Jenis Barang" autocomplete="off">
                    </div>
                </div>  
                <div class="mb-2 row align-items-center col-lg-12">
                    <label class="col-lg-3 fs-13">Fee COD</label>
                    <div class="col-lg-9 px-1">
                        <input type="text" id="feeCODC" class="form-control cod" placeholder="Fee COD" autocomplete="off" readonly>
                        <input type="hidden" name="feeCOD" id="feeCOD" class="form-control cod" placeholder="Jenis Barang" autocomplete="off">
                        <input type="hidden" name="persentaseCOD" id="persentaseCOD" class="form-control cod" placeholder="Jenis Barang" autocomplete="off">
                    </div>
                </div>  
            </div>

            <div class="mb-3 row align-items-center col-lg-12">
                <label class="col-lg-3 fs-13">Grand Total</label>
                <div class="col-lg-9 px-1">
                    <input type="text" id="grandTotalC" class="form-control" placeholder="Grand Total" autocomplete="off" required readonly>
                    <input type="hidden" name="grandTotal" id="grandTotal" class="form-control" placeholder="Jenis Barang" autocomplete="off" required>
                </div>
            </div>


            <div class="d-flex row align-items-center col-lg-12">
                <label class="col-lg-3 fs-13">&nbsp;</label>
                <div class="col-lg-9">
                    <input type="submit" id="submit" class="btn btn-primary" value="Submit"> 
                    <a href="<?=base_url()?>booking" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                </div>
            </div>



        </td>

    </table>



</form>
</div>

</div>
</div>
</div>


<!-- modal dimensi -->
<div class="modal fade" id="modalDimensi" tabindex="-1" role="dialog" aria-labelledby="modalDimensi" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDimensi">Dimensi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formDimensi">
                    <table class="table table-bordered" id="tblDimensi">
                        <thead>
                            <th>Koli</th>
                            <th>Berat</th>
                            <th>Panjang</th>
                            <th>Lebar</th>
                            <th>Tinggi</th>
                            <th>Volume</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal Price -->
<div class="modal fade" id="modalEkspedisi" role="dialog" aria-labelledby="modalEkspedisi" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEkspedisi">List Ekspedisi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow:hidden;">
                <form method="POST" id="forhttps://progipedia.com/assets/assets_dashboard/css/styles.cssmEkspedisi">

                    <div class="mb-3 row align-items-center col-lg-12">
                        <label class="col-lg-2 fs-13">Service</label>
                        <div class="col-lg-9 px-1" id="select">
                            <select name="serviceID" id="serviceID" class="form-control select2"
                            data-placeholder="Pilih Service" required onchange="showPriceDetail(this.value)" style="width:100%">
                            <!-- <option value=""></option> -->
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



                            foreach ($isiService->data as $sn) {?>
                                <option value="<?= $sn->serviceID; ?>">
                                    <?= $sn->serviceName ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div id="lytDetail"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>

<script type="text/javascript">

    function showPaket() {
        var id=$("#productName").find(':selected').data('id');
        $.ajax({
            type:"POST",
            dataType:"JSON",
            url:"<?=base_url()?>booking/showKatalog",
            data:{"id":id},
            success:function(data) {
                $("#jenisBarang").val(data.jenisBarang);
                $("#keterangan").val(data.keterangan);
                $("#Koli").val(data.jumlahBarang);
                addInput(data.jumlahBarang);
                $("#modalDimensi").modal("show");
                $("#berat1").val(data.berat);
                $("#panjang1").val(data.panjang);
                $("#lebar1").val(data.lebar);
                $("#tinggi1").val(data.tinggi);
                if ($("#tujuan").val()!="") {
                    getVolume(1);
                }
            }
        })
    }
    function addInput(jml) {
        var x=1;
        var limit=1000;
        if (jml>limit) {
            alert("Tidak bisa melebihi "+limit+"!");
        }else{
            var t=document.getElementById("tblDimensi");
            t.tBodies[0].innerHTML="";


            for (var i = 1; i <= jml; i++) {
                var newdiv=document.createElement("tr");
                newdiv.innerHTML=
                '<td>'+i+'</td>'+
                '<td><input type="text" name="berat[]" id="berat'+i+'" class="form-control" onchange="getBerat('+i+')" onkeyup="getBerat('+i+')"></td>'+
                '<td><input type="text" name="panjang[]" id="panjang'+i+'" class="form-control" onchange="getVolume('+i+')" onkeyup="getVolume('+i+')"></td>'+
                '<td><input type="text" name="lebar[]" id="lebar'+i+'" class="form-control" onchange="getVolume('+i+')" onkeyup="getVolume('+i+')"></td>'+
                '<td><input type="text" name="tinggi[]" id="tinggi'+i+'" class="form-control" onchange="getVolume('+i+')" onkeyup="getVolume('+i+')"></td>'+
                '<td><input type="text" name="volume[]" id="volume'+i+'" class="form-control" value="0" readonly></td>'
                ;
                t.tBodies[0].appendChild(newdiv);
                x++;
            }
        }
    }

    function getVolume(i) {
        var panjang=$("#panjang"+i).val()=="" ? 0:$("#panjang"+i).val();
        var lebar=$("#lebar"+i).val()=="" ? 0:$("#lebar"+i).val();
        var tinggi=$("#tinggi"+i).val()=="" ? 0:$("#tinggi"+i).val();
        var divider=$("#divider").val()=="" ? 0:$("#divider").val();
        var koli=parseInt($("#Koli").val());

        var volume=parseFloat(parseFloat(panjang)*parseFloat(lebar)*parseFloat(tinggi))/parseFloat(divider);

        $("#volume"+i).val(volume.toFixed(2));

        var sumberat=0;
        var sumvolume=0;
        for (var x = 1; x <= koli; x++) {
            sumberat+= parseFloat($("#berat"+x).val());
            sumvolume+= parseFloat($("#volume"+x).val());
        }

        $("#Kilo").val(sumberat);
        $("#VolumeA").val(sumvolume);

        if (parseFloat(sumberat)<=parseFloat(sumvolume)) {
            $("#weight").val(sumvolume);
        }else{
            $("#weight").val(sumberat);
        }
        showTotal();

    }

    function getBerat(i) {
        var koli=parseInt($("#Koli").val());
        var sumberat=0;
        var sumvolume=0;
        for (var x = 1; x <= koli; x++) {
            sumberat+= parseFloat($("#berat"+x).val());
            sumvolume+= parseFloat($("#volume"+x).val());
        }
        $("#Kilo").val(sumberat);
        $("#VolumeA").val(sumvolume);

        if (parseFloat(sumberat)<=parseFloat(sumvolume)) {
            $("#weight").val(sumvolume);
        }else{
            $("#weight").val(sumberat);
        }
        showTotal();
    }

    function resetPrice() {
        $("#lytPriceSelected").html("");
        
    }

    function showPrice() {
        var idPengirim=$("#idPengirim").val();
        var tujuan=$("#tujuan").val();
        if (tujuan!="") {
            $("#modalEkspedisi").modal("show");
            showPriceDetail("1");
        }else{
            alert("Silahkan pilih tujuan terlebih dahulu!");
        }
    }
    function showPriceDetail(id) {
     var idPengirim=$("#idPengirim").val();
     var tujuan=$("#tujuan").val();
     $.ajax({
        type:"POST",
        data:{"idPengirim":idPengirim,"tujuan":tujuan,"serviceID":id},
        url:"<?=base_url()?>booking/getpriceDetail",
        beforeSend:function() {
            $("#lytDetail").html("Loading...");
        },
        success:function(html) {
            $("#lytDetail").html(html);
        }
    })
 }


 function pilihPrice(id,divider) {
    // alert(id+" | "+divider);
    var img=$("#fotoP"+id).val();
    var layanan=$("#layananP"+id).val();
    var moda=$("#modaP"+id).val();
    var harga=$("#hargaP"+id).val();
    var lt=$("#ltP"+id).val();
    $("#divider").val(divider);
    $("#idEkspedisi").val(id);
    $("#modalEkspedisi").modal("hide");
    $("#lytPriceSelected").html('<div class="card border-primary mb-3">'+
      '<div class="card-header">Price</div>'+
      '<div class="card-body">'+
      '<div class="mb-3 row col-lg-12">'+
      '<div class="col-lg-2">'+
      '<img src="'+img+'" width="65">'+
      '</div>'+
      '<div class="col-lg-4">'+
      '<b><label>Service</label></b></br>'+
      '<label>'+layanan+'</label>'+
      '</div>'+
      '<div class="col-lg-2">'+
      '<b><label>Moda</label></b></br>'+
      '<label>'+moda+'</label>'+
      '</div>'+
      '<div class="col-lg-2">'+
      '<b><label>Tarif</label></b></br>'+
      '<label>'+harga+'</label>'+
      '</div>'+
      '<div class="col-lg-2">'+
      '<b><label>Estimasi</label></b></br>'+
      '<label>'+lt+'</label>'+
      '</div>'+
      '</div></div></div>');

    $("#asalHarga").val($("#asalP"+id).val());
    $("#tujuanHarga").val($("#tujuanP"+id).val());
    $("#idPerusahaan").val($("#idPerusahaanP"+id).val());
    $("#modaID").val($("#modaIDP"+id).val());
    $("#serviceID").val($("#serviceIDP"+id).val());

    showTotal();
}

function showCOD(id) {
    if (id=="COD") {
        $("#lytCOD").prop("hidden",false);
        $(".cod").attr("required",true);
        $("#billingID").val("3");
    }else{
        $("#lytCOD").prop("hidden",true);
        $(".cod").attr("required",false);
        $("#nilaiBarangC").val("0");
        $("#feeCODC").val("0");
        $("#nilaiBarang").val("0");
        $("#feeCOD").val("0");
        $("#billingID").val("");
    }
    showGrandTotal();
}


$("input#nilaiBarangC").bind("keyup change",function(event) {
    if(event.which >= 37 && event.which <= 40){
      event.preventDefault();
  } 

  $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/([0-9])$/, '$1')  
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
  });

  var value=$("#nilaiBarangC").val();
  var hasil = value.replace(/,/g, '');
  $("#nilaiBarang").val(hasil);

  showGrandTotal();

});

function showTotal() {
    var asal=$("#asalHarga").val();
    var moda=$("#modaID").val();
    var service=$("#serviceID").val();
    var tujuan=$("#tujuanHarga").val();
    var terberat=$("#weight").val();
    var idComp=$("#idPerusahaan").val();
    var billID=$("#billingID").val();

    $.ajax({
        type:"POST",
        dataType:"JSON",
        data:{"asal":asal,"moda":moda,"service":service,"tujuan":tujuan,"terberat":terberat,"idComp":idComp,"billingID":billID},
        url:"<?=base_url()?>booking/showTotal",
        success:function (data) {
            $("#biayaTransaksiC").val(data.total2);
            $("#biayaTransaksi").val(data.total);
            showGrandTotal();
        }
    });

}

function showGrandTotal() {
    var biayaTransaksi=$("#biayaTransaksi").val()==""?0:$("#biayaTransaksi").val();
    var nilaiCOD=$("#nilaiBarang").val()==""?0:$("#nilaiBarang").val();
    var billID=$("#billingID").val();
    $.ajax({
        type:"POST",
        dataType:"JSON",
        data:{"subtotal":biayaTransaksi,"nilaiCOD":nilaiCOD,"billingID":billID},
        url:"<?=base_url()?>booking/showGrandTotal",
        success:function (data) {
            $("#feeCODC").val(data.feeCOD2);
            $("#feeCOD").val(data.feeCOD);
            $("#persentaseCOD").val(data.persentaseCOD);
            $("#grandTotalC").val(data.total2);
            $("#grandTotal").val(data.total);



        }
    });

}


$(document).ready(function() {

    $("#hint2").autocomplete({
        source:  function (request, response) {
            $.ajax({
                url:"<?=base_url()?>autocomplete/search/",
                dataType:"JSON",
                data:{
                    term:request.term
                },
                success:function (data) {
                    response(data);
                }
            })

        },
        select: function(event, ui) {
            event.preventDefault();
            $("#hint2").val(ui.item.label); // display the selected text
            $("#tujuan").val(ui.item.value); // save selected id to hidden input
        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#hint2").val(ui.item.label);
        },

        minLength: 3
    });




    $("form#formAddBooking").submit(function(e) {
        $("#submit").prop("disabled",true);
        var data=$("#formAddBooking,#formDimensi").serialize();
        $.ajax({
            type:"POST",
            data:data,
            url:'<?=base_url()?>booking/actAddBooking',
            success:function(response) {
                if (response.indexOf("good")>-1) {
                    $("#submit").prop("disabled",false);
                    alert("Success!");
                    window.location='<?=base_url()?>booking/add';
                }else{
                    $("#submit").prop("disabled",false);
                    alert(response);
                }
            }


        });

        e.preventDefault(); 
    });
});
</script>