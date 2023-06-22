<h1 class="mt-4">Katalog Barang</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    <a href="<?=base_url()?>katalogbarangprogi/add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="form-content">
                <div class="mb-3 col-lg-12">
                    <table id="dtb_manual" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama Barang</th>
                            <th rowspan="2">Jenis Barang</th>
                            <th rowspan="2">Keterangan</th>
                            <th rowspan="2">Jumlah Barang</th>
                            <th rowspan="2">Nilai Barang</th>
                            <th rowspan="2">Berat</th>
                            <th colspan="3">Dimensi</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>P</th>
                            <th>L</th>
                            <th>T</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($katalog as $key) {
                                $splitB=explode(".", $key->berat);
                                $splitP=explode(".", $key->panjang);
                                $splitL=explode(".", $key->lebar);
                                $splitT=explode(".", $key->tinggi);
                                if ($splitB[1]=="00") {
                                    $beratnya=$splitB[0];
                                }else{
                                    $beratnya=$key->berat;
                                }
                                if ($splitP[1]=="00") {
                                    $panjang=$splitP[0];
                                }else{
                                    $panjang=$key->panjang;
                                }
                                if ($splitL[1]=="00") {
                                    $lebar=$splitL[0];
                                }else{
                                    $lebar=$key->lebar;
                                }
                                if ($splitT[1]=="00") {
                                    $tinggi=$splitT[0];
                                }else{
                                    $tinggi=$key->tinggi;
                                }
                                echo '
                                <tr>
                                <td>'.$no.'.</td>
                                <td>'.$key->namaBarang.'</td>
                                <td>'.$key->jenisBarang.'</td>
                                <td>'.$key->keterangan.'</td>
                                <td>'.$key->jumlahBarang.'</td>
                                <td>'.number_format($key->nilaiBarang).'</td>
                                <td>'.$beratnya.' Kg</td>
                                <td>'.$panjang.' Cm</td>
                                <td>'.$lebar.' Cm</td>
                                <td>'.$tinggi.' Cm</td>
                                <td><a onclick="showDetail('.$key->ID.')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpKatalog"> Edit</a> <a onclick="delDetail('.$key->ID.')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                                </tr>
                                ';
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalUpKatalog" tabindex="-1" role="dialog" aria-labelledby="modalUpKatalog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpKatalog">Edit Katalog</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formUpKatalog">
                    <label class="form-label col-md-4">Nama Barang</label>
                            <input type="text" name="namaBarang" id="namaBarang" class="form-control mb-3"
                            placeholder="Nama Barang" autocomplete="off" required>


                            <label class="form-label col-md-4">Jenis Barang</label>
                            <input type="text" name="jenisBarang" id="jenisBarang" class="form-control mb-3"
                            placeholder="Jenis Barang" autocomplete="off" required>


                            <label class="form-label col-md-4">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control mb-3"
                            placeholder="keterangan" autocomplete="off" required></textarea>

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label">Berat</label>
                                    <input type="text" name="berat" id="berat" class="form-control"
                                    placeholder="Berat/Kg" autocomplete="off" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Jumlah Barang</label>
                                    <input type="text" name="jumlahBarang" id="jumlahBarang" class="form-control"
                                    placeholder="Jumlah Barang" autocomplete="off" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Nilai Barang</label>
                                    <input type="text" id="nilaiBarang2" class="form-control"
                                    placeholder="Nilai Barang" autocomplete="off" required>
                                    <input type="hidden" name="nilaiBarang" id="nilaiBarang" class="form-control"
                                    placeholder="Nilai Barang" autocomplete="off" required>
                                </div>
                            </div>
                            <h5 class="form-label mb-3">Dimensi</h5>

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label">Panjang</label>
                                    <input type="text" name="panjang" id="panjang" class="form-control"
                                    placeholder="Panjang/Cm" autocomplete="off" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Lebar</label>
                                    <input type="text" name="lebar" id="lebar" class="form-control"
                                    placeholder="Lebar/Cm" autocomplete="off" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Tinggi</label>
                                    <input type="text" name="tinggi" id="tinggi" class="form-control"
                                    placeholder="Tinggi/Cm" autocomplete="off" required>
                                </div>
                            </div>

                            <input type="hidden" name="id" id="idKatalog">

                
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary" type="submit" value="Submit" id="submit">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function showDetail(id) {
        $.ajax({
            type:"POST",
            dataType:"JSON",
            data:{"id":id},
            url:'<?=base_url()?>katalogbarangprogi/showData',
            success:function(data) {
                $("#namaBarang").val(data.namaBarang);
                $("#jenisBarang").val(data.jenisBarang);
                $("#keterangan").val(data.keterangan);
                $("#berat").val(data.berat);
                $("#jumlahBarang").val(data.jumlahBarang);
                $("#nilaiBarang2").val(data.nilaiBarang2);
                $("#nilaiBarang").val(data.nilaiBarang);
                $("#panjang").val(data.panjang);
                $("#lebar").val(data.lebar);
                $("#tinggi").val(data.tinggi);
                $("#idKatalog").val(id);
            }

        });
    }

     $("input#nilaiBarang2").bind("keyup change",function(event) {
        if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      } 

      $(this).val(function(index, value) {
          return value
          .replace(/\D/g, "")
          .replace(/([0-9])$/, '$1')  
          .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
      });

      var value=$("#nilaiBarang2").val();
      var hasil = value.replace(/,/g, '');
      $("#nilaiBarang").val(hasil);

  });

        $("form#formUpKatalog").submit(function(e) {
            $("#submit").prop("disabled",true);
            var data=$("#formUpKatalog").serialize();
            $.ajax({
                type:"POST",
                data:data,
                url:'<?=base_url()?>katalogbarangprogi/actEdit',
                success:function(response) {
                    if (response.indexOf("good")>-1) {
                        $("#submit").prop("disabled",false);
                        alert("Success!")
                        window.location='<?=base_url()?>katalogbarangprogi';
                    }else{
                        $("#submit").prop("disabled",false);
                        alert(response);
                    }
                }


            });

            e.preventDefault(); 
        });

        function delDetail(id) {
            if (confirm("Yakin hapus katalog ini?")) {
               $.ajax({
                type:"POST",
                data:{"id":id},
                url:'<?=base_url()?>katalogbarangprogi/actDelete',
                success:function(response) {
                    if (response.indexOf("good")>-1) {
                        alert("Success!")
                        window.location='<?=base_url()?>katalogbarangprogi';
                    }else{
                        alert(response);
                    }
                }


            });

            }
        }
</script>

