<?php
// koneksi kedatabase
$conn = mysqli_connect("localhost", "root", "", "db_organizer");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahTamu($data){
    global $conn;
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $kode_undangan = htmlspecialchars($_POST['kode_undangan']);
    $password = htmlspecialchars($_POST['password']);
    $foto = upload();
    if(!$foto){
        return false;
    }

    $query = "INSERT INTO tbl_tamu (id_tamu, nama_lengkap, alamat, nomor_telepon, foto, kode_undangan, password) VALUES ('', '$nama_lengkap','$alamat', '$no_telp', '$foto', '$kode_undangan', '$password')";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

function editTamu($data){
    global $conn;
    
    $id = $data["id_tamu"];
    $fotoLama = htmlspecialchars($_POST['foto_lama']);
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $kode_undangan = htmlspecialchars($_POST['kode_undangan']);
    $password = htmlspecialchars($_POST['password']);

    // cek apakah user mengubah gambar atau tidak
    // === 4 artinya user tidak mengupload foto
    if( $_FILES['foto']['error'] === 4){
        $foto = $fotoLama;
    } else {
        $foto = upload();
        
        $target_dir = "assets/img/"; //tempat gambar disimpan
        $filename = $fotoLama; // nama file gambar yang ingin dihapus
        if (file_exists($target_dir . $filename)) { // untuk periksa file ada atau tidak
            unlink($target_dir . $filename); // hapus file jika ada
            echo "Gambar berhasil dihapus.";
        } else {
            echo "Gambar tidak ditemukan.";
        }
    }

    $query = "UPDATE tbl_tamu SET nama_lengkap = '$nama_lengkap', alamat = '$alamat', nomor_telepon = '$no_telp', foto = '$foto', kode_undangan = '$kode_undangan', password = '$password' WHERE id_tamu = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusTamu($id){
    global $conn;
    $ambiljpg = null;
    $vd = mysqli_query($conn, "SELECT foto FROM tbl_tamu WHERE id_tamu = $id");
    while ($row = mysqli_fetch_assoc($vd)) {
        global $ambiljpg;
        $ambiljpg = $row['foto'];

        $target_dir = "assets/img/"; // tempat gambar disimpan
        $filename = $ambiljpg; // nama file gambar yang ingin dihapus
        if (file_exists($target_dir . $filename)) { // periksa file ada atau tidak
            unlink($target_dir . $filename); // hapus file jika ada
            echo "Gambar berhasil dihapus.";
        } else {
            echo "Gambar tidak ditemukan.";
        }
    }
    
    mysqli_query($conn, "DELETE FROM tbl_tamu WHERE id_tamu = $id");

    return mysqli_affected_rows($conn);
}

function tambahContent($data){
    global $conn;
    
    $judul = htmlspecialchars($_POST['judul']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $foto = upload();
    if(!$foto){
        return false;
    }

    $query = "INSERT INTO tbl_conten (id_conten, judul, deskripsi, foto) VALUES ('', '$judul','$deskripsi', '$foto')";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}


function editContent($data){
    global $conn;
    
    $id = $data["id_conten"];
    $fotoLama = htmlspecialchars($_POST['foto_lama']);
    $judul = htmlspecialchars($_POST['judul']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    // cek apakah user mengubah gambar atau tidak
    // === 4 artinya user tidak mengupload foto
    if( $_FILES['foto']['error'] === 4){
        $foto = $fotoLama;
    } else {
        $foto = upload();
        
        $target_dir = "assets/img/"; // direktori tempat gambar disimpan
        $filename = $fotoLama; // nama file gambar yang ingin dihapus
        if (file_exists($target_dir . $filename)) { // periksa apakah file ada
            unlink($target_dir . $filename); // hapus file jika ada
            echo "Gambar berhasil dihapus.";
        } else {
            echo "Gambar tidak ditemukan.";
        }
    }

    $query = "UPDATE tbl_conten SET judul = '$judul', deskripsi = '$deskripsi', foto = '$foto' WHERE id_conten = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteContent($id){
    global $conn;
    $ambiljpg = null;
    $vd = mysqli_query($conn, "SELECT foto FROM tbl_conten WHERE id_conten = $id");
    while ($row = mysqli_fetch_assoc($vd)) {
        global $ambiljpg;
        $ambiljpg = $row['foto'];

        $target_dir = "assets/img/"; // direktori tempat gambar disimpan
        $filename = $ambiljpg; // nama file gambar yang ingin dihapus
        if (file_exists($target_dir . $filename)) { // periksa apakah file ada
            unlink($target_dir . $filename); // hapus file jika ada
            echo "Gambar berhasil dihapus.";
        } else {
            echo "Gambar tidak ditemukan.";
        }
    }
    
    mysqli_query($conn, "DELETE FROM tbl_conten WHERE id_conten = $id");

    return mysqli_affected_rows($conn);
}


function upload(){
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $temName = $_FILES["foto"]["tmp_name"];

    // cek upload gambar
    if( $error === 4 ){
        echo "<script>
            alert('Pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    // cek ektensi gambar
    $ektensiGambarValid = ['jpg', 'jpeg', 'png'];

    // function 'explode()' berfungsi untuk memecah nama dan ektensi file yang di upload
    $ektensiGambar = explode('.', $namaFile);

    // function 'end()' berfungsi untuk mengambil urutan terakhir(type ektensi yang telah dipecah oleh function 'explode()')

    // function 'strtolower()' berfungsi untuk memaksa ektensi yang diupoal menjadi string huruf kecil semua. jadi setelah kita melakukan upload, file akan dipecah menjadi 2 bagian olkeh function 'explode()'. kemudian mengambil type filenya
    $ektensiGambar = strtolower(end($ektensiGambar));

    // function 'in_array()' berfungsi untuk mengecek adakah string dalam sebuah array
    if(!in_array($ektensiGambar, $ektensiGambarValid)){
        echo "<script>
            alert('yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // generate nama gambar yang akan diupload ke folder img
    // function 'uniqid()' berfungsi untuk membuat string yang berupa angka random
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ektensiGambar;
    // lakukan pengecekan gambar siap diupload
    move_uploaded_file($temName, 'assets/img/'.$namaFileBaru);

    // return dibawah berfungsi sebagai nilai kembalian dari function upload() ini
    return $namaFileBaru;

}

// Fungsi untuk menambahkan pesanan baru
function tambahPesanan($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_wa = htmlspecialchars($data['no_wa']);
    $paket = htmlspecialchars($data['paket']);

    $query = "INSERT INTO tbl_pemesan (nama, alamat, no_wa, paket) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars(mysqli_error($conn)));
    }
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $alamat, $no_wa, $paket);
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_errno($stmt)) {
        die('Execute failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
    }

    return mysqli_stmt_affected_rows($stmt);
}

// function tambahpesanan($data){
//     global $conn;
//     $nama = htmlspecialchars($_POST['nama']);
//     $alamat = htmlspecialchars($_POST['alamat']);
//     $no_wa = htmlspecialchars($_POST['no_wa']);
//     $paket = htmlspecialchars($_POST['paket']);
//     if(!$foto){
//         return false;
//     }

//     $query = "INSERT INTO tbl_pemesan (nama, alamat, no_wa,paket) VALUES ('$nama','$alamat', '$no_wa', '$paket')";
//     mysqli_query($conn, $query);
    
//     return mysqli_affected_rows($conn);
// }



