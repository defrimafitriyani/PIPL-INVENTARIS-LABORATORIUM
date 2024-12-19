<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white me-2" href="<?php echo base_url('barang'); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Dashboard Statistik</h1>
        <div class="row">
            <!-- Total Barang -->
            <div class="col-md-4">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Total Barang</h5>
                        <h2><?php echo $total_barang; ?></h2>
                    </div>
                </div>
            </div>
            <!-- Barang Baik -->
            <div class="col-md-4">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Barang Baik</h5>
                        <h2><?php echo $barang_baik; ?></h2>
                    </div>
                </div>
            </div>
            <!-- Barang Rusak -->
            <div class="col-md-4">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <h5>Barang Rusak</h5>
                        <h2><?php echo $barang_rusak; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi dengan Barang Terbanyak -->
        <div class="card shadow mt-5">
            <div class="card-body">
                <h5 class="text-center">Top 5 Lokasi dengan Barang Terbanyak</h5>
                <canvas id="locationChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('locationChart').getContext('2d');
        const locationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($top_locations as $location) {
                        echo '"' . $location->lokasi . '",';
                    } ?>
                ],
                datasets: [{
                    label: 'Jumlah Barang',
                    data: [
                        <?php foreach ($top_locations as $location) {
                            echo $location->total . ',';
                        } ?>
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
