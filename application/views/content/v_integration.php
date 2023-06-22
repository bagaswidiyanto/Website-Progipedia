<div class="container-xxl px-0 hero-header position-relative">
    <div class="container py-5 px-lg-5">
        <div class="row text-center text-lg-start wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-xl-5 col-lg-6">
                <h1><?= $txt->title; ?></h1>
                <p><?= $txt->deskripsi; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl platform">
    <div class="container  py-5 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="header-title text-center wow fadeInUp" data-wow-delay="0.2s">
                    <h1 class="mb-3">Modern Rest API's, Simply Delivered</h1>
                    <p>Kami menggunakan teknologi REST API terbaru yang lebih mudah dimengerti oleh developer ber skala
                        kecil</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <?php foreach ($fitur as $f) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="box-platform">
                    <div class="icon">
                        <i class="<?= $f->icon; ?>"></i>
                    </div>
                    <div class="title">
                        <h5><?= $f->title; ?></h5>
                        <p><?= $f->deskripsi; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container-xxl client">
    <div class="container py-5 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.2s">
                <div class="header-title text-center">
                    <h1>Telah dipercayai oleh</h1>
                    <p>Progipedia berkomitmen untuk selalu mendukung perkembangan dan kemajuan UMKM di seluruh Indonesia
                    </p>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <?php foreach ($client as $c) { ?>
            <div class="col-lg-2 col-md-2 col-sm-3 col-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="img">
                    <img src="https://admin103.progipedia.com/upload/clients/<?= $c->image; ?>" class="img-fluid"
                        title="<?= $c->name; ?>" alt="">
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>