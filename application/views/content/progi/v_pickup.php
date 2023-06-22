<h1 class="mt-4">Paket</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6 row">
                 <label>Cari Paket</label>
                 <div class="col-lg-8">
                    <input type="text" name="awb" id="awb" class="form-control" placeholder="Cari Paket">
                </div>
                <div class="col-lg-4">
                    <a style="cursor: pointer;" onclick="showAWB()" class="btn btn-primary">Cari</a>                    
                </div>
            </div>
            <div class="col-lg-6">
             <label>Searching Periode</label>
             <div class="row">
                <div class="col-lg-4">
                    <select name="bulan" id="bulan" class="form-control select2" style="width:100%; ">
                      <?php $bln=array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'); 

                      foreach($bln as $v=>$b){ 
                        if($v == $_GET['bulan']){
                            ?>

                            <option value="<?php echo $v;?>" selected><?php echo $b;?></option>
                            <?php 
                        }else{
                            ?>
                            <option value="<?php echo $v;?>" ><?php echo $b;?></option>    
                            <?php
                        }
                    } ?>
                </select>  
            </div>
            <div class="col-lg-4">
                <select name="tahun" id="tahun" class="form-control select2" style="width:100%; ">
                    <?php

                    for($i=0;$i<10;$i++){    
                     if(date('Y')-$i == $_GET['tahun']){
                        ?>
                        <option value="<?php echo date('Y')-$i; ?>" selected="selected"><?php echo date('Y')-$i; ?></option> 
                        <?php

                    }else{
                        ?>
                        <option value="<?php echo date('Y')-$i; ?>" ><?php echo date('Y')-$i; ?></option>    
                        <?php
                    }
                } ?>
            </select>  
        </div>
        <div class="col-lg-4">
            <a style="cursor: pointer;" onclick="showPeriode()" class="btn btn-primary">Submit</a>                    
        </div>
    </div>
</div>
</div>


<div class="row mb-3">
    <div class="col-lg-6">
        <div class="card text-dark bg-light col-lg-12">
          <div class="card-body">
             <h5 class="card-title">Pencairan COD</h5>
             <div id="lytPeriode"><p>Semua Periode</p></div>
             <div id="lytJmlCOD"><h3>0</h3></div>
             <a style="cursor: pointer;" onclick="showCOD()" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
         </div>
     </div>

 </div>
 <div class="col-lg-6">
    <div class="card text-dark bg-warning col-lg-12">
      <div class="card-body">
         <h5 class="card-title">Menunggu Pembayaran</h5>
         <p>Semua Periode</p>
         <h3><?=$cekPembayaran?> Paket</h3>
         <a href="<?=base_url()?>booking/pembayaran" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
     </div>
 </div>
</div>
</div>


<div class="row mb-3">
    <div class="col-lg-4">
        <div class="card text-white bg-success col-lg-12">
          <div class="card-body">
             <h5 class="card-title">Total Paket Berhasil</h5>
             <div id="lytPeriodePaketBerhasil"><p>Semua Periode</p></div>
             <div id="lytJmlPaketBerhasil"><h3>0</h3></div>
             <a style="cursor: pointer;" onclick="showPaketBerhasil()" class="text-white">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
         </div>
     </div>

 </div>
 <div class="col-lg-4">
    <div class="card text-white bg-primary col-lg-12">
      <div class="card-body">
         <h5 class="card-title">Paket Retur</h5>
         <div id="lytPeriodePaketRetur"><p>Semua Periode</p></div>
         <div id="lytJmlPaketRetur"><h3>0</h3></div>
         <a href="#" class="text-white">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
     </div>
 </div>
</div>
<div class="col-lg-4">
    <div class="card text-white bg-danger col-lg-12">
      <div class="card-body">
         <h5 class="card-title">Paket Batal</h5>
         <div id="lytPeriodePaketBatal"><p>Semua Periode</p></div>
         <div id="lytJmlPaketBatal"><h3>0</h3></div>
         <a style="cursor: pointer;" onclick="showPaketBatal()" class="text-white">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
     </div>
 </div>
</div>
</div>


<div class="card text-dark bg-info mb-3">
  <div class="card-header" id="jmlPaketProses">0 Paket di proses</div>
  <div class="card-body">
    <div class="row">
        <div class="col-lg-4">
            <h5 class="card-title">Belum dipickup</h5>
            <div id="lytPeriodePaketBlmPickup"><p>Semua Periode</p></div>
            <div id="lytJmlPaketBlmPickup"><h3>0</h3></div>
            <a style="cursor: pointer;" onclick="showBelumPickup()" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="col-lg-4">
            <h5 class="card-title">Menuju ke penerima</h5>
            <div id="lytPeriodePaketMenujuPenerima"><p>Semua Periode</p></div>
            <div id="lytJmlPaketMenujuPenerima"><h3>0</h3></div>
            <a style="cursor: pointer;" onclick="showMenujuPenerima()" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="col-lg-4">
            <h5 class="card-title">Kiriman Bermasalah</h5>
            <div id="lytPeriodePaketBermasalah"><p>Semua Periode</p></div>
            <div id="lytJmlPaketBermasalah"><h3>0</h3></div>
            <a style="cursor: pointer;" onclick="showPaketBermasalah()" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    
</div>
</div>

<div class="card text-dark bg-warning mb-3">
  <div class="card-header" id="jmlClaimPaket">0 Claim paket</div>
  <div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <h5 class="card-title">Claim Sukses</h5>
            <div id="lytPeriodePaketClaimSukses"><p>Semua Periode</p></div>
            <div id="lytJmlPaketClaimSukses"><h3>0</h3></div>
            <a href="#" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="col-lg-6">
            <h5 class="card-title">Claim Pending</h5>
            <div id="lytPeriodePaketClaimPending"><p>Semua Periode</p></div>
            <div id="lytJmlPaketClaimPending"><h3>0</h3></div>
            <a style="cursor: pointer;" onclick="showMenujuPenerima()" class="text-dark">Lihat Selengkapnya <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    
