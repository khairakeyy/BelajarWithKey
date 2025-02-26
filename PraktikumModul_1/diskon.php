<?php
$harga_awal = 50000;
$diskon = 10; // dalam persen

// Menghitung harga setelah diskon
$harga_setelah_diskon = $harga_awal - ($harga_awal * $diskon / 100);

// Menampilkan output
echo "Harga awal: Rp$harga_awal <br>";
echo "Diskon: $diskon% <br>";
echo "Harga setelah diskon: Rp$harga_setelah_diskon";
?>
