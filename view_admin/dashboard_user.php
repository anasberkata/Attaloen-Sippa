<?php
session_start();
include "../templates/header.php";

$alat = query("SELECT * FROM alat_bahan WHERE id_kategori = 1");
$total_alat = count($alat);

$bahan = query("SELECT * FROM alat_bahan WHERE id_kategori = 2");
$total_bahan = count($bahan);

$users = query("SELECT * FROM users WHERE NOT id_user = 1");
$total_users = count($users);

$peminjaman = query("SELECT * FROM peminjaman");
$total_peminjaman = count($peminjaman);

$peminjaman_pending = query("SELECT * FROM peminjaman WHERE status_peminjaman = 2");
$total_peminjaman_pending = count($peminjaman_pending);

$peminjaman_belum_diambil = query("SELECT * FROM peminjaman WHERE status_pengambilan = 2");
$total_peminjaman_belum_diambil = count($peminjaman_belum_diambil);

$peminjaman_belum_kembali = query("SELECT * FROM peminjaman WHERE status_pengembalian = 2");
$total_peminjaman_belum_kembali = count($peminjaman_belum_kembali);

$peminjaman_detail = query("SELECT * FROM peminjaman_detail GROUP BY id_barang");
$total_peminjaman_detail = count($peminjaman_detail);

?>


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Barang</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-wrench"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_alat; ?> Peralatan
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-image-filter-vintage"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_bahan; ?> Bahan
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-secondary text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-account"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_users; ?> Karyawan
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-collage"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_peminjaman; ?> Peminjaman
                        </h6>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-collage"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_peminjaman_pending; ?> Peminjaman Pending
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-dark text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-collage"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_peminjaman_belum_diambil; ?> Peminjaman Belum Diambil
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-collage"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_peminjaman_belum_kembali; ?> Peminjaman Belum Kembali
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-collage"></i>
                        </h1>
                        <h6 class="text-white">
                            <?= $total_peminjaman_detail; ?> Barang Terpinjam
                        </h6>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <h5 class="card-title">Calender</h5>
                <div class="card">
                    <div class="card-body b-l calender-sidebar">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    include "../templates/footer.php";
    ?>