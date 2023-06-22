<!-- <div class="bg-blue-linier"> -->
<div class="container-xxl px-0 hero-header position-relative">
    <div class="container">
        <!-- <div class="slider-container"> -->
        <!-- <div class="swiper-container hero-slider"> -->
        <!-- <div class="swiper-wrapper"> -->
        <?php foreach ($slider_hero as $sh) { ?>
        <!-- <div class="swiper-slide"> -->
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="title">
                    <h5 class="wow fadeInDown" data-wow-delay="0.2s">Kebutuhan Logistik</h5>
                    <h1 class="wow fadeInUp" data-wow-delay="0.2s"><?= $sh->title; ?></h1>
                    <p class="wow fadeInUp" data-wow-delay="0.2s"><?= $sh->deskripsi; ?></p>
                    <div class="d-flex mt-4">
                        <a href="<?= $gp->link; ?>" title="<?= $gp->name; ?>" class="me-2">
                            <img src="<?= base_url(); ?>assets/imagenew/gp.png" class="img-fluid " alt="">
                        </a>
                        <a href="<?= $ap->link; ?>" title="<?= $ap->name; ?>">
                            <img src="<?= base_url(); ?>assets/imagenew/as.png" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://admin103.progipedia.com/upload/slider/<?= $sh->image; ?>" class="img-fluid" alt="">
            </div>
        </div>
        <!-- </div> -->
        <?php } ?>
        <!-- </div> -->
        <!-- <div class="swiper-pagination"></div> -->
        <!-- </div> -->
        <!-- </div> -->
    </div>
</div>

