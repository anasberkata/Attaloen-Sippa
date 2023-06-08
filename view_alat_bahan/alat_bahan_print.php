<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

$alat_bahan = query(
    "SELECT * FROM alat_bahan
    INNER JOIN kategori ON alat_bahan.id_kategori = kategori.id_kategori"
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

    <h4 style="text-align: center">DATA ALAT & BARANG</h4>

    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 9px">
        <tr style="background-color: #6495ED; font-style: bold; text-align: center">
            <td>No.</td>
            <td>Gambar</td>
            <td>Kode Barang</td>
            <td>Nama Alat / Bahan</td>
            <td>Spesifikasi</td>
            <td>Qty</td>
            <td>Kondisi</td>
            <td>Keterangan</td>
        </tr>';
$i = 1;
foreach ($alat_bahan as $ab) {
    $html .=
        '<tr>
            <td style="text-align: center;">' . $i . '</td>
            <td> <img src="../assets/img/alat_bahan/' . $ab["gambar"] . '" width="15%"></td>
            <td>' . $ab["kode"] . '</td>
            <td>' . $ab["nama_alat_bahan"] . '</td>
            <td>' . $ab["merk"] . '</td>
            <td>' . $ab["qty"] . '</td>
            <td>' . $ab["kondisi"] . '</td>
            <td>' . $ab["keterangan"] . '</td>
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
$mpdf->Output('Data Alat dan Bahan Tanggal ' . date("d M Y") . '.pdf', 'I');
// $mpdf->Output();