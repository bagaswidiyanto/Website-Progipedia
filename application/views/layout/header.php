<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B2YSBV4YWJ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-B2YSBV4YWJ');
    </script>

    <?php foreach ($this->db->query("SELECT * FROM tbl_navigation WHERE status = 1")->result() as $n) { ?>
    <?php if ($this->uri->segment(1) == $n->slug) {
            $segment1 = $n->metaTitle;
            $metaKey = $n->metaKeywords;
            $metaDes = $n->metaDescription;
        } elseif ($this->uri->segment(1) == '') {
            $segment1 = $website->metaTitle . ' | Home';
            $metaKey = $website->metaKeywords;
            $metaDes = $website->metaDescription;
        } ?>
    <?php } ?>

    <?php
    if ($this->uri->segment(1) == 'prices') {
        $segment1 = $website->metaTitle . ' | Price';
        $metaKey = $website->metaKeywords;
        $metaDes = $website->metaDescription;
    } else if ($this->uri->segment(1) == 'tracking') {
        $segment1 = $website->metaTitle . ' | Tracking';
        $metaKey = $website->metaKeywords;
        $metaDes = $website->metaDescription;
    } else if ($this->uri->segment(1) == 'verifikasi') {
        $segment1 = $website->metaTitle . ' | Verifikasi';
        $metaKey = $website->metaKeywords;
        $metaDes = $website->metaDescription;
    } else if ($this->uri->segment(1) == 'dashboard') {
        $segment1 = $website->metaTitle . ' | Dashboard';
        $metaKey = $website->metaKeywords;
        $metaDes = $website->metaDescription;
    }
    ?>

    <?php if ($this->uri->segment(2) != 'detail') { ?>
    <title><?= $segment1; ?></title>
    <meta name="keywords" content="<?= $metaKey; ?>">
    <meta name="description" content="<?= $metaDes; ?>">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $segment1; ?>" />
    <meta property="og:description" content="<?= $metaDes; ?>" />
    <meta property="og:url" content="http://progipedia.com" />
    <meta property="og:image" content="<?= base_url() ?>assets/imagenew/logo_link.png" />
    <?php } ?>


    <?php
    if ($this->uri->segment(2) == 'detail') {
        $meta = $this->db->get_where('tbl_posts', array('slug' => $this->uri->segment(3)))->row();
    ?>
    <title><?= $meta->Title; ?> </title>
    <meta name="keywords" content="<?= $meta->metaKeywords; ?>">
    <meta name="description" content="<?= $meta->metaDescription; ?>">


    <meta property="og:site_name" content="<?= $website->metaTitle; ?>" />
    <meta property="og:title" content="<?= $meta->Title; ?>" />
    <meta property="og:description" content="<?= $meta->metaDescription; ?>" />
    <meta property="og:url" content="http://progipedia.com/blog/detail/<?= $meta->slug; ?>" />
    <meta property="og:type" content="article" />
    <meta property="article:publisher" content="http://progipedia.com/" />
    <meta property="article:section" content="<?= $website->metaTitle; ?>" />
    <meta property="article:tag" content="<?= $website->metaTitle; ?>" />
    <meta property="og:image" content="https://admin103.progipedia.com/upload/posts/<?= $meta->image; ?>" />
    <meta property="og:image:secure_url" content="https://admin103.progipedia.com/upload/posts/<?= $meta->image; ?>" />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="640" />
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:image" content="https://admin103.progipedia.com/upload/posts/<?= $meta->image; ?>" />
    <meta property="twitter:site" content="@progipedia" />

    <?php } ?>

    <!-- Favicon -->
    <link href="<?= base_url(); ?>assets/imagenew/logo_link.png" sizes="32x32" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


    <!-- Libraries Stylesheet -->
    <link href="<?= base_url(); ?>assets/lib/animate/animate.min.css" rel="stylesheet">
    <!-- <link href="<?= base_url(); ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->
    <link href="<?= base_url(); ?>assets/lib/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/blog.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/manajemen_order.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/darkmode.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/responsive.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/swiper.css" rel="stylesheet">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">
    <div class="container-fluid nav-home p-0" id="home">
        <header id="header" class="header px-4 px-lg-5 py-2 py-lg-0">
            <div class="container-fluid container-xxl d-flex align-items-center justify-content-between">
                <?php if ($this->uri->segment(1) != 'dashboard') { ?>

                <a href="<?= base_url() ?>" title="<?= $website->metaTitle; ?>" class="logo d-flex align-items-center">
                    <img src="https://admin103.progipedia.com/upload/<?= $website->image; ?>" alt="">
                </a>
                <nav id="navbar" class="navbar ms-auto">
                    <ul>
                        <?php
                            $hal = $this->uri->segment(1);
                            $menuNav = $this->db->query("SELECT * FROM tbl_navigation WHERE status = 1 ORDER BY sort ASC")->row();
                            if ($hal != '') {
                                foreach ($this->db->query("SELECT * FROM tbl_navigation WHERE parent = 0 AND status = 1 ORDER BY sort ASC")->result() as $key) {
                                    if ($key->isPost == 1) {
                                        $chevron = '<i class="bi bi-chevron-down"></i>';
                                    } else {
                                        $chevron = '';
                                    }

                                    if ($key->id == 4) {
                                        $link = ($key->title != 'Beranda') ? strtolower($key->slug) : base_url();
                                    } else {
                                        $link = ($key->title != 'Beranda') ? base_url() . strtolower($key->slug) : base_url();
                                    }
                            ?>
                        <li class="dropdown"><a class="nav-link scrollto <?php if ($key->slug != "") {
                                                                                            if ($this->uri->segment(1) == $key->slug) {
                                                                                                echo "active";
                                                                                            }
                                                                                        } else {
                                                                                            if ($this->uri->segment(1) == "") {
                                                                                                echo "active";
                                                                                            }
                                                                                        }
                                                                                        if ($key->id == 4) {
                                                                                            if ($hal == 'manajemenorder') {
                                                                                                echo "active";
                                                                                            } else if ($hal == 'integration') {
                                                                                                echo "active";
                                                                                            }
                                                                                        }
                                                                                        ?>" href="<?= $link ?>"
                                onclick="window.location.href='<?= $key->slug; ?>';"><?= $key->title ?>
                                <?= $chevron; ?></a>
                            <ul>
                                <?php foreach ($this->db->query("SELECT * FROM tbl_navigation where parent='$key->id' and status='1' order by sort")->result() as $c) { ?>
                                <li><a class="nav-link scrollto <?php if ($c->slug != "") {
                                                                                    if ($this->uri->segment(1) == $c->slug) {
                                                                                        echo "active";
                                                                                    }
                                                                                } else {
                                                                                    if ($this->uri->segment(1) == "") {
                                                                                        echo "active";
                                                                                    }
                                                                                } ?>"
                                        href="<?= base_url() . $c->slug ?>"
                                        onclick="window.location.href='<?= $c->slug ?>';"><?= $c->title; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php } else { ?>
                        <?php
                                foreach ($this->db->query("SELECT * FROM tbl_navigation WHERE id != 1 AND parent = 0 AND status = 1 ORDER BY sort ASC")->result() as $key) {
                                    if ($key->isPost == 1) {
                                        $chevron = '<i class="bi bi-chevron-down"></i>';
                                    } else {
                                        $chevron = '';
                                    }

                                    if ($key->id == 4) {
                                        $link = ($key->title != 'Beranda') ? strtolower($key->slug) : base_url();
                                    } else {
                                        $link = ($key->title != 'Beranda') ? base_url() . strtolower($key->slug) : base_url();
                                    }
                                ?>
                        <li class="dropdown"><a class="nav-link scrollto <?php if ($key->slug != "") {
                                                                                            if ($this->uri->segment(1) == $key->slug) {
                                                                                                echo "active";
                                                                                            }
                                                                                        } else {
                                                                                            if ($this->uri->segment(1) == "") {
                                                                                                echo "active";
                                                                                            }
                                                                                        }
                                                                                        if ($key->id == 4) {
                                                                                            if ($hal == 'manajemenorder') {
                                                                                                echo "active";
                                                                                            } else if ($hal == 'integration') {
                                                                                                echo "active";
                                                                                            }
                                                                                        }
                                                                                        ?>" href="<?= $link ?>"
                                onclick="window.location.href='<?= $key->slug; ?>';"><?= $key->title ?>
                                <?= $chevron; ?></a>
                            <ul>
                                <?php foreach ($this->db->query("SELECT * FROM tbl_navigation where parent='$key->id' and status='1' order by sort")->result() as $c) { ?>
                                <li><a class="nav-link scrollto <?php if ($c->slug != "") {
                                                                                    if ($this->uri->segment(1) == $c->slug) {
                                                                                        echo "active";
                                                                                    }
                                                                                } else {
                                                                                    if ($this->uri->segment(1) == "") {
                                                                                        echo "active";
                                                                                    }
                                                                                } ?>"
                                        href="<?= base_url() . $c->slug ?>"
                                        onclick="window.location.href='<?= $c->slug ?>';"><?= $c->title; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php } ?>

                        <div class="ms-auto btn-contact py-0 ps-3 ps-lg-5">
                            <li class="dropdown"><a href="#" class="ps-0"><span class="d-flex align-items-center"><i
                                            class="fas fa-user-circle me-2 fs-4"></i>
                                        <p>Account</p>
                                    </span> <i class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalLogin">Login</a></li>
                                </ul>
                            </li>
                        </div>
                        <style>
                        .darkmode {
                            background: rgb(28 27 31);
                            color: #fff;
                        }

                        #darkBtn {
                            width: 30px;
                            cursor: pointer;
                        }
                        </style>
                        <div class="img ms-3 ms-lg-0 mt-3 mt-lg-0">
                            <img src="<?= base_url() ?>assets/imagenew/moon.png" onclick="setDarkMode()" id="darkBtn"
                                alt="">
                        </div>
                    </ul>

                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
                <?php } else { ?>
                <a href="<?= base_url() ?>dashboard" title="<?= $website->metaTitle; ?>"
                    class="logo d-flex align-items-center">
                    <img src="https://admin103.progipedia.com/upload/<?= $website->image; ?>" alt="">
                </a>
                <nav id="navbar" class="navbar dashboard ms-auto">
                    <ul>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">Dashboard</a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">Booking Reguler</a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">List Booking Pickup</a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">Cek Tarif</a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">Lacak AWB</a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">Bantuan</a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link scrollto" href="">Katalog Barang</a>
                        </li>

                        <div class="ms-auto btn-contact py-0 ps-3 ps-lg-5">
                            <li class="dropdown"><a href="#" class="ps-0"><span class="d-flex align-items-center"><i
                                            class="fas fa-user-circle me-2 fs-4"></i>
                                        <p>Account</p>
                                    </span> <i class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalLogin">Login</a></li>
                                </ul>
                            </li>
                        </div>
                        <style>
                        .darkmode {
                            background: rgb(28 27 31);
                            color: #fff;
                        }

                        #darkBtn {
                            width: 30px;
                            cursor: pointer;
                        }
                        </style>
                        <div class="img ms-3 ms-lg-0 mt-3 mt-lg-0">
                            <img src="<?= base_url() ?>assets/imagenew/moon.png" onclick="setDarkMode()" id="darkBtn"
                                alt="">
                        </div>
                    </ul>

                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
                <?php } ?>
            </div>
        </header>
    </div>

    <script>
    if (localStorage.getItem('theme') == 'dark') {
        setDarkMode()
    }


    function setDarkMode() {
        let mode = '';
        let isDark = document.body.classList.toggle('darkmode');
        let icon = document.getElementById("darkBtn");

        if (isDark) {
            icon.src = "assets/imagenew/sun.png";
            localStorage.setItem('theme', 'dark');
        } else {
            icon.src = "assets/imagenew/moon.png";
            localStorage.removeItem('theme');
        }

        // document.getElementById('darkBtn').src="assets/imagenew/moon.png";
    }
    </script>