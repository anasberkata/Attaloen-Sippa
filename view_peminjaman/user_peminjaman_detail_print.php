<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

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

    <h4 style="text-align: center">FORMULIR PENGAJUAN PEMINJAMAN BARANG</h4>
    <br>
    <p>Yang bertanda tangan di bawah ini:</p>
    <table>
        <tr>
            <td>Nama Lengkap</td>
            <td>: ' . $p["nama"] . '</td>
        </tr>
        <tr>
            <td>ID Karyawan</td>
            <td>: 0.pt-attaloen-' . $p["id_user"] . '</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>: ' . $p["phone"] . '</td>
        </tr>
    </table>

    <br>
    <p>Mengajukan permohonan peminjaman alat atau bahan, adapun yang akan saya pinjam:</p>
    <br>

        <table>
        <tr>
            <td>Keperluan</td>
            <td>: ' . $p["keperluan"] . '</td>
        </tr>
        <tr>
            <td>Lama Peminjaman</td>
            <td>: ' . date('d F Y', strtotime($p["tanggal_peminjaman"])) . ' s/d ' . date('d F Y', strtotime($p["tanggal_pengembalian"])) . '</td>
        </tr>
    </table>

    <br>

    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 9px">
        <tr style="background-color: #6495ED; font-style: bold; text-align: center">
            <td>No.</td>
            <td>Nama Alat / Bahan</td>
            <td>Qty Peminjaman</td>
        </tr>';
$i = 1;
foreach ($peminjaman_detail as $pd) {
    $html .=
        '<tr>
            <td style="text-align: center;">' . $i . '</td>
            <td>' . $pd["nama_alat_bahan"] . '</td>
            <td>' . $pd["qty_peminjaman"] . '</td>
        </tr>';
    $i++;
}
$html .=
    '
    </table>

    <br>
    <p>Demikian formulir peminjaman alat laboratorium  ini saya siap bertanggung jawab apabila ada kerusakan pada alat yang dipinjam sesuai dengan ketentuan laboratorium.</p>
    <br>
    
    <table width="100%">
        <tr>
            <td style="text-align: center;" width="33.3%">
                Mengetahui,
                <br>
                Petugas
                <br>
                <br>
                <br>
                <br>
                <br>
                Janjan Hari Sudrajat
            </td>
            <td width="33.3%"></td>
            <td style="text-align: center;" width="33.3%">
                Cianjur, ' . date("d M Y") . ',
                <br>
                Peminjam
                <br>
                <br>
                <br>
                <br>
                <br>
                ' . $p["nama"] . '
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="33.3%">
            </td>
            <td width="33.3%" style="text-align: center;">
                Menyetujui,
                <br>
                Kepala UMKM ATTALOEN
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                Yuli Fitria
            </td>
            <td width="33.3%">
            </td>
        </tr>
    </table>
</body>
';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Data Peminjaman Alat dan Bahan per Tanggal ' . date("d M Y") . '.pdf', 'I');
// $mpdf->Output();