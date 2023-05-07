<?php
session_start();
include "../templates/header.php";

$id_user = $user["id_user"];

$peminjaman = query("SELECT * FROM peminjaman INNER JOIN users ON peminjaman.id_karyawan = users.id_user WHERE id_karyawan = $id_user");
$total_peminjaman = count($peminjaman);

$peminjaman_pending = query("SELECT * FROM peminjaman INNER JOIN users ON peminjaman.id_karyawan = users.id_user WHERE status_peminjaman = 2 AND id_karyawan = $id_user");
$total_peminjaman_pending = count($peminjaman_pending);

$peminjaman_belum_kembali = query("SELECT * FROM peminjaman INNER JOIN users ON peminjaman.id_karyawan = users.id_user WHERE status_pengembalian = 2 AND id_karyawan = $id_user");
$total_peminjaman_belum_kembali = count($peminjaman_belum_kembali);

$peminjaman_detail = query("SELECT * FROM peminjaman_detail INNER JOIN peminjaman ON peminjaman_detail.id_peminjaman = peminjaman.id_peminjaman INNER JOIN users ON peminjaman.id_karyawan = users.id_user WHERE id_karyawan = $id_user GROUP BY id_barang");
$total_peminjaman_detail = count($peminjaman_detail);

$alat_bahan = query("SELECT * FROM alat_bahan INNER JOIN kategori ON alat_bahan.id_kategori = kategori.id_kategori");

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
                            <?= $total_peminjaman; ?> peminjaman
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
                            <?= $total_peminjaman_pending; ?> Peminjaman
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
                            <?= $total_peminjaman_belum_kembali; ?> Peminjaman
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
                            <?= $total_peminjaman_detail; ?> Barang dipinjam
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Data Alat & Bahan</h5>
                            </div>
                            <div class="col">
                                <a href="../view_peminjaman/user_peminjaman_add.php"
                                    class="btn btn-warning text-white float-end"><i class="mdi mdi-account-plus"></i>
                                    Buat Peminjaman</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Nama Alat & Bahan</th>
                                        <th>Tipe, Merk & Spesifikasi</th>
                                        <th>Qty</th>
                                        <th>Kondisi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($alat_bahan as $ab): ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <img src="../assets/img/alat_bahan/<?= $ab["gambar"]; ?>"
                                                    class="img-thumbnail">
                                            </td>
                                            <td>
                                                <?= $ab["nama_alat_bahan"]; ?>
                                            </td>
                                            <td>
                                                <?= $ab["merk"]; ?>
                                            </td>
                                            <td>
                                                <?= $ab["qty"]; ?>
                                            </td>
                                            <td>
                                                <?= $ab["kondisi"]; ?>
                                            </td>
                                            <td>
                                                <?= $ab["keterangan"]; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    include "../templates/footer.php";
    ?>