<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="file">Pilih Gambar:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">Unggah</button>
    </form>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="files">Pilih File:</label>
        <input type="file" name="files[]" id="files" multiple required>
        <button type="submit">Unggah</button>
    </form>
</body>
</html>


<?php
function createUploadDir($dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

function validateFile($file, $allowedTypes, $maxSize) {
    if (!in_array($file['type'], $allowedTypes)) {
        return "Hanya file JPEG atau PNG yang diizinkan.";
    }
    if ($file['size'] > $maxSize) {
        return "Ukuran file tidak boleh lebih dari " . ($maxSize / 1024 / 1024) . " MB.";
    }
    return true;
}

$uploadDir = 'uploads/';
createUploadDir($uploadDir);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2 MB

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $validation = validateFile($file, $allowedTypes, $maxSize);
        if ($validation === true) {
            $uploadFile = $uploadDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                echo "File " . htmlspecialchars($file['name']) . " berhasil diunggah ke $uploadFile";
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo $validation;
        }
    }

    if (isset($_FILES['files'])) {
        foreach ($_FILES['files']['name'] as $key => $fileName) {
            $fileTmp = $_FILES['files']['tmp_name'][$key];
            $fileType = $_FILES['files']['type'][$key];
            $fileSize = $_FILES['files']['size'][$key];
            
            $file = [
                'name' => $fileName,
                'tmp_name' => $fileTmp,
                'type' => $fileType,
                'size' => $fileSize
            ];

            $validation = validateFile($file, $allowedTypes, $maxSize);
            if ($validation === true) {
                $filePath = $uploadDir . basename($fileName);
                if (move_uploaded_file($fileTmp, $filePath)) {
                    echo "File " . htmlspecialchars($fileName) . " berhasil diunggah.<br>";
                } else {
                    echo "Gagal mengunggah file " . htmlspecialchars($fileName) . ".<br>";
                }
            } else {
                echo $validation . " File: " . htmlspecialchars($fileName) . "<br>";
            }
        }
    }
}

$files = scandir($uploadDir);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<a href='$uploadDir" . htmlspecialchars($file) . "' target='_blank'>" . htmlspecialchars($file) . "</a> ";
        echo "<a href='?file=" . urlencode($file) . "' onclick='return confirm(\"Hapus file ini?\")'>Hapus</a><br>";
    }
}

if (isset($_GET['file'])) {
    $file = $uploadDir . basename($_GET['file']);
    if (file_exists($file)) {
        unlink($file);
        echo "File " . htmlspecialchars($_GET['file']) . " berhasil dihapus.";
    } else {
        echo "File tidak ditemukan.";
    }
}
?>