<div class="container-xxl px-0 hero-header position-relative">
    <div class="container py-5 px-lg-5">
        <div class="row">
            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.2s">
                <h1><?= $txt->title; ?></h1>
                <p><?= $txt->deskripsi; ?></p>

                <div class="d-flex align-items-center mt-4">
                    <a href="" class="btn bg-blue rounded-pill py-2 px-3 me-4">Daftar Sekarang</a>
                    <a href="#price">Lihat Harga</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl platform wow fadeInUp" data-wow-delay="0.2s">
        <div class="container  py-5 px-lg-5">
            <div class="header-title text-center">
                <h1 class="mb-3">Apa yang kamu dapatkan</h1>
                <p>Progipedia menyediakan platform agar anda dapat mengelola bisnis online dengan mudah</p>
            </div>

            <div class="row g-4 mt-5">
                <?php foreach ($fitur as $f) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="box-platform">
                        <div class="icon">
                            <i class="<?= $f->icon; ?>"></i>
                        </div>
                        <div class="title">
                            <h4 class="text-white"><?= $f->title; ?></h4>
                            <p><?= $f->deskripsi; ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container-xxl paket" id="price">
        <div class="container py-5 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="header-title text-center wow fadeInUp" data-wow-delay="0.2s">
                        <h1>Paket terlengkap untuk kebutuhan bisnismu</h1>
                        <p>Tentukan pilihan terbaik untuk kebutuhan bisnismu. Cobain gratis buat 6 bulan</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box">
                        <div class="title text-center">
                            <p>Plan</p>
                            <h2><?= $basic->name_package; ?></h2>
                            <div class="price mt-4">
                                <a href="" class="py-1 px-3">Free <?= $basic->harga_bulanan; ?> bulan</a>
                            </div>
                            <div class="annualy pb-4">
                                <?php if ($basic->harga_tahunan != 0) { ?>
                                <p>Atau bayar tahunan</p>
                                <span>Rp. <?= number_format($basic->harga_tahunan, 0, ",", "."); ?> / th</span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="include m-2 p-4">
                            <p><?= $basic->name_package; ?> includes</p>
                            <?= $basic->list_include; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box">
                        <div class="title text-center">
                            <p>Plan</p>
                            <h2><?= $silver->name_package; ?></h2>
                            <div class="price mt-4">
                                <a href="" class="py-1 px-3">Free <?= $silver->harga_bulanan; ?> bulan</a>
                            </div>
                            <div class="annualy pb-4">
                                <?php if ($silver->harga_tahunan != 0) { ?>
                                <p>Atau bayar tahunan</p>
                                <span>Rp. <?= number_format($silver->harga_tahunan, 0, ",", "."); ?> / th</span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="include m-2 p-4">
                            <p><?= $silver->name_package; ?> includes</p>
                            <?= $silver->list_include; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box">
                        <div class="title text-center">
                            <p>Plan</p>
                            <h2><?= $gold->name_package; ?></h2>
                            <div class="price mt-4">
                                <a href="" class="py-1 px-3">Free <?= $gold->harga_bulanan; ?> bulan</a>
                            </div>
                            <div class="annualy pb-4">
                                <?php if ($gold->harga_tahunan != 0) { ?>
                                <p>Atau bayar tahunan</p>
                                <span>Rp. <?= number_format($gold->harga_tahunan, 0, ",", "."); ?> / th</span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="include m-2 p-4">
                            <p><?= $gold->name_package; ?> includes</p>
                            <?= $gold->list_include; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card-box">
                        <div class="title text-center">
                            <p>Plan</p>
                            <h2><?= $platinum->name_package; ?></h2>
                            <div class="price mt-4">
                                <a href="" class="py-1 px-3">Contact Us</a>
                            </div>
                            <div class="annualy pb-4">
                                <?php if ($platinum->harga_tahunan != 0) { ?>
                                <p>Atau bayar tahunan</p>
                                <span>Rp. <?= number_format($platinum->harga_tahunan, 0, ",", "."); ?> / th</span>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="include m-2 p-4">
                            <p><?= $platinum->name_package; ?> includes</p>
                            <?= $platinum->list_include; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>