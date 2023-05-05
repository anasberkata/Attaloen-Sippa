<h4 class="card-title">Daftar Alat dan Bahan</h4>

<?php
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $sql_s = "SELECT * FROM alat_bahan WHERE id_alat_bahan={$id}";
        $query_s = mysqli_query($conn, $sql_s);
        if (mysqli_num_rows($query_s) != 0) {
            $row_s = mysqli_fetch_array($query_s);
            $_SESSION['cart'][$row_s['id_alat_bahan']] = array(
                "quantity" => 1
            );
        } else {
            $message = "Barang ini tidak ada!";
        }
    }
}
?>

<?php foreach ($alat_bahan as $ab): ?>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="../assets/img/alat_bahan/<?= $ab["gambar"]; ?>" alt="alat_produk" class="img-thumbnail" />
                </div>
                <div class="el-card-content text-center">
                    <h4 class="my-2">
                        <?= $ab["nama_alat_bahan"]; ?>
                    </h4>
                    <p class="small">
                        Qty :
                        <?= $ab["qty"]; ?>
                    </p>
                    <a href="peminjaman_detail_add.php?page=products&action=add&id=<?= $ab["id_alat_bahan"]; ?>&id_peminjaman=<?= $id_peminjaman ?>"
                        class="btn btn-info">Tambah</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>