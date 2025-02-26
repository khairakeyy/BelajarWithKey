<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "lostandfound");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil kategori
$sql = "SELECT id, name FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<select name="category" id="category" required class="form-select">';
    echo '<option value="" disabled selected>Pilih Kategori</option>';

    // Loop untuk menampilkan kategori
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
    }

    echo '</select>';
} else {
    echo "Tidak ada kategori yang tersedia.";
}

// Tutup koneksi
$conn->close();
?>
