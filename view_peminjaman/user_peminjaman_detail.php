<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];
$p = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_karyawan = users.id_user
    WHERE id_peminjaman = $id_peminjaman"
)[0];

$peminjaman_detail = query(
    "SELECT * FROM peminjaman_detail
    INNER JOIN alat_bahan ON peminjaman_detail.id_barang = alat_bahan.id_alat_bahan
    WHERE id_peminjaman = $id_peminjaman"
);
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h5 class="card-title pt-2">Detail Data Peminjaman Alat & Bahan</h5>
                                <ul class="list-style-none">
                                    <li class="d-flex no-block card-body">
                                        <i class="mdi mdi-check-circle fs-4 w-30px mt-1"></i>
                                        <div>
                                            <a href="#" class="mb-0 font-medium p-0">
                                                <?= $p["nama"]; ?>
                                            </a>
                                            <span class="text-muted">
                                                Tanggal Peminjaman :
                                                <?= date('d F Y', strtotime($p["tanggal_peminjaman"])); ?>
                                                <br>
                                                Tanggal Pengembalian :
                                                <?= date('d F Y', strtotime($p["tanggal_pengembalian"])); ?>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="btn-group btn-group-toggle float-end" data-toggle="buttons">
                                    <a href="user_peminjaman.php" class="btn btn-warning text-white"><i
                                            class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                                    <a href="user_peminjaman_detail_add.php?id_peminjaman=<?= $p["id_peminjaman"] ?>"
                                        class="btn btn-warning text-white"><i class="mdi mdi-plus"></i> Tambah</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Alat / Bahan</th>
                                        <th>Qty Peminjaman</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($peminjaman_detail as $pd): ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $pd["nama_alat_bahan"]; ?>
                                            </td>
                                            <td>
                                                <?= $pd["qty_peminjaman"]; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <a href="user_peminjaman_detail_edit.php?id_peminjaman=<?= $pd["id_peminjaman"] ?>&id_peminjaman_detail=<?= $pd["id_peminjaman_detail"] ?>"
                                                        class="btn btn-info text-white"><i class="mdi mdi-pencil"></i></a>
                                                    <a href="user_peminjaman_detail_delete.php?id_peminjaman=<?= $pd["id_peminjaman"] ?>&id_peminjaman_detail=<?= $pd["id_peminjaman_detail"] ?>"
                                                        class="btn btn-danger text-white"
                                                        onclick="return confirm('Yakin ingin menghapus <?= $pd['nama_alat_bahan']; ?>?');"><i
                                                            class="mdi mdi-delete"></i></a>
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