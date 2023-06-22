<h1 class="mt-4">Pengirim</h1>

<div class="container-fluid lacak-progi">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    <a href="<?=base_url()?>pengirimprogi/add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="form-content">
                <div class="mb-3 col-lg-12">
                    <table id="dtb_manual" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Nama Pengirim</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th>Status Utama</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            foreach ($pengirim as $key) {
                                if ($key->statusUtama=='Y') {
                                    $btn='';
                                }else{
                                    $btn=' <a onclick="delDetail('.$key->ID.')" class="btn btn-danger">Ubah ke utama</a>';
                                }
                                echo '
                                <tr>
                                <td>'.$no.'.</td>
                                <td>'.$key->judul.'</td>
                                <td>'.$key->namaPengirim.'</td>
                                <td>'.$key->telp.'</td>
                                <td>'.$key->alamat.'</td>
                                <td>'.$key->statusUtama.'</td>
                                <td><a onclick="showDetail('.$key->ID.')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpKatalog"> Edit</a>'.$btn.'</td>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpKatalog">Edit Katalog</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formUpPengirim">
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
                                        <input type="checkbox" id="statusUtama" name="statusUtama">
                                    </div>
                                </div>

                            <input type="hidden" name="id" id="idPengirim">

                
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
            url:'<?=base_url()?>pengirimprogi/showData',
            success:function(data) {
                $("#judul").val(data.judul);
                $("#namaPengirim").val(data.namaPengirim);
                $("#telp").val(data.telp);
                $("#alamat").val(data.alamat);
                $("#idPengirim").val(id);
                if (data.statusUtama=='Y') {
                    $("#statusUtama").prop("checked",true);
                }else{
                    $("#statusUtama").prop("checked",false);
                }
            }

        });
    }
        $("form#formUpPengirim").submit(function(e) {
            $("#submit").prop("disabled",true);
            var data=$("#formUpPengirim").serialize();
            $.ajax({
                type:"POST",
                data:data,
                url:'<?=base_url()?>pengirimprogi/actEdit',
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

        function delDetail(id) {
            if (confirm("Ubah menjadi alamat utama?")) {
               $.ajax({
                type:"POST",
                data:{"id":id},
                url:'<?=base_url()?>pengirimprogi/actDelete',
                success:function(response) {
                    if (response.indexOf("good")>-1) {
                        alert("Success!")
                        window.location='<?=base_url()?>pengirimprogi';
                    }else{
                        alert(response);
                    }
                }


            });

            }
        }
</script>

