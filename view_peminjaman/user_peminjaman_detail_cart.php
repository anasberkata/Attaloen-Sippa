<?php

$id_peminjaman = $_GET["id_peminjaman"];

if (isset($_POST['edit_cart'])) {
    foreach ($_POST['quantity'] as $key => $val) {
        if ($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['quantity'] = $val;
        }
    }

    echo "<script>
            document.location.href = 'peminjaman_detail_add.php?page=peminjaman_detail_cart&id_peminjaman=' + $id_peminjaman;
          </script>";
}

if (isset($_POST["add_peminjaman_detail"])) {
    if (peminjaman_detail_add($_POST) > 0) {
        // Clear the cart
        $_SESSION['cart'] = array();

        echo "<script>
            alert('Data peminjaman berhasil ditambah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal ditambah!');
            document.location.href = 'peminjaman_detail.php?id_peminjaman=' + $id_peminjaman;
          </script>";
    }
}
?>

<h4 class="card-title">Keranjang</h4>

<form method="post" action="">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Alat / Bahan</th>
                    <th>Qty Peminjaman</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>

                    <?php
                    $ids = implode(',', array_keys($_SESSION['cart']));
                    $cart = query("SELECT * FROM alat_bahan WHERE id_alat_bahan IN ($ids) ORDER BY nama_alat_bahan ASC");
                    ?>

                    <?php $i = 1; ?>
                    <?php foreach ($cart as $c): ?>
                        <tr>
                            <td>
                                <?= $i; ?>
                            </td>
                            <td>
                                <?= $_SESSION['cart'][$c['id_alat_bahan']]['nama_alat_bahan'] ?>
                            </td>
                            <td>
                                <input class="form-control" type="number" id="input-number"
                                    name="quantity[<?= $c['id_alat_bahan'] ?>]"
                                    value="<?= $_SESSION['cart'][$c['id_alat_bahan']]['quantity'] ?>" />
                            </td>
                        </tr>

                        <input type="hidden" value="<?= $id_peminjaman ?>" name="id_peminjaman">
                        <input type="hidden" value="<?= $_SESSION['cart'][$c['id_alat_bahan']]['nama_alat_bahan'] ?>"
                            name="nama_barang[<?= $c['id_alat_bahan'] ?>]">
                        <input type="hidden" value="<?= $_SESSION['cart'][$c['id_alat_bahan']]['id_alat_bahan'] ?>"
                            name="id_barang[<?= $c['id_alat_bahan'] ?>]">

                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Keranjang kosong</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <br />

        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
            <a href="peminjaman_detail_add.php?page=products&id_peminjaman=<?= $id_peminjaman; ?>"
                class="btn btn-warning">Kembali ke halaman alat &
                bahan</a>
            <button type="submit" name="edit_cart" class="btn btn-dark">Update Keranjang</button>
            <button type="submit" name="add_peminjaman_detail" class="btn btn-primary">Order</button>
        </div>
    </div>
</form>

<br />

<p class="small my-2">*Untuk menghapus item, ubah Qty Peminjaman menjadi 0. </p>

<script>
    const inputNumber = document.getElementById('input-number');
    inputNumber.addEventListener('change', () => {
        if (inputNumber.value < 0) {
            inputNumber.value = 0;
        }
    });
</script>