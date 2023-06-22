<div class="container-xxl lms px-0 wow fadeInUp" data-wow-delay="0.3s">
    <div class="container py-4 px-lg-5">
        <!-- <div class="lms-background p-4"> -->
        <div class="row align-items-center" data-aos="fade-up" data-aos-duration="800">
            <div class="col-lg-3 col-md-3">
                <div class="img-phone text-md-center">
                    <img src="<?= base_url(); ?>assets/imagenew/phone_lms.png" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4 mt-md-0">
                <div class="img-lms">
                    <img src="<?= base_url(); ?>assets/imagenew/lms.png" class="img-fluid" alt="">
                </div>
                <h5>Kebutuhan Logistik</h5>
                <h2><?= $lms->title; ?></h2>
                <p><?= $lms->deskripsi; ?></p>
            </div>
            <div class="col-lg-3 col-md-3 mt-4 mt-md-0 text-center">
                <div class="qr">
                    <img src="<?= base_url(); ?>assets/imagenew/qr.png" class="img-fluid" alt="">
                </div>
                <div class="row mt-3">
                    <div class="col-6 text-end">
                        <a href="<?= $gp->link; ?>" title="<?= $gp->name; ?>">
                            <img src="<?= base_url(); ?>assets/imagenew/gp.png" class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="col-6 text-start">
                        <a href="<?= $ap->link; ?>" title="<?= $ap->name; ?>">
                            <img src="<?= base_url(); ?>assets/imagenew/as.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>



<!-- Footer Start -->
<div class="container-fluid text-light footer position-relative px-0">
    <div class="container pt-5">

        <div class="row justify-content-between wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-5">
                <a href="<?= base_url(); ?>" title="<?= $website->metaTitle; ?>">
                    <div class="img mb-4">
                        <img src="https://admin103.progipedia.com/upload/<?= $website->image; ?>" class="img-fluid"
                            alt="">
                    </div>
                </a>
                <!-- <div class="w-box-75">s -->
                <div class="progipedia ">
                    <?= $website->description; ?>
                </div>

                <!-- </div> -->

            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
                <div class="pages">
                    <h4>Pages</h4>
                    <ul class="mt-3">
                        <?php foreach ($this->db->query("SELECT * FROM tbl_navigation WHERE id != 3 AND status = 1 ORDER BY sort ASC")->result() as $key) { ?>
                        <li><a href="<?= base_url() . $key->slug; ?>">> <?= $key->title; ?></a></li>
                        <?php } ?>
                        <!-- <li><a href="">> Berita</a></li>
                        <li><a href="">> Layanan</a></li>
                        <li><a href="">> Cek Ongkir</a></li>
                        <li><a href="">> Lacak</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="address position-relative">
                    <h4>Kontak Kami</h4>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-dark"><?= $website->address; ?></span>
                        </div>
                        <?php
                        $number = $website->phone;
                        $n1 = substr($number, 0, 3);
                        $n2 = substr($number, 3, 4);
                        $n3 = substr($number, 7);
                        $wa = $n1 . ' ' . $n2 . ' ' . $n3;
                        ?>
                        <div class="d-flex align-items-center">
                            <span>Phone: <?= $wa; ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span>Email: <?= $website->email; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="copyright text-center position-relative mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center  text-center py-3">
                <div class="col-xl-5 col-lg-6 col-md-7 col-sm-9 col-12">
                    <p>Copyright © 2022 - <a href="<?= base_url(); ?>">Progipedia.com</a> All Rights Reserved.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<div class="contact-static d-none d-sm-block">
    <ul>
        <?php foreach ($this->db->query("SELECT * FROM tbl_sosmed WHERE id != 5 AND id != 6")->result() as $s) { ?>
        <li>
            <a href="<?= $s->link; ?>" title="<?= $s->name; ?>" target="_blank"><i class="<?= $s->icon; ?>"></i></a>
        </li>
        <?php } ?>
    </ul>
</div>


<!-- Modal Daftar -->
<div class="modal modalDaftar fade" id="modalDaftar" data-aos="fade-up" data-aos-duration="800">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Daftar Progi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="inputRegister">
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label>No. Handphone</label>
                        <input type="text" id="telp" name="telp" class="form-control" placeholder="No. Handphone"
                            onkeypress="return hanyaAngka(event)" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Toko</label>
                        <input type="text" id="nama_toko" name="nama_toko" class="form-control" placeholder="Nama Toko"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Kode Referal</label>
                        <input type="text" id="referal" name="referal" class="form-control" placeholder="Kode Referal"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" id="username" name="username" class="form-control" maxlength="20"
                            placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <label>Kata Sandi</label>
                        <input type="password" id="password" name="password" minlength="6" maxlength="20"
                            class="form-control" placeholder="Kata Sandi" required>
                    </div>
                    <div class="mb-3">
                        <label>Ulangi Kata Sandi</label>
                        <input type="password" id="konfirm_password" name="konfirm_password" minlength="6"
                            maxlength="20" class="form-control" placeholder="Ulangi Kata Sandi" required>
                    </div>
                    <div id="alert-register"></div>
                    <input type="submit" class="btn submit" value="Daftar" data-loading-text="Loading...">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal Login -->
