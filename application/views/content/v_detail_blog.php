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

<div class="container-fluid single-blog">
    <div class="container py-5 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="entry-title wow fadeInUp" data-wow-delay="0.3s">
                    <h1><?= $blog->Title; ?></h1>
                </div>
                <div class="entry-time wow fadeInUp" data-wow-delay="0.3s">
                    <p><?= format_hari_tanggal($blog->created_date); ?></p>
                </div>
                <div class="entry-img my-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                    <img src="https://admin103.progipedia.com/upload/posts/<?= $blog->image; ?>"
                        class="img-fluid rounded-10" alt="">
                </div>
                <div class="entry-deks wow fadeInUp" data-wow-delay="0.3s">
                    <?= $blog->content; ?>
                </div>
                <div class="share-sosmed d-flex mt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <a onclick="is_share(<?= $blog->id; ?>,'facebook')"
                        href="https://www.facebook.com/sharer.php?u=<?= base_url(); ?>blog/detail/<?= $blog->slug; ?>"
                        target="_blank" rel="nofollow" class="box-share">
                        <i class="fab fa-facebook me-2"></i>
                        <p>Bagikan</p>
                    </a>
                    <a onclick="is_share(<?= $blog->id; ?>,'twitter')"
                        href="https://twitter.com/intent/tweet?text=<?= base_url(); ?>blog/detail/<?= $blog->slug; ?>"
                        target="_blank" rel="nofollow" class="box-share">
                        <i class="fab fa-twitter me-2"></i>
                        <p>Bagikan</p>
                    </a>
                    <a onclick="is_share(<?= $blog->id; ?>,'whatsapp')"
                        href="//api.whatsapp.com/send?text=<?= base_url(); ?>blog/detail/<?= $blog->slug; ?>"
                        target="_blank" rel="nofollow" class="box-share">
                        <i class="fab fa-whatsapp me-2"></i>
                        <p>Bagikan</p>
                    </a>
                </div>
                <div class="related-post py-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="header-title">
                        <h5>Related Post</h5>
                    </div>
                    <div class="title mt-3">
                        <ul>
                            <?php foreach ($related_post as $ps) { ?>
                            <li class="wow fadeInUp" data-wow-delay="0.3s"><a
                                    href="<?= base_url() ?>blog/detail/<?= $ps->slug; ?>"
                                    title="<?= $ps->Title; ?>"><?= $ps->Title; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function is_share(id, sosmed) {
    base_url = '<?php echo base_url(); ?>';
    $.ajax({
        type: "POST",
        url: base_url + "ShareSosmed",
        dataType: "JSON",
        data: {
            'id': id,
            'sosmed': sosmed
        },
        success: function(response) {
            $('#count_' + sosmed).html(response.jumlah)
        },
        error: function() {}
    });

}
</script>