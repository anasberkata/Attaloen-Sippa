<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

$peminjaman = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_karyawan = users.id_user
    ORDER BY id_peminjaman DESC"
);

$html = '
    <table cellpadding="10px" cellspacing="0" width="100%">
        <tr>
            <td>
                <img src="../assets/img/logo-attaloen.png" width="20%">
            </td>
            <td style="text-align: center;">
                <h3>USAHA MIKRO KECIL MENENGAH</h3>
                <h3>ATTALOEN CIANJUR</h3>
                <p>Kp. Cibeureum RT. 03/09, Babakan Karet, Kab. Cianjur. Jawa Barat</p>
            </td>
            <td></td>
        </tr>
    </table>

    <h4 style="text-align: center">DATA PEMINJAMAN ALAT & BARANG</h4>

    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 9px">
        <tr style="background-color: #6495ED; font-style: bold; text-align: center">
            <td>No.</td>
            <td>Nama</td>
            <td>Keperluan</td>
            <td>Tanggal Peminjaman</td>
            <td>Tanggal Pengambilan</td>
            <td>Tanggal Pengembalian</td>
        </tr>';
$i = 1;
foreach ($peminjaman as $p) {
    $statusPeminjaman = '';
    if ($p["status_peminjaman"] == 1) {
        $statusPeminjaman = 'Diterima';
    } elseif ($p["status_peminjaman"] == 2) {
        $statusPeminjaman = 'Pending';
    } else {
        $statusPeminjaman = 'Ditolak';
    }

    $statusPengambilan = '';
    if ($p["status_pengambilan"] == 1) {
        $statusPengambilan = 'Sudah';
    } else {
        $statusPengambilan = 'Belum';
    }

    $statusPengembalian = '';
    if ($p["status_pengembalian"] == 1) {
        $statusPengembalian = 'Sudah';
    } else {
        $statusPengembalian = 'Belum';
    }

    $html .=
        '<tr>
            <td style="text-align: center;">' . $i . '</td>
            <td>' . $p["nama"] . '</td>
            <td>' . $p["keperluan"] . '</td>
            <td>' . date('d F Y', strtotime($p["tanggal_peminjaman"])) . '
            <br>' . $statusPeminjaman . '
            </td>
            <td>' . date('d F Y', strtotime($p["tanggal_pengambilan"])) . '
            <br>' . $statusPengambilan . '
            </td>
            <td>' . date('d F Y', strtotime($p["tanggal_pengembalian"])) . '
            <br>' . $statusPengembalian . '
            </td>
        </tr>';
    $i++;
}
$html .=
    '
    </table>
</body>
';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Data Peminjaman Alat dan Bahan per Tanggal ' . date("d M Y") . '.pdf', 'I');
// $mpdf->Output();