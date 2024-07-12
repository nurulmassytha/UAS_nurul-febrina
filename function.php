<?php
function tambahPesanan($data) {
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $no_wa = htmlspecialchars($data['no_wa']);
    $paket = htmlspecialchars($data['paket']);

    $query = "INSERT INTO tbl_pemesan (nama,alamat,no_wa,paket) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"ssss",$nama,$alamat,$no_wa,$paket);
    mysqli_stmt_excute($stmt);

    return mysqli_stmt_affected_rows($stmt);
}
?>