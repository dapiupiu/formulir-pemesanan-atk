<?php
//Instruksi 2d Pembuatan Array untuk jenis barang dan harga satuan
$barang = [
    "Buku" => 5000,
    "Pulpen" => 3000,
    "Pensil" => 2000,
    "Penghapus" => 1500
];

$level_pelanggan_list = [
    "Regular",
    "VIP",
    "Premium"
];

//Instruksi 2e mengurutkan array
asort($barang);

//inisialisasi variabel awal untuk harga satuan
$harga_satuan = 0;


//Instruksi 2g dan 2h untuk membuat fungsi hitung_total_tagihan dan perhitungan diskon
function hitung_total_tagihan($harga_satuan, $jumlah_barang, $level_user) {
    $total_harga = $harga_satuan * $jumlah_barang;

    // Jika total harga di atas 50.000 dan level pelanggannya adalah VIP, berikan diskon 10%
    if($total_harga > 50000 && $level_user == "VIP") {
        $total_setelah_diskon = $total_harga - ($total_harga * 0.1); // diskon 10%
        return $total_setelah_diskon;
    } 
    // Jika tidak memenuhi syarat di atas (Regular atau di bawah 50.000), harga tetap normal
    else {
        return $total_harga;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Alat Tulis Kantor</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container mt-5">
    <div class="header">
        <img src="assets/img/logo.png" alt="logo-alat-tulis" class="logo" width="100" height="100">
        <h1>Pemesanan Alat Tulis Kantor</h1>
    </div>
    <form action="" method="POST">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No Hp</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No Hp" required>
        </div>

        <div class="mb-3">
            <label for="barang" class="form-label">Jenis Barang</label>
            <select class="form-select" id="barang" name="barang" required>
            <option value="" selected disabled>Pilih Jenis Barang</option>
            <?php foreach($barang as $jenis => $harga): ?>
                <option value="<?php echo $jenis; ?>"><?php echo $jenis . " - Rp " . number_format($harga, 0, ',', '.'); ?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Barang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah" required>
        </div>

        <div class="mb-3">
            <label for="pelanggan" class="form-label">Level Pelanggan</label>
            <select class="form-select" id="pelanggan" name="pelanggan" required>
            <option value="" selected disabled>Pilih Level Pelanggan</option>
            <?php foreach($level_pelanggan_list as $level): ?>
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
            <?php endforeach; ?>
            </select>
        </div> <button type="submit" class="btn btn-primary" name="pesan">Pesan</button>
    </form>


    <?php 
      if(isset($_POST['pesan'])){
        $nama = $_POST["nama"];
        $no_hp = $_POST["no_hp"];
        $jenis_barang = $_POST["barang"];
        $jumlah_barang = (int)$_POST["jumlah"];
        
        // PERBAIKAN 1: Menangkap input level pelanggan dari form select
        $level_user = $_POST["pelanggan"]; 

        //Instruksi 2f penentuan $harga_satuan berdasarkan jenis barang menggunakan kontrol percabangan
        if($jenis_barang == "Buku") {
            $harga_satuan = $barang["Buku"];
        } elseif ($jenis_barang == "Pulpen") {
            $harga_satuan = $barang["Pulpen"];
        } elseif ($jenis_barang == "Pensil") {
            $harga_satuan = $barang["Pensil"];
        } elseif ($jenis_barang == "Penghapus") {
            $harga_satuan = $barang["Penghapus"];
        }

        // PERBAIKAN 2: Mengirimkan data pilihan user ($level_user) ke fungsi, bukan array listnya
        $total_biaya = hitung_total_tagihan($harga_satuan, $jumlah_barang, $level_user);

        // menghitung persen diskon untuk ditampilkan di struk pemesanan
        $persen_diskon = (($harga_satuan * $jumlah_barang) > 50000 && $level_user == "VIP") ? 10 : 0;

        // persiapan data untuk disimpan ke file JSON
        $data = [
            "Nama_Pemesan" => $nama,
            "No_Hp" => $no_hp,
            "Jenis Barang" => $jenis_barang,
            "Jumlah" => $jumlah_barang,
            "Level_Pelanggan" => $level_user,
            "Total_Biaya" => $total_biaya
        ];

        //Instruksi 3a menyimpan data pemesanan ke dalam file JSON
        $file_name = "data/data.json";
        $data_json = [];
        if (file_exists($file_name)) {
            $data_json = json_decode(file_get_contents($file_name), true) ?? [];
        }
        
        $data_json[] = $data;
        if (file_put_contents($file_name, json_encode($data_json, JSON_PRETTY_PRINT))) {
            $status_simpan = true;
        }

        echo "<div class='alert alert-success mt-4'>
        <h5>Pemesanan Berhasil:</h5>
        <strong>Nama Pelanggan:</strong> " . $nama . "<br>
        <strong>No Hp:</strong> " . $no_hp . "<br>
        <strong>Jenis Barang:</strong> " . $jenis_barang . "<br>
        <strong>Level Pelanggan:</strong> " . $level_user . "<br>  
        <strong>Jumlah Barang:</strong> " . $jumlah_barang . " <br>
        <strong>Diskon:</strong> " . $persen_diskon . "% <br>
        <strong>Total Tagihan:</strong> Rp " . number_format($total_biaya, 0, ',', '.')."<br>
        </div>";
        }   
    ?>

    <div class="row g-2 mt-2">
        <div class="col-md-6">
            <a href="index.php" class="btn btn-secondary w-100">Input Pemesanan</a>
        </div>
        <div class="col-md-6">
            <a href="data/data.json" class="btn btn-info w-100" target="_blank">Cek Data Pemesanan (JSON)</a>
        </div>
    </div>
</div>
</body>
</html>