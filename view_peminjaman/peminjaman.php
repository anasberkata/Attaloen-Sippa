<?php
session_start();
include "../templates/header.php";

$peminjaman = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_karyawan = users.id_user
    ORDER BY id_peminjaman DESC"
);
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Data Peminjaman Alat & Bahan</h5>
                            </div>
                            <div class="col">
                                <a href="peminjaman_add.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-plus"></i> Tambah</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Keperluan</th>
                                        <th style="width: 500pt;">Tanggal Peminjaman</th>
                                        <th style="width: 500pt;">Tanggal Pengambilan</th>
                                        <th style="width: 500pt;">Tanggal Pengembalian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($peminjaman as $p): ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $p["nama"]; ?>
                                            </td>
                                            <td>
                                                <?= $p["keperluan"]; ?>
                                            </td>
                                            <td>
                                                <?= date('d F Y', strtotime($p["tanggal_peminjaman"])); ?>
                                                <p>status : <br>
                                                    <a
                                                        href="status_peminjaman.php?id_peminjaman=<?= $p["id_peminjaman"] ?>">
                                                        <?php if ($p["status_peminjaman"] == 1): ?>
                                                            <span class="btn btn-success text-white">Diterima</span>
                                                        <?php elseif ($p["status_peminjaman"] == 2): ?>
                                                            <span class="btn btn-warning">Pending</span>
                                                        <?php else: ?>
                                                            <span class="btn btn-danger">Ditolak</span>
                                                        <?php endif; ?>
                                                    </a>
                                                </p>
                                            </td>
                                            <td>
                                                <?= date('d F Y', strtotime($p["tanggal_pengambilan"])); ?>
                                                <p>status : <br>
                                                    <a
                                                        href="status_pengambilan.php?id_peminjaman=<?= $p["id_peminjaman"] ?>">
                                                        <?php if ($p["status_pengambilan"] == 1): ?>
                                                            <span class="btn btn-success text-white">Sudah</span>
                                                        <?php else: ?>
                                                            <span class="btn btn-danger">Belum</span>
                                                        <?php endif; ?>
                                                    </a>
                                                </p>
                                            </td>
                                            <td>
                                                <?= date('d F Y', strtotime($p["tanggal_pengembalian"])); ?>
                                                <p>status : <br>
                                                    <a
                                                        href="status_pengembalian.php?id_peminjaman=<?= $p["id_peminjaman"] ?>">
                                                        <?php if ($p["status_pengembalian"] == 1): ?>
                                                            <span class="btn btn-success text-white">Sudah</span>
                                                        <?php else: ?>
                                                            <span class="btn btn-danger">Belum</span>
                                                        <?php endif; ?>
                                                    </a>
                                                </p>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <a href="peminjaman_detail.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                        class="btn btn-success text-white"><i class="mdi mdi-login"></i></a>
                                                    <a href="peminjaman_edit.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                        class="btn btn-info text-white"><i class="mdi mdi-pencil"></i></a>



                                                    <!-- <a href="peminjaman_delete.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                                        class="btn btn-danger text-white"
                                                        onclick="return confirm('Yakin ingin menghapus <?= $p['nama']; ?>?');"><i
                                                            class="mdi mdi-delete"></i></a> -->
                                                </div>
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

        <?php
        include "../templates/footer.php";
        ?>