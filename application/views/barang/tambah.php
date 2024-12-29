<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="text-center">Tambah Barang</h2>
                <form action="<?php echo base_url('barang/tambah_action'); ?>" method="post">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" id="kode_barang" name="kode_barang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select id="kondisi" name="kondisi" class="form-select" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok_minimum" class="form-label">Stok Minimum</label>
                        <input type="number" id="stok_minimum" name="stok_minimum" class="form-control" value="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
