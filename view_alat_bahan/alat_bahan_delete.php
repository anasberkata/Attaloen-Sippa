<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_alat_bahan = $_GET["id_alat_bahan"];

if (alat_bahan_delete($id_alat_bahan) > 0) {
    echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'alat_bahan.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = alat_bahan.php';
		</script>
	";
}