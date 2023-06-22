<h1 class="mt-4">Add Katalog Barang</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-content">
                        <form method="POST" id="formAddKatalog">
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


                            <div class="d-flex">
                                <input type="submit" id="submit" class="btn btn-primary" value="Submit"> &nbsp;
                                <a href="<?=base_url()?>katalogbarangprogi" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
    $(document).ready(function() {


        $("form#formAddKatalog").submit(function(e) {
            $("#submit").prop("disabled",true);
            var data=$("#formAddKatalog").serialize();
            $.ajax({
                type:"POST",
                data:data,
                url:'<?=base_url()?>katalogbarangprogi/actAdd',
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
    });
</script>