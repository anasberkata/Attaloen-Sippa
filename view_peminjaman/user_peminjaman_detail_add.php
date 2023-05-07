<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];

if (isset($_GET['page'])) {
    $pages = array("user_peminjaman_detail_products", "user_peminjaman_detail_cart");

    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "user_peminjaman_detail_products";
    }
} else {
    $_page = "user_peminjaman_detail_products";
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
                                <a href="user_peminjaman_detail.php?id_peminjaman=<?= $id_peminjaman ?>"
                                    class="btn btn-warning text-white float-end"><i class="mdi mdi-arrow-left-bold"></i>
                                    Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="card-body border-bottom">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="row">
                                        <?php require($_page . ".php"); ?>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <h4 class="card-title">Keranjang</h4>
                                    <?php if (!empty($_SESSION['cart'])): ?>
                                        <ul>
                                            <?php
                                            $ids = implode(',', array_keys($_SESSION['cart']));
                                            $cart = query("SELECT * FROM alat_bahan WHERE id_alat_bahan IN ($ids) ORDER BY nama_alat_bahan ASC");
                                            ?>

                                            <?php foreach ($cart as $c): ?>

                                                <li>
                                                    <?= $c['nama_alat_bahan'] ?> x
                                                    <?= $_SESSION['cart'][$c['id_alat_bahan']]['quantity'] ?>
                                                </li>

                                            <?php endforeach; ?>
                                        </ul>
                                        <hr />
                                        <a href="user_peminjaman_detail_add.php?page=user_peminjaman_detail_cart&id_peminjaman=<?= $id_peminjaman ?>"
                                            class="btn btn-dark">Check Out</a>

                                    <?php else: ?>
                                        <p>Keranjang kosong</p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>