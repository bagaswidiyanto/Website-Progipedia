<div class="container-xxl px-0 hero-header position-relative">
    <div class="container py-5 px-lg-5 wow fadeInUp" data-wow-delay="0.2s">
        <h1><?= $txt->title; ?></h1>
        <p><?= $txt->deskripsi; ?></p>
    </div>
</div>

<div class="container-fluid lacak">
    <div class="container py-5 px-lg-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="pengiriman">
                    <div class="form-box">
                        <div class="text-header p-4 wow fadeInUp" data-wow-delay="0.2s">
                            <h4 class="text-white">Lacak Pengiriman</h4>
                            <small class="text-white">*Lacak status pengiriman dengan menginput airwaybill</small>
                        </div>
                    </div>
                    <div class="form-content p-4 wow fadeInUp" data-wow-delay="0.2s">
                        <form id="cekTarif" action="<?= base_url('tracking'); ?>" method="POST" class="login-form">
                            <div class="mb-3">
                                <select name="idCompany" id="" class="form-control select2"
                                    data-placeholder="Pilih Company">
                                    <option value=""></option>
                                    <?php foreach ($company as $c) { ?>
                                    <option value="<?= $c->id; ?>"><?= $c->namaPerusahaan; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="awb" id="awb" class="form-control"
                                    placeholder="Masukan No. AWB/DO">
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="btn bg-aqua btn-100">Cek Pengiriman <i class="fa fa-check"
                                        aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">

            </div>
        </div>
    </div>
</div>