</div>
</div>




</div>
</div>
</div>


<script type="text/javascript">
    showPeriode();
    function showAWB() {
        if ($("#awb").val()=="") {
            alert("Silahkan isi no. awb terlebih dahulu");
        }else{
            $.ajax({
                type:"POST",
                dataType:"JSON",
                data:{"Konid":$("#awb").val()},
                url:"<?=base_url()?>pickup/cekBook",
                success:function(data) {
                    if (data.msg=="good") {
                        window.location="<?=base_url()?>pickup/detail/"+data.id;
                    }else{
                        alert(data.msg);
                    }
                }

            });

        }
    }
    function GetMonthName(monthNumber) {
      var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      return months[monthNumber - 1];
  }

  function showPeriode() {
    var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();

    $.ajax({
        type:"POST",
        dataType:"JSON",
        data:{"bulan":bulan,"tahun":tahun},
        url:"<?=base_url()?>pickup/showData",
        beforeSend:function() {
            $("#lytPeriode").html("Loading...");
            $("#lytPeriodePaketBerhasil").html("Loading...");
            $("#lytPeriodePaketRetur").html("Loading...");
            $("#lytPeriodePaketBatal").html("Loading...");
            $("#lytPeriodePaketBlmPickup").html("Loading...");
            $("#lytPeriodePaketMenujuPenerima").html("Loading...");
            $("#lytPeriodePaketBermasalah").html("Loading...");
            $("#lytPeriodePaketClaimSukses").html("Loading...");
            $("#lytPeriodePaketClaimPending").html("Loading...");
            $("#lytJmlCOD").html("Loading...");
            $("#lytJmlPaketBerhasil").html("Loading...");
            $("#lytJmlPaketRetur").html("Loading...");
            $("#lytJmlPaketBatal").html("Loading...");
            $("#lytJmlPaketBlmPickup").html("Loading...");
            $("#lytJmlPaketMenujuPenerima").html("Loading...");
            $("#lytJmlPaketBermasalah").html("Loading...");
            $("#lytJmlPaketClaimSukses").html("Loading...");
            $("#lytJmlPaketClaimPending").html("Loading...");
            $("#jmlPaketProses").html('Loading...');
            $("#jmlClaimPaket").html('Loading...');
        },
        success:function(data) {
            $("#lytPeriode").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketBerhasil").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketRetur").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketBatal").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketBlmPickup").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketMenujuPenerima").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketBermasalah").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketClaimSukses").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");
            $("#lytPeriodePaketClaimPending").html("<p>"+GetMonthName(bulan)+" "+tahun+"</p");

            $("#lytJmlCOD").html("<h3>"+data.totalCOD+" Paket</h3>");
            $("#lytJmlPaketBerhasil").html("<h3>"+data.totalBerhasil+" Paket</h3>");
            $("#lytJmlPaketRetur").html("<h3>0 Paket</h3>");
            $("#lytJmlPaketBatal").html("<h3>"+data.totalBatal+" Paket</h3>");
            $("#lytJmlPaketBlmPickup").html("<h3>"+data.totalBelumPickup+" Paket</h3>");
            $("#lytJmlPaketMenujuPenerima").html("<h3>"+data.totalMenujuPenerima+" Paket</h3>");
            $("#lytJmlPaketBermasalah").html("<h3>"+data.totalKirimanBermasalah+" Paket</h3>");
            $("#lytJmlPaketClaimSukses").html("<h3>"+data.totalClaimSukses+" Paket</h3>");
            $("#lytJmlPaketClaimPending").html("<h3>"+data.totalMenujuPenerima+" Paket</h3>");

            var jml=parseInt(data.totalBelumPickup) + parseInt(data.totalMenujuPenerima);
            var jmlClaim=parseInt(data.totalClaimSukses) + parseInt(data.totalMenujuPenerima);

            $("#jmlPaketProses").html('<h5 class="card-title">'+jml+' Paket di proses</h5>');
            $("#jmlClaimPaket").html('<h5 class="card-title">'+jml+' Claim Paket</h5>');
        }
    });
}

function showCOD() {
         var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();
    window.location="<?=base_url()?>pickup/listPickup/?statusName=List Pencairan COD&bulan="+bulan+"&tahun="+tahun+"&status=";
    }

    function showPaketBerhasil() {
        var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();
    window.location="<?=base_url()?>pickup/listPickup/?statusName=List Paket Berhasil&bulan="+bulan+"&tahun="+tahun+"&status=0";
    }

    function showPaketBatal() {
        var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();
    window.location="<?=base_url()?>pickup/listPickup/?statusName=List Paket Batal&bulan="+bulan+"&tahun="+tahun+"&status=1";
    }
    function showBelumPickup() {
        var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();
    window.location="<?=base_url()?>pickup/listPickup/?statusName=List Paket Belum dipickup&bulan="+bulan+"&tahun="+tahun+"&status=10";
    }

    function showMenujuPenerima() {
        var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();
    window.location="<?=base_url()?>pickup/listPickup/?statusName=List Paket Menuju Penerima&bulan="+bulan+"&tahun="+tahun+"&status=4";
    }
    function showPaketBermasalah() {
        var bulan=$("#bulan").val();
    var tahun=$("#tahun").val();
    window.location="<?=base_url()?>pickup/listPickup/?statusName=List Paket Bermasalah&bulan="+bulan+"&tahun="+tahun+"&status=31";
    }
</script>

