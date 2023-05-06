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

if (isset($_POST["save_status_pengembalian"])) {
    if (status_pengembalian_save($_POST) > 0) {
        echo "<script>
            alert('Data pengembalian berhasil ditambah!');
            document.location.href = 'peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Data pengembalian gagal ditambah!');
            document.location.href = 'peminjaman.php';
          </script>";
    }
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h5 class="card-title pt-2">Detail Data Pengembalian Alat & Bahan</h5>
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
                                    <a href="peminjaman.php" class="btn btn-warning text-white"><i
                                            class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" value="<?= $id_peminjaman ?>" name="id_peminjaman" />
                            <input type="hidden" value="1" name="status_pengembalian" />


                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Alat / Bahan</th>
                                            <th>Qty Peminjaman</th>
                                            <th>Qty Pengembalian</th>
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
                                                    <div class="form-group">
                                                        <input type="number" class="form-control"
                                                            name="qty_pengembalian<?= $pd["id_alat_bahan"]; ?>" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <input type="hidden" value="<?= $pd["id_alat_bahan"]; ?>"
                                                name="id_alat_bahan<?= $pd["id_alat_bahan"]; ?>" />

                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save_status_pengembalian">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>