<?php
session_start();
include "../templates/header.php";

$alat_bahan = query(
    "SELECT * FROM alat_bahan
    INNER JOIN kategori ON alat_bahan.id_kategori = kategori.id_kategori"
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
                                <h5 class="card-title pt-2">Data ALat & Bahan</h5>
                            </div>
                            <div class="col">
                                <a href="alat_bahan_add.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-account-plus"></i> Tambah</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Gambar</th>
                                        <th>Nama Alat & Bahan</th>
                                        <th>Tipe, Merk & Spesifikasi</th>
                                        <th>Qty</th>
                                        <th>Kondisi</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
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
                                                <?= $ab["kode"]; ?>
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
                                            <td>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <a href="alat_bahan_edit.php?id_alat_bahan=<?= $ab["id_alat_bahan"] ?>"
                                                        class="btn btn-info text-white"><i
                                                            class="mdi mdi-account-edit"></i></a>
                                                    <a href="alat_bahan_delete.php?id_alat_bahan=<?= $ab["id_alat_bahan"] ?>"
                                                        class="btn btn-danger text-white"
                                                        onclick="return confirm('Yakin ingin menghapus <?= $ab['nama_alat_bahan']; ?>?');"><i
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