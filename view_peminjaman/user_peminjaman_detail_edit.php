<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];
$id_peminjaman_detail = $_GET["id_peminjaman_detail"];

$pd = query("SELECT * FROM peminjaman_detail
            INNER JOIN alat_bahan ON peminjaman_detail.id_barang = alat_bahan.id_alat_bahan
            WHERE id_peminjaman_detail = $id_peminjaman_detail
            ")[0];

if (isset($_POST["edit_peminjaman_detail"])) {
    if (peminjaman_detail_edit($_POST) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil diubah!');
            document.location.href = 'user_peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal diubah!');
            document.location.href = 'user_peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    }
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Ubah Data Peminjaman</h5>
                            </div>
                            <div class="col">
                                <a href="user_peminjaman_detail.php?id_peminjaman=<?= $id_peminjaman ?>"
                                    class="btn btn-warning text-white float-end"><i class="mdi mdi-arrow-left-bold"></i>
                                    Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="card-title">Data Peminjaman :
                                    <?= $pd["nama_alat_bahan"]; ?>
                                </h4>

                                <div class="row">

                                    <input type="hidden" value="<?= $pd["id_peminjaman_detail"]; ?>"
                                        name="id_peminjaman_detail" />
                                    <input type="hidden" value="<?= $pd["id_peminjaman"]; ?>" name="id_peminjaman" />
                                    <input type="hidden" value="<?= $pd["id_barang"]; ?>" name="id_barang" />

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Qty Peminjaman</label>
                                            <input type="number" class="form-control" name="qty_peminjaman"
                                                value="<?= $pd["qty_peminjaman"]; ?>" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="edit_peminjaman_detail">
                                        Ubah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>