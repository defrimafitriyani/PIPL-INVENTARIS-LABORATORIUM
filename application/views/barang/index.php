<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">INVENTARIS LABORATORIUM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Menu Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-outline-light text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url('dashboard'); ?>">Statistik</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('log'); ?>">Monitoring Log</a></li>
                            <li><a class="dropdown-item text-danger" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="text-center mb-4">Daftar Barang</h1>

        <!-- Notifikasi Stok Rendah -->
        <?php if (!empty($low_stock)): ?>
        <div class="alert alert-warning">
            <h5><i class="bi bi-exclamation-circle"></i> Notifikasi Stok Rendah</h5>
            <ul>
                <?php foreach ($low_stock as $item): ?>
                <li>
                    <strong><?php echo $item->nama_barang; ?></strong> hanya tersisa <strong><?php echo $item->jumlah; ?></strong> unit (Minimum: <?php echo $item->stok_minimum; ?>).
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Form Pencarian -->
        <form method="post" action="<?php echo base_url('barang/search'); ?>" class="d-flex mb-4">
            <input type="text" name="keyword" class="form-control me-2" placeholder="Cari barang (nama, kode, lokasi)" value="<?php echo isset($keyword) ? $keyword : ''; ?>" required>
            <button type="submit" class="btn btn-primary me-2">Cari</button>
            <a href="<?php echo base_url('barang'); ?>" class="btn btn-secondary">Reset</a>
        </form>

        <!-- Tombol Tambah dan Export -->
        <div class="d-flex justify-content-between mb-3">
            <a href="<?php echo base_url('barang/tambah'); ?>" class="btn btn-success">Tambah Barang</a>
            <a href="<?php echo base_url('barang/export_pdf'); ?>" class="btn btn-danger">Export PDF</a>
        </div>

        <!-- Tabel Data Barang -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($barang)): ?>
                            <?php foreach ($barang as $index => $b): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $b->nama_barang; ?></td>
                                <td><?php echo $b->kode_barang; ?></td>
                                <td><?php echo $b->jumlah; ?></td>
                                <td><?php echo $b->kondisi; ?></td>
                                <td><?php echo $b->lokasi; ?></td>
                                <td>
                                    <a href="<?php echo base_url('barang/edit/' . $b->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?php echo base_url('barang/hapus/' . $b->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data yang ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
