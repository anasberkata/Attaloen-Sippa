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