<!doctype html>
<html lang="en">

<head>
    <title>Daftar Member Asperindo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">



    <link rel="stylesheet" href="<?= base_url(); ?>assets/datepicker/css/datepicker.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    .navbar {
        background-color: #fff;
        border-bottom: 2px solid;
    }

    .navbar .bg {
        width: 15%;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        left: auto;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 10rem;
        padding: .5rem 0;
        margin: .125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: .25rem;
    }

    .navbar .dropdown .dropdown-menu .name {
        background: transparent;
        padding: 10px;
        text-align: center;
        color: #000;
        border-bottom: 1px solid;
    }

    .flex-breadcrumb {
        justify-content: space-between;
        padding: 0 30px;
        border-bottom: 2px solid #eee;
        align-items: center;
    }

    .flex-breadcrumb .breadcrumb {
        background-color: transparent;
        margin-bottom: 0;
    }

    .flex-breadcrumb .breadcrumb li a {
        color: #000;
    }

    .card-search {
        border: 1px solid #3c8dbc;
        border-radius: 5px;
    }

    .card-search .box-header {
        background: #e50209;
        padding: 10px;
    }

    .card-search .box-header h3 {
        color: #fff;
        margin-bottom: 0;
    }

    .card-search .box-body .control-label {
        font-size: 10pt;
        font-weight: 700;
        text-align: right;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <img src="assets/images/logo_asperindo.png" class="img-fluid bg" alt="">
        <div class="dropdown ml-auto">
            <button type="button" class="border-0 bg-transparent dropdown-toggle mr-4" data-toggle="dropdown">
                <?= $this->session->userdata("nama"); ?>
            </button>
            <div class="dropdown-menu p-0">
                <a class="dropdown-item name" href="#"><?= $this->session->userdata("nama"); ?></a>
                <a class="dropdown-item text-right" href="<?= base_url(); ?>welcome/logout">SignOut</a>
            </div>
        </div>
    </nav>

    <!-- <div class="d-flex flex-breadcrumb" hidden>
        <h3 class="mb-0">Manage List Pengiriman </h3>

        <nav aria-label="breadcrumb ml-auto">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Pengiriman</li>
            </ol>
        </nav>
    </div> -->

    <div class="section px-4 mt-3" hidden>
        <div class="card-search ">
            <div class="box-header">
                <h3>Search List Pengiriman</h3>
            </div>
            <div class="box-body py-3">
                <!-- <form id="input" method="POST" class="form-horizontal foto_banyak"> -->
                <form id="input" method="POST" class="form-horizontal foto_banyak"
                    action="https://system.mexvip.co.id/modul/pengiriman/export_member.php">


                    <div class="form-group row g-4" id="dateOrder">
                        <label for="Bulan" class="control-label col-lg-2  col-md-3 col-6 mt-3">Tanggal Awal
                            Transaksi</label>
                        <div class="col-lg-2 col-md-3 col-6 mt-3">
                            <input type="text" id="startDate" name="startDate" placeholder="Start Date"
                                class="form-control datepicker" required>
                        </div>
                        <label for="Bulan" class="control-label col-lg-2 col-md-3 col-6 mt-3">Tanggal Akhir
                            Transaksi</label>
                        <div class="col-lg-2 col-md-3 col-6 mt-3">
                            <input type="text" id="endDate" name="endDate" placeholder="End Date"
                                class="form-control datepicker" required>
                        </div>

                        <div class="col-lg-4 mt-3">

                            <a onclick="getPrices()" class="btn btn-info btn-flat text-white">Search</a>
                            <a href="" class="btn btn-danger btn-flat"><i class="fa fa-refresh"></i> Refresh</a>
                            <input type="submit" class="btn btn-success btn-flat" value="Export Excel">
                        </div>

                    </div><!-- /.form-group -->
                </form>
            </div>
        </div>
    </div>

    <div class="section px-4 mt-3" hidden>
        <div class="card-search ">
            <div class="box-header p-2">
                <h3>Search List Pengiriman</h3>
            </div>
            <div class="box-body table-responsive p-2">

                <!-- <div class="card-block table-responsive"> -->
                <div id="show-prices">
                    <table id="dtb_manual" class="table table-bordered table-striped"
                        style="width: 100%; font-size: 9pt;">
                        <thead>
                            <tr>

                                <th>Tanggal Kirim</th>
                                <th>Total Resi</th>
                                <th>Koli</th>
                                <th>Berat</th>
                                <th>Lunas</th>
                                <th>Kredit</th>
                                <th>Tagih Tujuan</th>
                                <!-- <th>Tagih Tujuan Tolak</th> -->
                                <th>Sisa Tagihan</th>
                                <th>Cepat</th>
                                <th>Standar</th>
                                <th>Lambat</th>
                                <th>Belum POD</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>TOTAL</th>



                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- </div> -->
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    // $(function() {
    //     $("#dtb_manual").dataTable();
    //     $('#example2').dataTable({
    //         "bPaginate": true,
    //         "bLengthChange": false,
    //         "bFilter": false,
    //         "bSort": true,
    //         "bInfo": true,
    //         "bAutoWidth": false
    //     });
    // });

    $(document).ready(function() {
        $('#dtb_manual').DataTable({
            // responsive: true
            // "bPaginate": true,
            // "bLengthChange": false,
            // "bFilter": false,
            // "bSort": true,
            // "bInfo": true,
            // "bAutoWidth": false
        });
    });
    </script>

</body>

</html>