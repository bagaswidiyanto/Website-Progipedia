<?php
function format_hari_tanggal($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date('H:i:s', strtotime($waktu));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun";
}

?>

<div class="container-xxl px-0 hero-header position-relative">
    <div class="container py-5 px-lg-5 wow fadeInUp" data-wow-delay="0.2s">
        <h1 class="mt-5 mb-3"><?= $txt->title; ?></h1>
        <p><?= $txt->deskripsi; ?></p>
    </div>
</div>

<div class="container-fluid search border-top border-bottom border-1">
    <div class="container py-2 px-lg-5">
        <div class="row align-items-center wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-lg-9">
                <ul class="d-flex mb-0">
                    <?php foreach ($kategori as $k) { ?>
                        <li><a onclick="getCategory(<?= $k->id; ?>, '<?= $k->nama; ?>')" title="<?= $k->nama; ?>"><?= $k->nama; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-3 mt-2 mt-lg-0">
                <div class="form-search">
                    <form class="position-relative" role="search" method="get" action="<?= base_url('blog'); ?>">
                        <input type="text" name="s" class="form-control bg-transparent" placeholder="Cari Blog...">
                        <button class="border-0 bg-transparent position-absolute end-0 top-0 m-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-xxl blog">
    <div class="container py-5 px-lg-5">
        <div class="row position-relative">
            <div class="col-lg-9">
                <div class="featured border border-1 rounded-20 p-3 wow fadeInUp" data-wow-delay="0.2s">
                    <a href="<?= base_url() ?>blog/detail/<?= $featured->slug; ?>" <?= $featured->Title; ?>>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="img rounded-10">
                                    <img src="https://admin103.progipedia.com/upload/posts/<?= $featured->image; ?>" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 position-relative">
                                <div class="title">
                                    <span>Featured</span>
                                    <h5 class="mb-2"><?= $featured->Title; ?></h5>
                                    <div class="desk mb-5">
                                        <p><?= substr(strip_tags($featured->en_content), 0, 100); ?>...</p>
                                    </div>
                                    <div class="time position-absolute bottom-0 start-0 mb-1 ms-3">
                                        <p><i class="fa fa-clock-o"></i>
                                            <?= format_hari_tanggal($featured->created_date); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="artikel">
                    <div class="header-title py-3">
                        <h5>Artikel Terbaru</h5>
                    </div>
                    <?php
                    if (($blog->num_rows()) > 0) {
                        foreach ($blog->result() as $blog) {
                    ?>
                            <div class="artikel-blog border border-1 rounded-20 p-3 mb-3 wow fadeInUp" data-wow-delay="0.2s">
                                <a href="<?= base_url() ?>blog/detail/<?= $blog->slug; ?>" title="<?= $blog->Title; ?>">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="img rounded-10">
                                                <img src="https://admin103.progipedia.com/upload/posts/<?= $blog->image; ?>" class="img-fluid h-100" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 position-relative py-3">
                                            <div class="title">
                                                <h5 class="mb-2"><?= $blog->Title; ?></h5>
                                                <div class="desk mb-5">
                                                    <p><?= substr(strip_tags($blog->en_content), 0, 100); ?>...</p>
                                                </div>
                                                <div class="time position-absolute bottom-0 start-0 mb-1 ms-3">
                                                    <p><i class="fa fa-clock-o"></i>
                                                        <?= format_hari_tanggal($blog->created_date); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>


                    <nav class="blog-pagination justify-content-center d-flex wow fadeInUp" data-wow-delay="0.2s">
                        <?= $pagination; ?>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="side-blog">
                    <div class="header-title wow fadeInUp" data-wow-delay="0.2s">
                        <h5>Kabar Terbaru</h5>
                    </div>
                    <div class="advert my-3 wow fadeInUp" data-wow-delay="0.2s">
                        <img src="<?= base_url() ?>assets/imagenew/iklan.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="header-title mb-3 wow fadeInUp" data-wow-delay="0.2s">
                        <h5>Artikel Terkenal</h5>
                    </div>
                    <?php foreach ($post_side as $ps) { ?>
                        <div class="artikel-terkenal mb-2 wow fadeInUp" data-wow-delay="0.2s">
                            <a href="<?= base_url() ?>blog/detail/<?= $ps->slug; ?>" title="<?= $ps->Title; ?>">
                                <p><?= $ps->Title; ?></p>
                                <div class="time">
                                    <span><?= format_hari_tanggal($ps->created_date); ?></span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function getCategory(id_kategori, name) {
        base_url = '<?php echo base_url(); ?>';
        $.ajax({
            type: "GET",
            url: base_url + "blog",
            data: {
                'id_kategori': id_kategori,
                'nama': name
            },
            success: function(html) {
                window.location = base_url + 'blog/category/?id_kategori=' + id_kategori;
            },
            error: function() {}
        });
    }
</script>