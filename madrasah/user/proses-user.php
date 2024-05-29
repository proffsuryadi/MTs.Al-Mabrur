<?php

require_once "../config.php";

// waktu
date_default_timezone_set('UTC');


// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // ambil value elemen yang diposting
    $username   = trim(htmlspecialchars($_POST['username']));
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $jabatan     = $_POST['jabatan'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $gambar     = trim(htmlspecialchars($_FILES['image']));
    $password   = 1234567;
    $pass       = password_hash($password, PASSWORD_DEFAULT);

    // cek username
    $cekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0){
        header("location:add-user.php?msg=cancel");
        return;
    }

    // upload gambar
    if ($gambar != null){
        $url = 'add-user.php';
        $gambar = uploadimg($url);
    } else {
        $gambar = 'default.png';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES(null, '$username','$pass','$nama','$alamat','$jabatan','$gambar')");

    header("location:add-user.php?msg=added");
    return;
}



?>