<div class="modal modalLogin fade" id="modalLogin" data-aos="fade-up" data-aos-duration="800">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Login Progi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?= base_url('welcome/aksi_login'); ?>" method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Cth. progi@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label>Kata Sandi</label>
                        <input type="password" name="password" class="form-control" placeholder="Kata Sandi">
                    </div>
                    <input type="submit" class="btn submit" value="Login" data-loading-text="Loading...">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php
$url_register = 'welcome/input_data_register';
$url_login = 'welcome/login_progi';
?>

<!-- JavaScript Libraries -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="<?= base_url(); ?>assets/lib/wow/wow.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/easing/easing.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/waypoints/waypoints.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/counterup/counterup.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/isotope/isotope.pkgd.min.js"></script>

<!-- Template Javascript -->
<script src="<?= base_url(); ?>assets/js/swiper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css"
    href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>


<script>
$(document).ready(function() {
    $(".select2").select2();
});
$(document).ready(function() {
    base_url = '<?= base_url(); ?>';
    $("#hint").autocomplete({
        source: base_url + "autocomplete/search/" + $("#hint").val(),
        select: function(event, ui) {
            event.preventDefault();
            $("#hint").val(ui.item.label); // display the selected text
            $("#asal").val(ui.item.value); // save selected id to hidden input
            $("#kabAsal").val(ui.item.kabAsal); // save selected id to hidden input
            $("#branchNameAsal").val(ui.item.branchNameAsal); // save selected id to hidden input
            $("#kecNameAsal").val(ui.item.kecNameAsal); // save selected id to hidden input
            $("#kabupatenNameAsal").val(ui.item
                .kabupatenNameAsal); // save selected id to hidden input
        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#hint").val(ui.item.label);
        },

        minLength: 3
    });


    $("#hint2").autocomplete({
        source: base_url + "autocomplete/search2/" + $("#hint").val(),
        select: function(event, ui) {
            event.preventDefault();
            $("#hint2").val(ui.item.label); // display the selected text
            $("#tujuan").val(ui.item.value); // save selected id to hidden input
            $("#kabTujuan").val(ui.item.kabTujuan); // save selected id to hidden input
            $("#branchNameTujuan").val(ui.item
                .branchNameTujuan); // save selected id to hidden input
            $("#kecNameTujuan").val(ui.item.kecNameTujuan); // save selected id to hidden input
            $("#kabupatenNameTujuan").val(ui.item
                .kabupatenNameTujuan); // save selected id to hidden input
        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#hint2").val(ui.item.label);
        },

        minLength: 3
    });

});

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$(document).ready(function() {
    $('#username').change(function() {
        var username = $('#username').val();
        if (username != '') {
            $.ajax({
                url: "<?php echo base_url(); ?>welcome/check_username_avalibility",
                method: "POST",
                data: {
                    username: username
                },
                success: function(data) {
                    var res = data.split("|");
                    if (res[0] == 'good') {
                        $('#alert-register').html(res[1]);
                        $('#username').val();
                    } else {
                        $('#alert-register').html(res[1]);
                        if (res[0] == 'Fail') {
                            $('#username').val('');
                        }
                    }
                }
            });
        }
    });


    $('#password, #konfirm_password').on('change', function() {
        if ($('#password').val() == $('#konfirm_password').val()) {
            $('#alert-register').html(
                '<div class="alert alert-success"><i class="fa fa-check-circle" ></i> Konfirmasi password sama</div>'
                );
        } else {
            $('#alert-register').html(
                '<div class="alert alert-danger"><i class="fa fa-times-circle" ></i> Konfirmasi password tidak sama</div>'
                );
            $('#konfirm_password').val('');
        }
    });

    $("form#inputRegister").submit(function() {
        url_reg = '<?= $url_register ?>';
        var data = {
            nama: $("#nama").val(),
            email: $("#email").val(),
            telp: $("#telp").val(),
            nama_toko: $("#nama_toko").val(),
            referal: $("#referal").val(),
            username: $("#username").val(),
            password: $("#password").val(),
            konfirm_password: $("#konfirm_password").val(),
        };

        $('#inputRegister').LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: url_reg,
            data: data,

            success: function(response) {
                $('#inputRegister').LoadingOverlay("hide", true);
                if (response == 'good') {
                    document.getElementById("inputRegister").style.height = "auto";
                    $('#inputRegister').html(
                        '<div class="alert alert-success"><i class="fa fa-check-circle" ></i> Register Success</div>'
                    );
                } else {
                    '<div class="alert alert-danger"><i class="fa fa-times-circle" ></i> Register Fail</div>'
                    $('#alert-register').html();
                }
            },
            error: function() {
                $('#inputRegister').LoadingOverlay("hide", true);
                '<div class="alert alert-success"><i class="fa fa-times-circle" ></i> Register Fail</div>'
                $('#alert-register').html();
            }
        });
        return false;
    });
});
</script>




</body>

</html>