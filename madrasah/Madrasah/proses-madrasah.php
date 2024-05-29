<?php

require_once "../config.php";

//  jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // ambil value yang diposting
    $id             = $_POST['id'];
    $nama           = trim(htmlspecialchars($_POST['nama']));
    $email          = trim(htmlspecialchars($_POST['email']));
    $status         = $_POST['status'];
    $akreditasi     = $_POST['akreditasi'];
    $alamat         = trim(htmlspecialchars($_POST['alamat']));
    $visimisi       = trim(htmlspecialchars($_POST['visimisi']));
    $gbr            = trim(htmlspecialchars($_POST['gbrLama']));

    // cek apakah gambar yang diupload oleh user
    if ($_FILES['image']['error'] === 4) {
        $gbrmadrasah = $gbr;
    } else {
        $url = 'profile-madrasah.php';
        $gbrmadrasah = uploadimg($url);
        @unlink('../asset/image/' . $gbr);
    }

    // update data
    mysqli_query($koneksi, "UPDATE tbl_madrasah SET
                            nama = '$nama',
                            email = '$email',
                            status = '$status',
                            akreditasi = '$akreditasi',
                            alamat = '$alamat',
                            visimisi = '$visimisi',
                            gambar = '$gbrmadrasah'
                            WHERE id = $id                           
                            ");
    header("location:profile-madrasah.php?msg=updated");
    return;
}

?>