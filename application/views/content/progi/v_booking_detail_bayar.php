<h1 class="mt-4">Detail Booking</h1>
<?php
?>
<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body row">
            <div class="mb-3 col-lg-12">
                <div class="float-end">
                    <a href="https://admin103.progipedia.com/modul/print_awb/print.php?id=<?=$booking->Konid?>" target="_blank" class="btn btn-primary"> Print AWB</a>
                    <a href="<?=base_url()?>booking/pembayaran" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                </div>
            </div>
            <?php




        ?>      <div class="card-body">
            <div class="mb-1">
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
            <div class="mb-1">
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
            <div class="mb-1">
                <div class="row">
                    <label class="form-label fw-bold col-lg-2">&nbsp;</label>
                    <div class="col-lg-4">
                        <button type="button" tabindex="23" class="btn  btn-primary btn-flat"
                        data-bs-toggle="modal" data-bs-target="#modalPembayaran" style="width: 100%;">Bayar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- modal dimensi -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="modalPembayaran" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPembayaran">Detail Pembayaran</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formWallet">
                    <table class="table">
                        <td width="50%" style="border-right: solid 0.5px rgba(0,0,0,0.3);vertical-align: top;">
                          <div class="row mb-1">
                            <label class="form-label fw-bold col-lg-12">Paket <?=$isi->data->jenisBiaya?></label>
                        </div>
                        <div class="row mb-1">
                            <label class="form-label fw-bold col-lg-6">Total</label>
                            <div class="col-lg-6">
                                <label class="form-label float-end"><?=number_format($isi->data->totbi)?></label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label class="form-label fw-bold col-lg-6">By Admin</label>
                            <div id="lytAdmin" class=" col-lg-6"><label class="form-label float-end"><?=number_format($byAdmin)?></label></div>
                        </div>
                        <div class="row mb-1">
                            <label class="form-label fw-bold col-lg-6">Grand Total</label>
                            <div id="lytGrandTotal" class="col-lg-6"><label class="form-label float-end"><?=number_format(($isi->data->totbi+$byAdmin))?></label></div>
                        </div>
                        <div class="mb-3 row align-items-center col-lg-12">
                            <label class="col-lg-4 fw-bold fs-13">Jadwal Pickup</label>
                            <div class="col-lg-8 px-1">
                                <input type="text" name="waktuPickup" id="waktuPickup" class="form-control datetimepicker" placeholder="Waktu Pickup" autocomplete="off" required>
                            </div>
                        </div>
                    </td>
                    <td width="50%" style="vertical-align: top;padding-left: 1%;">
                     <div class="row mb-1">
                        <label class="form-label fw-bold col-lg-6">Pembayaran</label>
                    </div>
                    <div class="row mb-1" style="margin:2%">
                       <div class="col-lg-12" style="margin:2%">
                        <?php
                        foreach ($isiWallet->data as $key) {
                            if ($key->namaApk=="dana") {
                                $width="70px";
                            }else if ($key->namaApk=="ovo") {
                                $width="50px";
                            }else if ($key->namaApk=="linkaja") {
                                $width="40px";
                            }
                            ?>
                            <label for="check<?=$key->id?>" class="row mb-2 align-items-center">
                                <div class="row" style="background: <?=$key->warna?>;padding: 3%;border-radius: 15px;">
                                    <div class="col-lg-6">

                                     <img src="https://admin103.progitoken.com/upload/wallet/<?=$key->image?>" style="width: <?=$width?>;">
                                 </div>
                                 <div class=" col-lg-6">
                                    <input type="checkbox" name="idPembayaran[]" value="<?=$key->id?>" id="check<?=$key->id?>" class="float-end form-check-input checknya" onchange="showOvo(<?=$key->id?>)">
                                </div>
                            </div>
                        </label>

                        <?php
                    }
                    ?>

                </div>
            </div>

            <div id="lytOvo" hidden>
                <div class="col-lg-12 mb-1">
                    <label class="form-label fw-bold">Masukkan nomor hp akun OVO anda</label>
                </div>
                <div class="col-lg-12 mb-1">
                   <input type="text" name="telp" id="telp" class="form-control ovo" placeholder="No. Handphone" autocomplete="off">
               </div>
           </div>

       </td>
   </table>



</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit">Submit</button>
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
    $('input[type="checkbox"]').on('change', function() {
        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
        
    });

    function showOvo(id) {
        if ($("#check"+id).is(":checked") && id=="4") {
            $("#lytOvo").prop("hidden",false);
            $(".ovo").attr("required",true);
        }else{
            $("#lytOvo").prop("hidden",true);
            $(".ovo").attr("required",false);
            $("#telp").val("");
        }
    }

    $("form#formWallet").submit(function(e) {
        checked = $("input[type=checkbox]:checked").length;

        if(!checked) {
            alert("Silahkan pilih pembayaran terlebih dahulu");
            return false;
        }else{

        }
        e.preventDefault();
    });
</script>