<div class="container-xxl login">
    <div class="container  py-5 px-lg-5">
        <div class="row justify-content-center text-center  ">
            <div class="col-lg-5 col-md-8">
                <h5 class="wow fadeInUp" data-wow-delay="0.2s">Selamat Datang Di Website ProgiPedia <br> Kirim paket
                    anda lebih mudah dan lebih hemat</h5>
                <div class="row justify-content-between mt-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="col-5">
                        <a href=""
                            class="login-btn border border-dark w-100 d-flex justify-content-center rounded-10 py-2"
                            data-bs-toggle="modal" data-bs-target="#modalLogin">LOGIN</a>
                    </div>
                    <div class="col-5">
                        <a href=""
                            class="d-flex align-items-center justify-content-center bg-blue text-center rounded-10 py-2 fw-bold"
                            data-bs-toggle="modal" data-bs-target="#modalDaftar">
                            <img src="<?= base_url(); ?>assets/imagenew/icon-daftar.svg" class="img-fluid me-2" alt="">
                            DAFTAR
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-xxl client-home">
    <div class="container px-lg-5">
        <div class="row mt-5 wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-12">
                <div class="slider-container">
                    <div class="swiper-container client-slider pb-5">
                        <div class="swiper-wrapper align-items-center">
                            <?php foreach ($client as $c) { ?>
                            <div class="swiper-slide">
                                <div class="img-client text-center">
                                    <img src="https://admin103.progipedia.com/upload/clients/<?= $c->image; ?>"
                                        class="img-fluid" title="<?= $c->name; ?>" alt="">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <!-- <div class="swiper-pagination"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl tracking-home wow fadeInUp" data-wow-delay="0.2s">
    <div class="container px-lg-5">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="track-center p-3">
                    <div class="form-content p-2">
                        <form id="cekTarif" action="<?= base_url('prices'); ?>" method="post">
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Origin</label>
                                <div class="col-lg-8 px-1">
                                    <input type="text" id="hint" name="asal" class="form-control ui-autocomplete-input"
                                        placeholder="Kota Asal">
                                    <input type="hidden" id="asal" name="dari" class="form-control">
                                    <input type="hidden" id="kabAsal" name="kabAsal" class="form-control">
                                    <input type="hidden" id="branchNameAsal" name="branchNameAsal" class="form-control">
                                    <input type="hidden" id="kecNameAsal" name="kecNameAsal" class="form-control">
                                    <input type="hidden" id="kabupatenNameAsal" name="kabupatenNameAsal"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Destination</label>
                                <div class="col-lg-8 px-1">
                                    <input type="text" id="hint2" name="ke" class="form-control ui-autocomplete-input"
                                        placeholder=" Kota Tujuan">
                                    <input type="hidden" id="tujuan" name="tujuan" class="form-control" />
                                    <input type="hidden" id="kabTujuan" name="kabTujuan" class="form-control" />
                                    <input type="hidden" id="branchNameTujuan" name="branchNameTujuan"
                                        class="form-control">
                                    <input type="hidden" id="kecNameTujuan" name="kecNameTujuan" class="form-control">
                                    <input type="hidden" id="kabupatenNameTujuan" name="kabupatenNameTujuan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Berat (Weight)</label>
                                <div class="col-lg-8">
                                    <div class="row align-items-center">
                                        <div class="col-4 px-1">
                                            <div class="position-relative">
                                                <input type="text" name="berat" class="form-control pe-5"
                                                    placeholder="Ex: 1" onkeypress="return hanyaAngka(event)">
                                                <p class="position-absolute top-0 end-0 m-2">KG</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13">Volume (CM)</label>
                                <div class="col-lg-8">
                                    <div class="row align-items-center">
                                        <div class="col-4 px-1">
                                            <input type="text" name="length" class="form-control" placeholder="Length"
                                                onkeypress="return hanyaAngka(event)">
                                        </div>
                                        <div class="col-4 px-1">
                                            <input type="text" name="weight" class="form-control" placeholder="Width"
                                                onkeypress="return hanyaAngka(event)">
                                        </div>
                                        <div class="col-4 px-1">
                                            <input type="text" name="height" class="form-control" placeholder="Height"
                                                onkeypress="return hanyaAngka(event)">
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="mb-3 row align-items-center">
                                <label class="col-lg-4 fs-13"></label>
                                <div class="col-lg-8">
                                    <button type="submit"
                                        class="btn bg-blue fw-bold rounded-10 border-0 mt-3 px-5">SEARCHING</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" data-aos="fade-down" data-aos-duration="800">
                <div class="slider-container">
                    <div class="swiper-container ongkir-slider">
                        <div class="swiper-wrapper align-items-center">
                            <?php foreach ($os as $os) { ?>
                            <div class="swiper-slide">
                                <div class="img p-lg-4">
                                    <img src="https://admin103.progipedia.com/upload/slider_cek_ongkir/<?= $os->image; ?>"
                                        title="<?= $os->nama; ?>" class="img-fluid" alt="">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-xxl kebutuhan-home px-0">
    <div class="container py-5 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="header-title-home text-center wow fadeInUp" data-wow-delay="0.2s">
                    <div class="d-flex justify-content-center mb-3">
                        <h6>Kebutuhan</h6>
                    </div>
                    <h2><?= $content_layanan->title; ?></h2>
                    <div class="mt-4">
                        <p><?= $content_layanan->deskripsi; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $no = 1;
            if ($no < 10) {
                $zero = 0;
            } else {
                $zero = '';
            }
            foreach ($service as $s) { ?>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="box-kebutuhan">
                    <h1 class="number"><?= $zero; ?><?= $no++; ?></h1>
                    <div class="img">
                        <img src="https://admin103.progipedia.com/upload/services/<?= $s->image; ?>" class="img-fluid"
                            alt="">
                    </div>
                    <div class="title my-2">
                        <h5><?= $s->title; ?></h5>
                        <p class="fs-12">Progipedia</p>
                    </div>
                    <div class="desk mt-3">
                        <p><?= $s->description; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container-xxl paket-home px-0">
    <div class="container py-5 px-lg-5">
        <div class="row justify-content-center pb-5">
            <div class="col-lg-10">
                <div class="header-title-home text-center wow fadeInUp" data-wow-delay="0.2s">
                    <div class="d-flex justify-content-center mb-3">
                        <h6>Kirim Paketmu</h6>
                    </div>
                    <h2><?= $content_paket->title; ?></h2>
                    <div class="mt-4">
                        <p><?= $content_paket->deskripsi; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center pt-5 wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-6 col-md-6">
                <div class="img text-center">
                    <img src="https://admin103.progipedia.com/upload/fitur/<?= $fitur->image; ?>" class="img-fluid"
                        alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4 mt-md-0">
                <div class="fitur">
                    <h2><?= $fitur->title; ?></h2>
                    <?= $fitur->deskripsi; ?>
                </div>
            </div>
        </div>

    </div>
</div>