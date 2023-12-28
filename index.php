<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Belanja</title>
</head>
<body>

<?php
// Fungsi untuk mendapatkan data barang berdasarkan kode
function getBarangByKode($kode)
{
    $barangList = [
        "BRG001" => ["nama" => "topi", "harga" => 15000],
        "BRG002" => ["nama" => "tshirt", "harga" => 96000],
        "BRG003" => ["nama" => "jeans", "harga" => 320000],
        // Tambahkan data barang lainnya sesuai kebutuhan
    ];

    return isset($barangList[$kode]) ? $barangList[$kode] : null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $kodeBarang = $_POST["kode_barang"];
    $jumlahBeli = $_POST["jumlah_beli"];

    // Ambil data barang berdasarkan kode
    $barang = getBarangByKode($kodeBarang);

    if ($barang) {
        // Hitung total per barang
        $totalPerBarang = $jumlahBeli * $barang["harga"];

        // Hitung diskon
        $diskon = ($totalPerBarang > 500000) ? 0.05 * $totalPerBarang : 0;

        // Hitung total semua
        $totalSemua = $totalPerBarang - $diskon;

        // Tampilkan hasil
        echo "<h2>Hasil Transaksi</h2>";
        echo "<p>Kode Barang: $kodeBarang</p>";
        echo "<p>Nama Barang: {$barang['nama']}</p>";
        echo "<p>Jumlah Beli: $jumlahBeli</p>";
        echo "<p>Harga Satuan: Rp " . number_format($barang["harga"], 0, ",", ".") . "</p>";
        echo "<p>Total Per Barang: Rp " . number_format($totalPerBarang, 0, ",", ".") . "</p>";
        echo "<p>Diskon: Rp " . number_format($diskon, 0, ",", ".") . "</p>";
        echo "<p>Total Semua: Rp " . number_format($totalSemua, 0, ",", ".") . "</p>";
    } else {
        echo "<p>Barang dengan kode $kodeBarang tidak ditemukan.</p>";
    }
}
?>

<!-- Form Input -->
<h2>Form Transaksi Belanja</h2>
<form method="post" action="">
    <label for="kode_barang">Kode Barang:</label>
    <input type="text" name="kode_barang" required>

    <label for="jumlah_beli">Jumlah Beli:</label>
    <input type="number" name="jumlah_beli" required>

    <button type="submit">Hitung</button>
</form>

</body>
</html>