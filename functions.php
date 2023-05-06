<?php

// KONEKSI DATABASE =====================================================
$conn = mysqli_connect("localhost", "root", "", "db_sippa");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// -----------------------------------------------------------------------------------------------------
// USERS
function user_add($data)
{
    global $conn;

    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $phone = $data["phone"];
    $role = $data["role"];

    $image = "default.jpg";

    $date_created = date("Y-m-d");
    $is_active = 1;

    $cek_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    // Cek Username Mahasiswa Sudah Ada Atau Belum
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'user_add.php';
            </script>";
    } else if (mysqli_fetch_assoc($cek_email)) {
        echo "<script>
            alert('Email Sudah Terdaftar!');
            document.location.href = 'user_add.php';
            </script>";
    } else {
        $query = "INSERT INTO users
				VALUES
			(NULL, '$nama', '$username', '$email', '$password', '$phone', '$image', '$role', '$date_created', '$is_active')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function user_edit($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $phone = $data["phone"];
    $role = $data["role"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password',
			phone = '$phone',
			role_id = '$role'

            WHERE id_user = $id_user
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function user_delete($id_user)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");
    return mysqli_affected_rows($conn);
}

function profile_edit($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $phone = $data["phone"];
    $role = $data["role"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password',
			phone = '$phone',
			role_id = '$role'

            WHERE id_user = $id_user
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

// -----------------------------------------------------------------------------------------------------
// ALAT & BAHAN
function alat_bahan_add($data)
{
    global $conn;

    $kode = $data["kode"];
    $nama_alat_bahan = $data["nama_alat_bahan"];
    $merk = $data["merk"];
    $id_kategori = $data["id_kategori"];
    $qty = $data["qty"];
    $gambar_alat_bahan = upload_gambar_alat_bahan();
    $kondisi = $data["kondisi"];
    $keterangan = $data["keterangan"];
    $date_created = date("Y-m-d");

    $query = "INSERT INTO alat_bahan
				VALUES
			(NULL, '$kode', '$nama_alat_bahan', '$merk', '$id_kategori', '$qty', '$gambar_alat_bahan', '$kondisi', '$keterangan', '$date_created')
			";

    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

function alat_bahan_edit($data)
{
    global $conn;

    $id_alat_bahan = $data["id_alat_bahan"];
    $kode = $data["kode"];
    $nama_alat_bahan = $data["nama_alat_bahan"];
    $merk = $data["merk"];
    $id_kategori = $data["id_kategori"];
    $qty = $data["qty"];
    $gambar_lama = $data["gambar_lama"];
    $kondisi = $data["kondisi"];
    $keterangan = $data["keterangan"];

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar_alat_bahan = $gambar_lama;
    } else {
        $gambar_alat_bahan = upload_gambar_alat_bahan();
    }

    $query = "UPDATE alat_bahan SET
			kode = '$kode',
			nama_alat_bahan = '$nama_alat_bahan',
			merk = '$merk',
			id_kategori = '$id_kategori',
			qty = '$qty',
			gambar = '$gambar_alat_bahan',
			kondisi = '$kondisi',
			keterangan = '$keterangan'

            WHERE id_alat_bahan = $id_alat_bahan
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function alat_bahan_delete($id_alat_bahan)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM alat_bahan WHERE id_alat_bahan = $id_alat_bahan");
    return mysqli_affected_rows($conn);
}

function upload_gambar_alat_bahan()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    if ($error === 4) {
        echo "<script>
                alert('Foto wajib diupload!');
            </script>";

        return false;
    }

    $ekstensiFileValid = ["jpg", "png", "jpeg"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('Gambar yang diupload bukan .jpg / .jpeg / .png!');
            </script>";

        return false;
    }

    // max 10mb
    if ($ukuranFile > 20000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20mb!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/img/alat_bahan/" . $namaFileBaru);

    return $namaFileBaru;
}


// -----------------------------------------------------------------------------------------------------
// USERS
function peminjaman_add($data)
{
    global $conn;

    $id_karyawan = $data["id_karyawan"];
    $keperluan = $data["keperluan"];
    $tanggal_peminjaman = $data["tanggal_peminjaman"];
    $tanggal_pengembalian = $data["tanggal_pengembalian"];
    $tanggal_pengambilan = $data["tanggal_pengambilan"];
    $status_peminjaman = "2";
    $status_pengambilan = "2";
    $status_pengembalian = "2";

    $query = "INSERT INTO peminjaman
				VALUES
			(NULL, '$id_karyawan', '$keperluan', '$tanggal_peminjaman', '$tanggal_pengembalian', '$tanggal_pengambilan', '$status_peminjaman', '$status_pengambilan', '$status_pengembalian')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function peminjaman_edit($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $id_karyawan = $data["id_karyawan"];
    $keperluan = $data["keperluan"];
    $tanggal_peminjaman = $data["tanggal_peminjaman"];
    $tanggal_pengembalian = $data["tanggal_pengembalian"];
    $tanggal_pengambilan = $data["tanggal_pengambilan"];

    $query = "UPDATE peminjaman SET
			id_karyawan = '$id_karyawan',
			keperluan = '$keperluan',
			tanggal_peminjaman = '$tanggal_peminjaman',
			tanggal_pengembalian = '$tanggal_pengembalian',
			tanggal_pengambilan = '$tanggal_pengambilan'

            WHERE id_peminjaman = $id_peminjaman
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function status_peminjaman_edit($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_peminjaman = $data["status_peminjaman"];

    $query = "UPDATE peminjaman SET
			status_peminjaman = '$status_peminjaman'

            WHERE id_peminjaman = $id_peminjaman
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function status_pengambilan_edit($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_pengambilan = $data["status_pengambilan"];

    $query = "UPDATE peminjaman SET
			status_pengambilan = '$status_pengambilan'

            WHERE id_peminjaman = $id_peminjaman
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function status_pengembalian_save($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $status_pengembalian = $data["status_pengembalian"];

    update_qty_alat_bahan($data);

    // simpan status pengembalian
    $query = "UPDATE peminjaman SET status_pengembalian = $status_pengembalian WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($conn, $query);



    return mysqli_affected_rows($conn);
}

function update_qty_alat_bahan($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];

    $peminjaman_detail = query("SELECT * FROM peminjaman_detail WHERE id_peminjaman = $id_peminjaman");
    foreach ($peminjaman_detail as $pd) {
        $id_alat_bahan = $pd["id_barang"];
        $qty_pengembalian = $data["qty_pengembalian" . $id_alat_bahan];

        // Ambil stok terbaru dari tabel alat_bahan
        $alat_bahan = query("SELECT * FROM alat_bahan WHERE id_alat_bahan = $id_alat_bahan")[0];
        $qty_terbaru = $alat_bahan["qty"] + $qty_pengembalian;

        // Update stok pada tabel alat_bahan
        $query = "UPDATE alat_bahan SET qty = $qty_terbaru WHERE id_alat_bahan = $id_alat_bahan";

        mysqli_query($conn, $query);
    }
}

function peminjaman_delete($id_peminjaman, $data)
{
    global $conn;

    update_qty_alat_bahan($data);
    pd_delete($id_peminjaman);

    mysqli_query($conn, "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman");
    return mysqli_affected_rows($conn);
}

function pd_delete($id_peminjaman)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM peminjaman_detail WHERE id_peminjaman = $id_peminjaman");
}


function peminjaman_detail_add($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $id_barang = $data["id_barang"];
    $quantity = $data["quantity"];

    foreach ($id_barang as $key => $id) {

        // $id_alat_bahan = $id_barang[$id];
        $qty = $quantity[$id];

        $query = "UPDATE alat_bahan SET qty = qty - $qty WHERE id_alat_bahan = $id";

        mysqli_query($conn, $query);

        $query = "INSERT INTO peminjaman_detail (id_peminjaman_detail, id_peminjaman, id_barang, qty_peminjaman) 
                  VALUES (NULL, '$id_peminjaman', '$id', '$qty')";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function peminjaman_detail_edit($data)
{
    global $conn;

    $id_peminjaman = $data["id_peminjaman"];
    $id_peminjaman_detail = $data["id_peminjaman_detail"];
    $id_barang = $data["id_barang"];
    $qty_peminjaman = $data["qty_peminjaman"];

    $ab = query("SELECT * FROM alat_bahan WHERE id_alat_bahan = $id_barang")[0];
    $pd = query("SELECT * FROM peminjaman_detail WHERE id_peminjaman_detail = $id_peminjaman_detail")[0];

    if ($qty_peminjaman == $pd['qty_peminjaman']) {
        $qty_edit = $ab['qty'];
    } else {
        $selisih = $qty_peminjaman - $pd['qty_peminjaman'];
        $qty_edit = $ab['qty'] - $selisih;
    }

    $query = "UPDATE alat_bahan SET
			qty = '$qty_edit'

            WHERE id_alat_bahan = $id_barang
			";

    mysqli_query($conn, $query);

    $query = "UPDATE peminjaman_detail SET
			qty_peminjaman = '$qty_peminjaman'

            WHERE id_peminjaman_detail = $id_peminjaman_detail
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function peminjaman_detail_delete($id_peminjaman_detail, $id_peminjaman)
{
    global $conn;

    $pd = query("SELECT * FROM peminjaman_detail WHERE id_peminjaman_detail = $id_peminjaman_detail")[0];

    $qty_peminjaman = $pd["qty_peminjaman"];
    $id_alat_bahan = $pd["id_barang"];

    $query = "UPDATE alat_bahan SET qty = qty + $qty_peminjaman WHERE id_alat_bahan = $id_alat_bahan";
    mysqli_query($conn, $query);

    $query = "DELETE FROM peminjaman_detail WHERE id_peminjaman_detail = $id_peminjaman_detail";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}