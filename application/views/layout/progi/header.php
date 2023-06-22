<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $website->metaTitle; ?></title>
    <meta name="description" content="<?= $website->metaKeywords; ?>" />
    <meta name="author" content="<?= $website->metaDescription; ?>" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">


    <link href="<?= base_url(); ?>assets/assets_dashboard/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/assets_dashboard/css/stylenew.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css"
        href="https://admin103.progipedia.com/assets/dist/css/jquery.datetimepicker.css" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="https://admin103.progipedia.com/assets/dist/js/build/jquery.datetimepicker.full.min.js"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a href="<?= base_url() ?>" title="<?= $website->metaTitle; ?>" class="logo d-flex align-items-center">
            <img src="https://admin103.progipedia.com/upload/<?= $website->image; ?>" class="w-100" alt="">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><?= $this->session->userdata("nama"); ?> <i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item text-danger" href="<?= base_url(); ?>welcome/logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main Navigation</div>
                        <a class="nav-link <?= ($this->uri->Segment(1) == 'dashboard') ? 'active' : '' ?>"
                            href="<?= base_url() ?>dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link <?= ($this->uri->Segment(1) == 'booking') ? 'active' : '' ?>"
                            href="<?= base_url(); ?>booking">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Booking Reguler
                        </a>
                        <a class="nav-link <?= ($this->uri->Segment(1) == 'pickup') ? 'active' : '' ?>"
                            href="<?= base_url(); ?>pickup">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            List Booking Pickup
                        </a>
                        <a class="nav-link <?= ($this->uri->Segment(1) == 'cektarifprogi') ? 'active' : '' ?>"
                            href="<?= base_url(); ?>cektarifprogi">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Cek Tarif
                        </a>
                        <a class="nav-link <?= ($this->uri->Segment(1) == 'lacakprogi') ? 'active' : '' ?>"
                            href="<?= base_url(); ?>lacakprogi">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Lacak AWB
                        </a>
                        <a class="nav-link <?= ($this->uri->Segment(1) == 'katalogbarangprogi') ? 'active' : '' ?>"
                            href="<?= base_url() ?>katalogbarangprogi">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Katalog Barang
                        </a>
                        <!-- <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Bantuan
                        </a> -->
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">