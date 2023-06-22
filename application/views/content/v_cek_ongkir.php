<div class="container-xxl px-0 hero-header position-relative">
    <div class="container py-5 px-lg-5">
        <h1><?= $txt->title; ?></h1>
        <p><?= $txt->deskripsi; ?></p>
    </div>
</div>

<div class="container-xxl tracking">
    <div class="container px-lg-5">
        <div class="row">
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="800">
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
                                    <input type="hidden" id="kabTujuan" name="kabTujuan" class="form-control">
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