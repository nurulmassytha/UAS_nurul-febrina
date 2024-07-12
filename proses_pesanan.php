<?php
require "config.php";

if (isset($_POST['tambahpesanan'])) {
    $result = tambahPesanan($_POST);
    if ($result > 0) {
        echo "<script>
                alert('Pesanan Berhasil Ditambahkan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Pesanan gagal ditambahkan!');
                window.location.href = 'index.php';
              </script>";
    }
}
?>
