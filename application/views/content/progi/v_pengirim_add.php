<h1 class="mt-4">Add Pengirim</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="form-content">
                <form method="POST" id="formAddPengirim">

                    <div class="mb-2 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">Judul</label>
                        <div class="col-lg-9 px-1">
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Cth : Kantor" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="mb-2 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">Nama Pengirim</label>
                        <div class="col-lg-9 px-1">
                            <input type="text" name="namaPengirim" id="namaPengirim" class="form-control" placeholder="Nama Pengirim" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="mb-2 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">Telp/Hp</label>
                        <div class="col-lg-9 px-1">
                            <input type="text" name="telp" id="telp" class="form-control" placeholder="Telp" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="mb-2 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">Kecamatan/Kabupaten</label>
                        <div class="col-lg-9 px-1">
                            <input type="text" id="hint2" name="ke" class="form-control ui-autocomplete-input"
                            placeholder=" Kota Tujuan">
                            <input type="hidden" id="tujuan" name="kecamatanID" class="form-control" />
                        </div>
                    </div>
                    <div class="mb-2 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">Alamat Lengkap</label>
                        <div class="col-lg-9 px-1">
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap" autocomplete="off" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13" for="statusUtama">Atur Sebagai Alamat Utama</label>
                        <div class="col-lg-9 px-1">
                            <input type="checkbox" name="statusUtama" id="statusUtama">
                        </div>
                    </div>

                    <div class="d-flex row align-items-center col-lg-12">
                        <label class="col-lg-3 fs-13">&nbsp;</label>
                        <div class="col-lg-9">
                            <input type="submit" id="submit" class="btn btn-primary" value="Submit"> 
                            <a href="<?=base_url()?>katalogbarangprogi" class="btn btn-success"><i class="fa fa-backward"></i> Kembali</a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
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


        $("form#formAddPengirim").submit(function(e) {
            $("#submit").prop("disabled",true);
            var data=$("#formAddPengirim").serialize();
            $.ajax({
                type:"POST",
                data:data,
                url:'<?=base_url()?>pengirimprogi/actAdd',
                success:function(response) {
                    if (response.indexOf("good")>-1) {
                        $("#submit").prop("disabled",false);
                        alert("Success!")
                        window.location='<?=base_url()?>pengirimprogi';
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