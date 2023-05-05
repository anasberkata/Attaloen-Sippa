<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];

$alat_bahan = query("SELECT * FROM alat_bahan");

if (isset($_GET['page'])) {
    $pages = array("peminjaman_detail_products", "peminjaman_detail_cart");

    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "peminjaman_detail_products";
    }
} else {
    $_page = "peminjaman_detail_products";
}

if (isset($_POST["add_peminjaman"])) {
    if (peminjaman_add($_POST) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil ditambah!');
            document.location.href = 'peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal ditambah!');
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
                            <div class="col">
                                <h5 class="card-title pt-2">Tambah Data Alat / Bahan</h5>
                            </div>
                            <div class="col">
                                <a href="peminjaman_detail.php?id_peminjaman=<?= $id_peminjaman ?>"
                                    class="btn btn-warning text-white float-end"><i class="mdi mdi-arrow-left-bold"></i>
                                    Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">

                                    <div class="row">
                                        <?php require($_page . ".php"); ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <h4 class="card-title">Keranjang</h4>
                                    <ul>
                                        <?php if (isset($_SESSION['cart'])) {
                                            $sql = "SELECT * FROM alat_bahan WHERE id_alat_bahan IN (";

                                            foreach ($_SESSION['cart'] as $id => $value) {
                                                $sql .= $id . ",";
                                            }

                                            $sql = substr($sql, 0, -1) . ") ORDER BY nama_alat_bahan ASC";

                                            $query = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>

                                                <li>
                                                    <?= $row['nama_alat_bahan'] ?> x
                                                    <?= $_SESSION['cart'][$row['id_alat_bahan']]['quantity'] ?>
                                                </li>

                                            <?php } ?>
                                        </ul>
                                        <hr />
                                        <a href="peminjaman_detail_add.php?page=peminjaman_detail_cart&id_peminjaman=<?= $id_peminjaman ?>"
                                            class="btn btn-dark">Keranjang</a>
                                        <?php
                                        } else {
                                            echo "<p>Keranjang kosong</p>";
                                        }
                                        ?>
                                </div>

                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary" name="add_peminjaman_detail">
                                    Pesan
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>